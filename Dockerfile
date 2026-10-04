FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
        git unzip \
        libbz2-dev \
        libpng-dev libjpeg-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install -j$(nproc) \
        bcmath \
        bz2 \
        gd \
        mysqli \
        pdo_mysql

# Opcional mas recomendado em produção
RUN docker-php-ext-enable opcache

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html