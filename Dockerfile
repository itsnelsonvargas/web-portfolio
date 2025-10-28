# Multi-stage build for Laravel application

# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci

# Copy necessary files for Vite build
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY resources ./resources

# Copy public directory (needed for Vite, but build folder will be ignored)
COPY public ./public

# Remove any existing build artifacts
RUN rm -rf public/build public/hot

# Build assets with verbose logging
RUN echo "Building frontend assets..." \
    && npm run build \
    && echo "Build complete. Contents of public/build:" \
    && ls -la public/build/ || echo "ERROR: Build directory not created!"

# Stage 2: PHP dependencies
FROM composer:2 AS backend

WORKDIR /app

# Copy composer files
COPY composer*.json ./

# Install dependencies (no dev dependencies for production)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy application code
COPY . .

# Generate optimized autoloader
RUN composer dump-autoload --optimize

# Stage 3: Final production image
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    sqlite \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    mbstring \
    xml \
    gd \
    opcache \
    pcntl

# Set working directory
WORKDIR /var/www/html

# Copy application from backend stage
COPY --from=backend /app /var/www/html

# Copy built assets from frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Verify build assets were copied
RUN echo "Verifying build assets..." \
    && ls -la /var/www/html/public/build/ \
    && cat /var/www/html/public/build/manifest.json \
    || echo "WARNING: Build assets missing!"

# Create necessary directories
RUN mkdir -p \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/cache/data \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache \
    /var/www/html/database \
    /run/nginx \
    /var/log/supervisor

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Make entrypoint executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Optimize PHP for production
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Expose port (Render will use this)
EXPOSE 8080

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=40s \
    CMD curl -f http://localhost:8080/health || exit 1

# Start supervisor (runs as root, but processes run as www-data)
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
