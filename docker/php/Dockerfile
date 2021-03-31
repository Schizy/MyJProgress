FROM php:8.0.3-fpm-alpine

RUN apk add --update \
    $PHPIZE_DEPS \
    curl \
    git
#    libxslt-dev \
#	rabbitmq-c-dev \
#    && pecl install amqp \
#    && docker-php-ext-enable amqp

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    ln -s $(composer config --global home) /root/composer

ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

#Install x-debug => credit to MilesChou/docker-xdebug
RUN set -xe && \
        docker-php-source extract && \
        pecl install xdebug && \
        docker-php-ext-enable xdebug && \
        docker-php-source delete && \
        php -v && \
        php -m

COPY docker-xdebug-* /usr/local/bin/

ADD php.ini /etc/php/conf.d/
ADD php.ini /etc/php/cli/conf.d/
ADD php.ini /usr/local/etc/php
ADD php-fpm.conf /etc/php/php-fpm.d/

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm", "-F"]
