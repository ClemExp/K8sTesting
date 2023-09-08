# Use the official PHP 7.4 image as the base
FROM php:7.4-apache
RUN docker-php-ext-install mysqli

# Install SSL libraries
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libssl-dev && \
    rm -rf /var/lib/apt/lists/*

# Enable required Apache modules
RUN a2enmod ssl && \
    a2ensite default-ssl

# Set global servername
RUN echo "ServerName tlson.clemoregan.com" >> /etc/apache2/apache2.conf

# Copy SSL certificate and private key into the container
COPY fullchain.pem /etc/ssl/certs/fullchain.pem
COPY privkey.pem /etc/ssl/certs/privkey.pem

# Configure Apache to use SSL
RUN sed -i 's/#ServerName www.example.com/ServerName tls.clemoregan.com/g' /etc/apache2/sites-available/default-ssl.conf && \
    sed -i 's|etc/ssl/certs/ssl-cert-snakeoil.pem|etc/ssl/certs/fullchain.pem|g' /etc/apache2/sites-available/default-ssl.conf && \
    sed -i 's|etc/ssl/private/ssl-cert-snakeoil.key|etc/ssl/certs/privkey.pem|g' /etc/apache2/sites-available/default-ssl.conf

# Copy in our modified index application page
COPY index.php /var/www/mysite/index.php
COPY index.php /var/www/html/index.php

WORKDIR /var/www/html/

# Expose ports
EXPOSE 80 443

# Start Apache
CMD ["apache2-foreground"]

