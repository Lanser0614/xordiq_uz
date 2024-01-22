# Use the official PHP 8.2 FPM image
FROM php:8.2-fpm

# Install necessary dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up the Laravel application
WORKDIR /var/www/

# Copy only the composer files first to leverage Docker caching
COPY composer.json composer.lock ./

# Install Laravel dependencies
RUN #composer install --no-scripts --no-autoloader

# Copy the rest of the application files
COPY . .

# Generate the Laravel autoload files
RUN #composer dump-autoload --optimize

