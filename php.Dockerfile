FROM php:8.3-fpm-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        nginx \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libmagickwand-dev \
        libicu-dev \
        libxml2-dev \
        libonig-dev \
        mariadb-client \
        unzip \
        curl \
        ca-certificates \
        imagemagick \
        ghostscript \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions needed by WordPress 7 + media handling
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        mysqli \
        pdo_mysql \
        gd \
        intl \
        mbstring \
        exif \
        zip \
        opcache \
        fileinfo \
        bcmath

# Install WP-CLI
RUN curl -sS https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /usr/local/bin/wp-cli \
    && chmod +x /usr/local/bin/wp-cli

# Use our own php.ini overrides
COPY php.ini /usr/local/etc/php/conf.d/wordpress.ini

RUN mkdir -p /var/www/html /var/log/php /var/log/wordpress \
    && chown -R www-data:www-data /var/www/html /var/log/php

# Ensure PHP-FPM listens on the standard port inside the container
RUN sed -i 's|^listen = .*|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf \
    && echo "catch_workers_output = yes" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000

CMD ["php-fpm"]
