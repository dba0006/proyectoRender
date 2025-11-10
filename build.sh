#!/usr/bin/env bash

echo "Running build script..."

# Install Composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Install npm dependencies
npm ci

# Build frontend assets
npm run build

# Clear caches
php artisan config:clear
php artisan cache:clear

# Run migrations
php artisan migrate --force --no-interaction

echo "Build complete!"
