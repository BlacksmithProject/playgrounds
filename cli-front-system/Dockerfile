ARG PHP_IMAGE=php:8.3-fpm

FROM ${PHP_IMAGE} as php

ARG USER_ID=1000
ARG USER_NAME=php
ARG GROUP_ID=1000
ARG GROUP_NAME=php

RUN groupadd -g ${GROUP_ID} ${GROUP_NAME} \
    && useradd -m -u ${USER_ID} -g ${GROUP_NAME} ${USER_NAME}

# Maj list paquet
RUN apt-get update \
    && apt-get install -y wget make \
    # Xdebug
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    # zip
    && apt-get install -y zlib1g-dev libzip-dev \
    && docker-php-ext-install zip \
    # intl
    && apt-get install -y libicu-dev \
    && docker-php-ext-install intl \
    # Git
    && apt-get -y install git

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# clean
RUN rm -rf /var/lib/apt/lists/* \
    && apt-get clean

ENV PATH "$PATH:/var/www/html/"

USER ${USER_ID}
