# Usa PHP 7.4 como base
FROM php:7.4-cli

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl

# Instala extensiones PHP críticas
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    xml \
    && pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto
COPY . .

# Instala dependencias PHP
RUN composer install --no-autoloader

# Expone el puerto para el servidor PHP
EXPOSE 8000

# Comando para iniciar el servidor
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]