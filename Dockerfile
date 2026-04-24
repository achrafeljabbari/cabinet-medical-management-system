FROM php:8.4.7-cli

# Installer les dépendances système nécessaires (y compris SQLite pour pdo_sqlite)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libcurl4-openssl-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql zip mbstring exif pcntl bcmath

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet
COPY . /var/www/html

# Définir le dossier Laravel
WORKDIR /var/www/html/backend-laravel

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Créer la base de données SQLite
RUN touch database/database.sqlite

# Configurer les variables d'environnement AVANT les commandes artisan
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite
ENV APP_URL=https://cabinet-medical-management-system-production.up.railway.app

# Exécuter les migrations
RUN php artisan migrate --force

# Optimiser pour la production
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exposer le port
EXPOSE 8080

# Démarrer PHP built-in server
CMD php artisan serve --host=0.0.0.0 --port=8080