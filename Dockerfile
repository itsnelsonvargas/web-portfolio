FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip nodejs npm \
    && docker-php-ext-install mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# Copy and Install
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts
COPY . .
RUN composer run-script post-autoload-dump

# Build Assets
RUN npm ci && npx vite build

# Permissions (Crucial: do not cache config here!)
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Apache Config
RUN a2enmod rewrite headers
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf
RUN echo '<VirtualHost *:8080>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

# Start as root (Apache will manage user permissions)
USER root
CMD ["apache2-foreground"]
