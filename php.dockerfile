FROM php:8.3-fpm-alpine

RUN apk update && apk add --no-cache \
    curl \
    zip \
    unzip \
    oniguruma-dev \
    autoconf \
    gcc \
    make \
    libc-dev \
    mariadb-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        bcmath \
        pcntl \
        exif \
        fileinfo

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
