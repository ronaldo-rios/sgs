FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    unzip \
    zip \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev

# Get PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    mbstring \
    zip \
    exif \
    gd

# Set permissions
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

COPY ./composer.json /var/www/html/composer.json

RUN composer install \
    --prefer-dist \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress \
    --no-scripts

COPY app ./var/www/html/app
COPY core ./var/www/html/core
COPY index.php ./var/www/html/index.php
COPY .env ./var/www/html/.env

