FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN if [ -f package.json ]; then npm install && npm run build; else echo "No frontend, skip npm"; fi

RUN chown -R nginx:nginx /var/www/html/storage \
    && chown -R nginx:nginx /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage

EXPOSE 8080
