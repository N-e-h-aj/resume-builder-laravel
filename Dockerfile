FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip curl git libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies without scripts
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader --no-scripts

# Copy the application files
COPY . .

# Copy and setup environment file
RUN cp .env.example .env

# Clear cached config
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Generate app key
RUN php artisan key:generate

# Make storage directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

# Install npm dependencies and build assets
RUN npm install && npm run build

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Run Apache in the foreground
CMD ["apache2-foreground"]
