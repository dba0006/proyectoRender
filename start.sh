#!/usr/bin/env bash

echo "Running deployment script..."

# Install dependencies
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Create .env if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
fi

# Generate application key if needed
echo "Generating application key..."
php artisan key:generate --force

# Clear and cache configuration
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Install npm dependencies and build assets
echo "Building frontend assets..."
npm install
npm run build

# Set proper permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "Deployment complete!"

# Start the application
echo "Starting application..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
