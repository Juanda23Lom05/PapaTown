# 1. Usamos una imagen de PHP con Apache
FROM php:8.2-apache

# 2. Instalamos extensiones necesarias (Añadimos libicu-dev para strings y libpng para imágenes si ocupas)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql bcmath gd zip

# 3. Activamos el módulo de reescritura de Apache
RUN a2enmod rewrite

# 4. Cambiamos el DocumentRoot de Apache a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Copiamos los archivos (Usamos un .dockerignore para no subir basura)
COPY . /var/www/html

# 6. Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Instalamos dependencias (Sin scripts para evitar que las migraciones corran antes de tiempo)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 8. Permisos correctos (Crucial para el 419 y el 500)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Exponemos el puerto (Render lo detecta solito)
EXPOSE 80

# 10. Comando de arranque (Añadimos limpieza de caché antes de las migraciones)
CMD php artisan optimize:clear && php artisan migrate --force && apache2-foreground