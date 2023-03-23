ARG PHP_VERSION

FROM php:${PHP_VERSION}-cli-alpine

ARG COMPOSER_VERSION

RUN apk add --no-cache postgresql-dev git bash icu-dev linux-headers \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_pgsql intl \
    && apk del git

RUN curl -sS https://getcomposer.org/installer | php -- --version=${COMPOSER_VERSION} --install-dir=/bin --filename=composer --quiet

COPY ./common/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./production/php/conf.d /usr/local/etc/php/conf.d

WORKDIR /application
