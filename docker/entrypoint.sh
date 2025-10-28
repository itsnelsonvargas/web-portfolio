#!/bin/sh

set -e

echo "Starting Laravel application..."

# Switch to root temporarily for setup (if running as www-data)
if [ "$(id -u)" = "82" ]; then
    echo "Running as www-data, some operations may be limited"
fi

# Wait for database to be ready (if using external DB)
# Uncomment if using MySQL/PostgreSQL
# echo "Waiting for database..."
# sleep 5

# Create SQLite database if it doesn't exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# Cache configuration for better performance
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if it doesn't exist
if [ ! -L /var/www/html/public/storage ]; then
    echo "Creating storage link..."
    php artisan storage:link || true
fi

echo "Application is ready!"

# Execute the main command
exec "$@"
