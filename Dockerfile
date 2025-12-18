FROM php:8.2-cli-alpine

# Instalar dependencias del sistema y extensiones PHP
RUN apk add --no-cache \
    mysql-client \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Exponer puerto
EXPOSE 8000

# Comando por defecto (se sobrescribe en docker-compose)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

