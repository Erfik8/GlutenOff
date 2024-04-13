#docker/php
FROM php:8.3.5RC1-fpm-alpine3.19

ENV RUN_DEPS \
    zlib \
    libzip \
    libpng \
    libjpeg-turbo \
    postgresql-libs 

ENV BUILD_DEPS \
    zlib-dev \
    libzip-dev \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    postgresql-dev \
    oniguruma-dev \
    libxslt

ENV PHP_EXTENSIONS \
    bcmath \
    pgsql \
    pdo_pgsql \
    zip \
    xsl \
    gd \
    intl \
    opcache \
    exif \
    mbstring

RUN apk --update add --no-cache --virtual .php-ext-install-deps \
        libxslt-dev \
        libgcrypt-dev \
    && apk add --no-cache --virtual .build-deps $BUILD_DEPS \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j "$(nproc)" $PHP_EXTENSIONS \
    && apk del .build-deps

RUN apk add --no-cache --virtual .run-deps $RUN_DEPS

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache bash

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' |bash
RUN apk add symfony-cli

COPY . /app

VOLUME ["/app"]