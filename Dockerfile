FROM php:8.3-cli

# Dependencias de sistema
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libicu-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip intl

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8000


CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]