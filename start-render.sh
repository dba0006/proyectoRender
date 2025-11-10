#!/bin/bash

echo "=== Laravel Startup Script for Render ==="
echo "Environment: $APP_ENV"
echo "Debug: $APP_DEBUG"
echo "Port: ${PORT:-10000}"

# Check PHP version
echo "=== PHP Version ==="
php -v

# Check if APP_KEY is set
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set!"
    exit 1
fi

echo "=== Creating database directory ==="
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 666 /var/www/html/database/database.sqlite

echo "=== Setting permissions ==="
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/database

echo "=== Clearing caches ==="
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Checking database ==="
php artisan db:show || echo "Could not show database info"

echo "=== Starting Laravel server ==="
echo "Server will start on 0.0.0.0:${PORT:-10000}"
php artisan serve --host=0.0.0.0 --port=${PORT:-10000} --env=production
