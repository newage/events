FROM php:7.3-fpm

ENV COMPOSER_CACHE_DIR=/var/www/.composer-cache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
           libcurl4-openssl-dev \
           libicu-dev \
           libzip-dev \
   && docker-php-ext-install -j$(nproc) json mbstring \
   && docker-php-ext-install -j$(nproc) curl \
   && docker-php-ext-install -j$(nproc) zip \
   && docker-php-ext-install -j$(nproc) pdo pdo_mysql \
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

ARG PUID=
RUN usermod -u ${PUID} www-data \
    && groupmod -g ${PUID} www-data \
    && mkdir -p ${COMPOSER_CACHE_DIR} \
    && chown www-data:www-data ${COMPOSER_CACHE_DIR} \
    && sed -i "s/sudo:x:27:/sudo:x:27:www-data/" /etc/group \
    && echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
VOLUME ${COMPOSER_CACHE_DIR}
ARG PROJECT_PATH=
WORKDIR ${PROJECT_PATH}
USER www-data