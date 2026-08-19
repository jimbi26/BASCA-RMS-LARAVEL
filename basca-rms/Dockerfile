# ============================================================
# Stage 1: Build Vite assets
# ============================================================
FROM node:22-alpine AS frontend

WORKDIR /var/www/html

# Copy npm dependency files
COPY package*.json ./

# Install Node dependencies
RUN npm ci

# Copy frontend source/config
COPY resources ./resources
COPY vite.config.* ./

# Copy these if they exist in your project
COPY postcss.config.* ./
COPY tailwind.config.* ./

# Build production assets
RUN npm run build


# ============================================================
# Stage 2: Laravel application
# ============================================================
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Install required system packages
RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    zip \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    postgresql-dev

# Install PHP extensions required by Laravel/PostgreSQL
RUN docker-php-ext-install \
    bcmath \
    intl \
    mbstring \
    opcache \
    pdo \
    pdo_pgsql \
    zip

# Use production PHP configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy Composer from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel project
COPY . .

# Install production Composer dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Copy Vite production build from frontend stage
COPY --from=frontend /var/www/html/public/build /var/www/html/public/build

# Create required Laravel directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Set Laravel permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod -R 775 \
    storage \
    bootstrap/cache

# Enable PHP OPcache
RUN docker-php-ext-enable opcache

EXPOSE 10000

# Start Laravel HTTP server
CMD ["sh", "-c", "cp /etc/secrets/.env /var/www/html/.env && php artisan serve --host=0.0.0.0 --port=${PORT}"]