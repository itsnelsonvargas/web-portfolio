# Use PHP 8.2 with Apache for Render.com
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies (skip scripts since artisan isn't available yet)
RUN composer install --optimize-autoloader --no-dev --no-scripts --no-interaction --prefer-dist

# Copy package files and install Node dependencies
COPY package.json package-lock.json ./
RUN npm ci && npm cache clean --force

# Copy the rest of the application
COPY . .

# Run composer scripts now that artisan is available
RUN composer run-script post-autoload-dump --no-interaction

# Build frontend assets
RUN npx vite build && npm cache clean --force

# Set proper permissions (targeted approach for performance)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/data
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/data

# Create .env file if it doesn't exist
RUN cp .env.example .env 2>/dev/null || echo "No .env.example found"

# Generate application key if not set
RUN php artisan key:generate --no-interaction --force || true

# Ensure data directory exists and has proper permissions
RUN mkdir -p data && \
    chown -R www-data:www-data data && \
    chmod -R 755 data

# Clear and cache config (with error handling)
RUN php artisan config:cache --no-ansi 2>/dev/null || echo "Config cache failed" && \
    php artisan route:cache --no-ansi 2>/dev/null || echo "Route cache failed" && \
    php artisan view:cache --no-ansi 2>/dev/null || echo "View cache failed"

# Enable Apache mod_rewrite and headers
RUN a2enmod rewrite headers

# Configure Apache to serve Laravel
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes -MultiViews\n\
        DirectoryIndex index.php index.html\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
    LogLevel warn\n\
    # Security headers\n\
    <IfModule mod_headers.c>\n\
        Header always set X-Content-Type-Options nosniff\n\
        Header always set X-Frame-Options DENY\n\
        Header always set X-XSS-Protection "1; mode=block"\n\
        Header always set Referrer-Policy "strict-origin-when-cross-origin"\n\
    </IfModule>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Configure PHP for production
RUN echo "upload_max_filesize = 10M\n\
post_max_size = 10M\n\
memory_limit = 256M\n\
max_execution_time = 300\n\
max_input_time = 300\n\
opcache.enable = 1\n\
opcache.memory_consumption = 256\n\
opcache.max_accelerated_files = 7963\n\
opcache.revalidate_freq = 0\n\
realpath_cache_size = 4096K\n\
realpath_cache_ttl = 600" > /usr/local/etc/php/conf.d/production.ini

# Create health check endpoint
RUN echo '<?php\n\
header("Content-Type: application/json");\n\
echo json_encode([\n\
    "status" => "healthy",\n\
    "timestamp" => date("c"),\n\
    "service" => "laravel-portfolio"\n\
]);\n\
?>' > /var/www/html/public/health.php

# Expose port 8080 for Render.com
EXPOSE 8080

# Update Apache to listen on port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/health.php || exit 1

# Clean up temporary files
RUN rm -rf /tmp/* /var/tmp/* && \
    apt-get autoremove -y && \
    apt-get autoclean

# Set the default user
USER www-data

# Start Apache
CMD ["apache2-foreground"]
