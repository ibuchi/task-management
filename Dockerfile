# Use the official PHP image with Apache
# FROM php:latest

# # Install system dependencies and PHP extensions
# RUN apt-get update && apt-get install -y \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     libzip-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install gd zip pdo pdo_mysql

# # Set the working directory
# WORKDIR /var/www/html

# # Copy the application source
# COPY . .

# # Install Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Install application dependencies
# RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# # Set permissions (adjust as needed)
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# # Expose the port that Apache is running on
# EXPOSE 80



FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    build-essential \
    openssl \
    && docker-php-ext-install gd pdo pdo_mysql sockets \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Get the latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# If you need to fix SSL
COPY ./openssl.cnf /etc/ssl/openssl.cnf

# Copy Composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application source
COPY . .

# Expose ports for Nginx (adjust if needed)
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
