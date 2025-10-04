FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip nodejs npm libpng-dev libonig-dev libxml2-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

# Install PHP dependencies
RUN composer install

# Install Node dependencies
RUN npm install && npm run build

CMD php artisan serve --host=0.0.0.0 --port=8000
