
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libonig-dev libpng-dev \
 && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
