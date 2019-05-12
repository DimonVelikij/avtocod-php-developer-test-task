FROM php:7.2-fpm

COPY --from=composer:1.7 /usr/bin/composer /usr/bin/composer

RUN apt-get update

RUN apt-get install -y \
    git \
    libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql
