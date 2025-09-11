FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip curl git libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only composer files and install dependencies without running scripts
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader --no-scripts

# Copy all application files
COPY . .

# Copy and set up environment
RUN cp .env.example .env

# Generate application key
RUN php artisan key:generate

# Install npm dependencies and build assets
RUN npm install
RUN npm run build

# Run artisan optimizations
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Run Apache in the foreground
CMD ["apache2-foreground"]
