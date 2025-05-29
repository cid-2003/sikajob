FROM richarvey/nginx-php-fpm:3.1.6

# Copier tout le projet dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Variables d'environnement
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Installation des dépendances Laravel (si pas déjà fait)
RUN composer install --no-dev --optimize-autoloader

# Mise en cache de la config et des routes
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Donner les bonnes permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer require league/flysystem-aws-s3-v3

# Lancer le script de démarrage
CMD ["/start.sh"]
