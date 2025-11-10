#!/usr/bin/env bash

echo "Running deployment script for Render..."

# Install Composer dependencies
echo "Installing composer dependencies..."
composer install --no-dev --working-dir=/opt/render/project/src --optimize-autoloader --no-interaction

# Clear any cached config to avoid errors
echo "Clearing config cache..."
php artisan config:clear
php artisan cache:clear

# Run migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# Build frontend assets
echo "Building frontend assets..."
npm ci
npm run build

# Optimize for production
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "Deployment complete! Starting server..."

# Start PHP built-in server
php artisan serve --host=0.0.0.0 --port=${PORT:-8000} --env=production
