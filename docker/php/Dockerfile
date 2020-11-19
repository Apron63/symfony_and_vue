FROM php:7.4-fpm

RUN usermod -u 1000 www-data
RUN chown -R 1000 /var/www/html/

RUN apt-get update && apt-get -y install --no-install-recommends \
    git \
    && docker-php-ext-install pdo_mysql \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \ && chmod +x /usr/local/bin/composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

CMD ["php-fpm"]

EXPOSE 9000
