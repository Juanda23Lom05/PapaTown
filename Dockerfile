# 1. Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# 2. Instalamos las dependencias del sistema y extensiones de PHP para PostgreSQL
# Necesitamos libpq-dev para que pdo_pgsql funcione
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql bcmath gd zip

# 3. Activamos el módulo de reescritura de Apache (necesario para las rutas de Laravel)
RUN a2enmod rewrite

# 4. Configuramos el DocumentRoot hacia la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Copiamos los archivos del proyecto al contenedor
COPY . /var/www/html

# 6. Instalamos Composer (copiando el binario oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Instalamos las dependencias de producción
# Usamos --no-scripts para evitar errores de conexión a DB durante el build
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 8. Asignamos permisos de escritura a las carpetas críticas
# Esto evita el error 419 (sesiones) y el 500 (logs/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Exponemos el puerto 80 para Render
EXPOSE 80

# 10. COMANDO DE ARRANQUE (EL MÁS IMPORTANTE)
# Usamos 'migrate:fresh' SOLO ESTA VEZ para resetear la tabla de BIGINT a UUID.
# Una vez que funcione, deberías quitar el ':fresh' para no perder tus datos.
CMD php artisan optimize:clear && php artisan migrate:fresh --force && apache2-foreground