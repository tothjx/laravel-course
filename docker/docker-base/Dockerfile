FROM php:8.3.3-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

RUN a2enmod rewrite

COPY ./src /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
