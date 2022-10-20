FROM php:8.1-fpm-buster
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libsodium-dev \
    libicu-dev \
    libxml2-dev \
    libmemcached-dev \
    zlib1g-dev \
    && pecl install memcached-3.2.0 \
    && docker-php-source extract \
    && docker-php-ext-install pdo pdo_mysql sodium intl simplexml \
    && docker-php-ext-enable memcached \
    && docker-php-source delete \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www



