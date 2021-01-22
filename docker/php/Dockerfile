FROM php:8-fpm-alpine

RUN apk add --update \
    $PHPIZE_DEPS \
    curl \
    libxslt-dev
#	rabbitmq-c-dev
#    && pecl install amqp
#    && docker-php-ext-enable amqp

RUN docker-php-ext-install mysqli pdo pdo_mysql xsl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    ln -s $(composer config --global home) /root/composer

ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

ADD php.ini /etc/php/conf.d/
ADD php.ini /etc/php/cli/conf.d/
ADD php.ini /usr/local/etc/php
ADD php-fpm.conf /etc/php/php-fpm.d/

WORKDIR /var/www/symfony

EXPOSE 9000

CMD ["php-fpm", "-F"]
