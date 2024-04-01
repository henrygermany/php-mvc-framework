FROM php:8.3.4-apache-bullseye

RUN apt-get update && apt-get install -y \
    build-essential

# Install extensions
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s \
      xdebug pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY environement/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

COPY environement/app.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

WORKDIR /var/www/html
