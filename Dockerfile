# PHP base image with Apache
FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

WORKDIR /var/www/html/php_nhom9

RUN composer install --optimize-autoloader --no-dev

RUN chmod -R 777 storage bootstrap/cache

RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
