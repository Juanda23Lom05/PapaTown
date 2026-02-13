# 1. Usamos una imagen de PHP con Apache
FROM php:8.2-apache

# 2. Instalamos extensiones necesarias para Laravel y PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# 3. Activamos el módulo de reescritura de Apache (vital para Laravel)
RUN a2enmod rewrite

# 4. Cambiamos el DocumentRoot de Apache a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Copiamos los archivos del proyecto al contenedor
COPY . /var/www/html

# 6. Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Instalamos las dependencias de PHP (sin las de desarrollo para que pese menos)
RUN composer install --no-dev --optimize-autoloader

# 8. Permisos para que Laravel pueda escribir en logs y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Exponemos el puerto 80
EXPOSE 80

# 10. Comando para arrancar: Migraciones y Apache
CMD php artisan migrate --force && apache2-foreground