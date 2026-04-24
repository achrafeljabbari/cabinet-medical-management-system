FROM php:8.4.7-cli

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
RUN composer install --no-dev --optimize-autoloader

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Créer la base de données SQLite
RUN touch database/database.sqlite

# Exposer port
EXPOSE 8080

# Démarrer PHP built-in server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080