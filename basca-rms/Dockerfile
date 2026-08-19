# ============================================================
# Stage 1: Build Vite + Tailwind assets
# ============================================================
FROM node:22-alpine AS frontend

WORKDIR /var/www/html

# Copy npm dependency files
COPY package*.json ./

# Install Node dependencies
RUN npm ci

# Copy the complete Laravel project
# Tailwind needs access to Blade files to detect utility classes
COPY . .

# Build production assets
RUN npm run build


# ============================================================
# Stage 2: Laravel application
# ============================================================
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

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

RUN docker-php-ext-install \
    bcmath \
    intl \
    mbstring \
    opcache \
    pdo \
    pdo_pgsql \
    zip

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

RUN mkdir -p storage/app/public
RUN php artisan storage:link

# Copy Vite/Tailwind production assets
COPY --from=frontend /var/www/html/public/build /var/www/html/public/build

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod -R 775 \
    storage \
    bootstrap/cache

RUN docker-php-ext-enable opcache

EXPOSE 10000

CMD ["sh", "-c", "cp /etc/secrets/.env /var/www/html/.env && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=${PORT}"]