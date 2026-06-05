FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Copy toàn bộ mã nguồn vào container
COPY . .

# Cài đặt các dependencies của Composer (production)
RUN composer install --no-dev --optimize-autoloader

# Cài đặt và build frontend (nếu có sử dụng npm, Vite, Webpack...)
RUN npm install && npm run build || true

# Cache cấu hình, route, view của Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Cấp quyền ghi cho thư mục storage và bootstrap/cache
# User trong image này là 'nginx'
RUN chown -R nginx:nginx /var/www/html/storage \
    && chown -R nginx:nginx /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage

# Expose cổng 8080 (image này mặc định dùng cổng 8080)
EXPOSE 8080

# Image đã có entrypoint tự động khởi chạy Nginx + PHP-FPM