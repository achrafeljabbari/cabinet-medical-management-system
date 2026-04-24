FROM php:8.4.7-apache

# Forcer mise à jour apt pour éviter le cache
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet
COPY . /var/www/html

# Définir le bon dossier Laravel
WORKDIR /var/www/html/backend-laravel

# Installer dépendances Laravel
RUN composer install

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Config Apache pour Laravel
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/backend-laravel/public!g' /etc/apache2/sites-available/000-default.conf

# Exposer port
EXPOSE 80