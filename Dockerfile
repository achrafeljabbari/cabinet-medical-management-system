FROM php:8.4.7-cli

# Forcer mise à jour apt pour éviter le cache
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet
COPY . /var/www/html

# Supprimer les fichiers de cache pour éviter les anciennes configurations
RUN rm -rf /var/www/html/backend-laravel/bootstrap/cache/*.php

# Définir le bon dossier Laravel
WORKDIR /var/www/html/backend-laravel

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Créer la base de données SQLite
RUN touch database/database.sqlite

# Exécuter les migrations
RUN php artisan migrate --force

# Configurer les variables d'environnement
ENV APP_ENV=production
ENV APP_URL=https://cabinet-medical-management-system-production.up.railway.app
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite

# Vider le cache de configuration
RUN php artisan config:clear

# Exposer port
EXPOSE 8080

# Démarrer PHP built-in server
CMD php artisan serve --host=0.0.0.0 --port=8080