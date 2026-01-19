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
    && docker-php-ext-install mbstring exif pcntl bcmath gd zip

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
RUN npm ci --only=production

# Copy the rest of the application
COPY . .

# Run composer scripts now that artisan is available
RUN composer run-script post-autoload-dump --no-interaction

# Build frontend assets
RUN npm run build

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/data

# Create .env file if it doesn't exist
RUN cp .env.example .env 2>/dev/null || echo "No .env.example found"

# Generate application key if not set
RUN php artisan key:generate --no-interaction --force

# Ensure data directory exists and has proper permissions
RUN mkdir -p data && \
    chown -R www-data:www-data data && \
    chmod -R 755 data

# Clear and cache config
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Enable Apache mod_rewrite and headers
RUN a2enmod rewrite headers

# Configure Apache to serve Laravel
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
    LogLevel warn\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Configure PHP for production
RUN echo "upload_max_filesize = 10M\n\
post_max_size = 10M\n\
memory_limit = 256M\n\
max_execution_time = 300\n\
max_input_time = 300" > /usr/local/etc/php/conf.d/production.ini

# Expose port 8080 for Render.com
EXPOSE 8080

# Update Apache to listen on port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Start Apache
CMD ["apache2-foreground"]
