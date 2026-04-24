FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libcurl4-openssl-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the entire project
COPY . .

# Go into Laravel directory
WORKDIR /var/www/html/backend-laravel

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies and build assets
RUN npm install && npm run build

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Create storage link
RUN php artisan storage:link

ENV APP_ENV=production
ENV FORCE_HTTPS=true

# Clean and Cache
# Maintenant que les conflits de noms de routes et les closures sont résolus, 
# on peut réactiver le cache des routes en toute sécurité.
RUN php artisan config:clear && \
    php artisan route:cache && \
    php artisan view:cache

# Expose port
EXPOSE 8080

# Start command
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
