FROM php:8.0.3-fpm-alpine

RUN apk add --update \
    $PHPIZE_DEPS \
    curl \
    git

RUN docker-php-ext-install mysqli pdo pdo_mysql

#I will use Docker-Php-Extension Installer to handle PHP extensions from now ❤
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
     install-php-extensions @composer amqp xdebug

ADD php.ini /etc/php/conf.d/
ADD php.ini /etc/php/cli/conf.d/
ADD php.ini /usr/local/etc/php
ADD php-fpm.conf /etc/php/php-fpm.d/

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm", "-F"]
