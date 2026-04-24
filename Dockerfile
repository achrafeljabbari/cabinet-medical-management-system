FROM php:8.4.7-cli

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

WORKDIR /var/www/html/backend-laravel

RUN rm -rf bootstrap/cache/*.php

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

ENV APP_ENV=production
ENV APP_URL=https://cabinet-medical-management-system-production.up.railway.app
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite

RUN touch database/database.sqlite

RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 8080

# migrate au démarrage, pas au build
CMD php artisan migrate --force && php -S 0.0.0.0:8080 -t public