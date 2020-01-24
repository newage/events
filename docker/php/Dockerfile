FROM php:7.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
           libcurl4-openssl-dev \
           libicu-dev \
           libzip-dev \
   && docker-php-ext-install -j$(nproc) json mbstring \
   && docker-php-ext-install -j$(nproc) curl \
   && docker-php-ext-install -j$(nproc) zip \
   && rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
   && mv composer.phar /usr/local/bin/composer \
   && chmod +x /usr/local/bin/composer \
   && composer global require hirak/prestissimo

# xDebug
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
;fi
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

ARG PUID=1000
RUN usermod -u ${PUID} www-data
USER www-data