FROM webdevops/php-nginx:8.3

WORKDIR /var/www/html

COPY . .


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN chown -R application:application /var/www/html/storage \
    && chown -R application:application /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage

EXPOSE 8080