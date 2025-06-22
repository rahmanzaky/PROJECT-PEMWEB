FROM php:8.4-apache

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

RUN rm /var/www/html/index.html || true
EXPOSE 80
