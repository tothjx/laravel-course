FROM php:8.2-fpm

# Argumentumok
ARG user=laravel
ARG uid=1000

# Munkakönyvtár beállítása
WORKDIR /var/www

# Rendszer függőségek telepítése
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    supervisor

# Felesleges fájlok törlése
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# PHP kiterjesztések telepítése
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Composer telepítése
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Felhasználó létrehozása
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Laravel fájlok másolása
COPY --chown=$user:$user . /var/www

# Jogosultságok beállítása
RUN chown -R $user:$user /var/www
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache

# Váltás a létrehozott felhasználóra
USER $user

# Port expose
EXPOSE 9000

CMD ["php-fpm"]
