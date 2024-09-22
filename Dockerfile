FROM php:latest

# Install system dependencies and PHP extensions
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
