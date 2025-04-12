FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    gd \
    intl

# Set working directory
WORKDIR /var/www

# Copy project files into container
COPY . .

# Set correct permissions (after files are copied)
RUN mkdir -p storage/app public storage/framework storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Start PHP-FPM
CMD ["php-fpm"]
