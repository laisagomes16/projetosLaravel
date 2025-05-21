FROM composer:latest AS laravel_installer

WORKDIR /app

RUN composer create-project laravel/laravel . \
    && composer require tymon/jwt-auth \
    && php artisan install:api || true

COPY .env.example /app/.env.example


FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

COPY --from=laravel_installer /app /var/www/app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app

RUN cp .env.example .env && \
    php artisan key:generate && \
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider" && \
    php artisan jwt:secret

CMD ["php-fpm"]
