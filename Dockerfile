# Etapa 1: builder com Node
FROM node:20-alpine AS nodebuilder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Etapa 2: PHP + Composer + assets prontos
FROM php:8.3-fpm

ARG user=lucas
ARG uid=1000

# Instala dependências do sistema + libicu-dev para o intl
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    zip \
    unzip \
    && docker-php-ext-install \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        sockets \
        intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Config PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Criação de usuário não-root
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

WORKDIR /var/www
COPY --chown=$user:$user . .

# Copia os assets buildados
COPY --from=nodebuilder /app/public/build ./public/build

USER $user
