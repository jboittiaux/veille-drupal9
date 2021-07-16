ARG PHP_VERSION=8

FROM php:${PHP_VERSION}-apache

ENV DRUPAL_VERSION 9.2
ENV APP_DIR /var/www/html

COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev  \
    libpq-dev \
    git

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install -j$(nproc) \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    bcmath \
    mbstring \
    opcache

RUN a2enmod rewrite

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

EXPOSE 80

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]

WORKDIR /var/www/html

CMD ["apache2-foreground"]
