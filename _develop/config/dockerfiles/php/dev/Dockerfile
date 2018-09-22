FROM php:7.2-fpm
MAINTAINER webbag

RUN apt-get update && apt-get install -y libssl-dev libxml2-dev zlib1g-dev libicu-dev libpq-dev libpng-dev libjpeg-dev curl git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql pgsql pdo_mysql \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache \
    && docker-php-ext-install ftp \
    && pecl install apcu \
    && docker-php-ext-enable apcu

RUN docker-php-ext-configure gd --with-gd --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) gd

RUN printf "\
    date.timezone=\"UTC\"\n\
    request_order=GP\n\
    expose_php=Off\n\
    enable_dl=Off\n\
    short_open_tag=Off\n\
    " > /usr/local/etc/php/php.ini

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_output_dir=/tmp/xdebug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable_trigger=1" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-enable xdebug

RUN echo "date.timezone = \"Europe/Warsaw\"" > /usr/local/etc/php/conf.d/datetime.ini

RUN usermod -u 1000 www-data

#COMPOSER
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
