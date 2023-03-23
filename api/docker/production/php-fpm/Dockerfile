ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm-alpine

ARG XDEBUG_VERSION

RUN apk add --no-cache postgresql-dev git icu-dev linux-headers \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_pgsql intl\
    && apk del git

COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./production/php/conf.d /usr/local/etc/php/conf.d

WORKDIR /application
