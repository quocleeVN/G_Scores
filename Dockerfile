FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

ENV RUN_SCRIPTS 0

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN chown -R nginx:nginx /var/www/html/storage \
    && chown -R nginx:nginx /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage

EXPOSE 8080

CMD ["/start.sh"]