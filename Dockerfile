FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    zip \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring intl xml zip \
    && docker-php-ext-enable xml \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY ./inase_app /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/webroot

WORKDIR /var/www/html

RUN composer install --no-interaction --no-dev --optimize-autoloader