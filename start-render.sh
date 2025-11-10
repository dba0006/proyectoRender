#!/bin/bash
set -e  # Exit on error

echo "=== Laravel Startup Script for Render ==="
echo "Working directory: $(pwd)"
echo "Environment: ${APP_ENV:-not set}"
echo "Debug: ${APP_DEBUG:-not set}"
echo "Port: ${PORT:-10000}"
echo ""

# Check PHP version
echo "=== PHP Version ==="
php -v
echo ""

# Check if APP_KEY is set
echo "=== Checking APP_KEY ==="
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set!"
    echo "Please set APP_KEY in Render environment variables"
    exit 1
else
    echo "APP_KEY is set ✓"
fi
echo ""

echo "=== Setting up database ==="
mkdir -p database
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    echo "Created database.sqlite ✓"
else
    echo "database.sqlite already exists ✓"
fi
chmod 666 database/database.sqlite
echo ""

echo "=== Setting permissions ==="
chmod -R 777 storage
chmod -R 777 bootstrap/cache
chmod -R 777 database
echo "Permissions set ✓"
echo ""

echo "=== Clearing all caches ==="
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
echo "Caches cleared ✓"
echo ""

echo "=== Running migrations ==="
php artisan migrate --force --verbose
if [ $? -eq 0 ]; then
    echo "Migrations completed ✓"
else
    echo "WARNING: Migrations failed but continuing..."
fi
echo ""

echo "=== Application Information ==="
php artisan --version
echo ""

echo "=== Starting Laravel server ==="
echo "Listening on 0.0.0.0:${PORT:-10000}"
echo "Press Ctrl+C to stop"
echo ""

exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000} --env=production --verbose
