FROM php:8.2-fpm-alpine3.18

RUN apk add --update \
    $PHPIZE_DEPS \
    curl \
    git \
	supervisor

RUN docker-php-ext-install mysqli pdo pdo_mysql

#I will use Docker-Php-Extension Installer to handle PHP extensions from now ❤
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
     install-php-extensions @composer amqp xdebug xsl

ADD php.ini /etc/php/conf.d/
ADD php.ini /etc/php/cli/conf.d/
ADD php.ini /usr/local/etc/php
ADD php-fpm.conf /etc/php/php-fpm.d/

#Supervisor
RUN mkdir -p /var/log/supervisor
RUN mkdir /etc/supervisor.d/
COPY supervisor.ini /etc/supervisor.d/supervisor.ini

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

WORKDIR /var/www

EXPOSE 9000

#CMD ["php-fpm", "-F"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
