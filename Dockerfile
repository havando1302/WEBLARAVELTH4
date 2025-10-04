# Sử dụng PHP 8.1 với Apache
FROM php:8.1-apache

# Cài các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    mariadb-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copy mã nguồn vào container
WORKDIR /var/www/html
COPY . .

# Cài dependencies
RUN composer install --optimize-autoloader --no-dev

# Cấp quyền cho Laravel
RUN chmod -R 777 storage bootstrap/cache

# Build frontend (nếu có npm)
# RUN npm install && npm run build

# Expose port
EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
