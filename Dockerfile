# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    sqlite3 \
    libsqlite3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
RUN chown -R www-data:www-data /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install npm dependencies and build
RUN npm ci && npm run build

# Clear caches
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

# Create SQLite database directory and file
RUN mkdir -p /var/www/html/database
RUN touch /var/www/html/database/database.sqlite
RUN chown -R www-data:www-data /var/www/html/database
RUN chmod -R 775 /var/www/html/database

# Set permissions for storage and cache
RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
RUN mkdir -p /var/www/html/storage/logs
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Copy startup script
COPY start-render.sh /start-render.sh
RUN chmod +x /start-render.sh

# Expose port (Render will override with $PORT)
EXPOSE 10000

# Start application
CMD ["/start-render.sh"]
