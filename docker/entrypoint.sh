#!/bin/sh

set -e

echo "========================================="
echo "Starting Laravel Application Setup"
echo "========================================="

# Ensure we're in the right directory
cd /var/www/html

# Fix permissions for critical directories
echo "[1/7] Setting up permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Create SQLite database if it doesn't exist
echo "[2/7] Setting up database..."
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
else
    echo "Database already exists"
fi

# Run migrations
echo "[3/7] Running database migrations..."
if php artisan migrate --force --no-interaction; then
    echo "Migrations completed successfully"
else
    echo "WARNING: Migrations failed, but continuing..."
fi

# Clear any old cache
echo "[4/7] Clearing old cache..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

# Cache configuration for better performance
echo "[5/7] Optimizing application..."
php artisan config:cache || echo "WARNING: Config cache failed"
php artisan route:cache || echo "WARNING: Route cache failed"
php artisan view:cache || echo "WARNING: View cache failed"

# Create storage link if it doesn't exist
echo "[6/7] Creating storage link..."
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link || echo "WARNING: Storage link creation failed"
else
    echo "Storage link already exists"
fi

# Final permission check
echo "[7/7] Final permission check..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "========================================="
echo "Application Setup Complete!"
echo "Starting web server..."
echo "========================================="

# Execute the main command
exec "$@"
