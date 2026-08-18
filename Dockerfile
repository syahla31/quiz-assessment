FROM php:8.2-apache

# Install ekstensi sistem & PHP yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Ubah DocumentRoot Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Salin kode proyek
COPY . .

# Install dependencies Laravel & build Tailwind asset
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Atur permission storage & bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port Apache
EXPOSE 80

# Jalankan migrasi dan start Apache
CMD php artisan config:clear && php artisan migrate --force && php artisan db:seed --class=QuizSeeder --force && apache2-foreground
