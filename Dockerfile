FROM php:7.3-apache

RUN apt-get update \
 && apt-get install -y git zlib1g-dev libzip-dev libicu-dev git unzip \
 && docker-php-ext-install zip intl\
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
