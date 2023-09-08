FROM php:7.4-apache
RUN docker-php-ext-install mysqli

COPY index.php /var/www/mysite/index.php
COPY index.php /var/www/html/index.php

WORKDIR /var/www/html/

EXPOSE 80

