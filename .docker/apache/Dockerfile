FROM php:7.0.10-apache

### composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD ./config/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql && \
    usermod -u 1000 www-data && \
    a2enmod rewrite