FROM php:8.2-apache

RUN apt-get update && apt-get install -y libzip-dev unzip libpng-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu

RUN echo "display_errors=On" >> /usr/local/etc/php/php.ini
RUN echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

COPY . /var/www/html/
