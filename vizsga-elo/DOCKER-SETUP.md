# Docker Setup - Laravel Feliratkozás Kezelő Rendszer

## Előfeltételek

- Docker Desktop telepítve és futtatva (Windows/Mac/Linux)
- Git telepítve

## Docker Szolgáltatások

A docker-compose.yml fájl a következő szolgáltatásokat tartalmazza:

- **app** - PHP 8.2-FPM (Laravel alkalmazás)
- **nginx** - Nginx webszerver (port 8000)
- **mysql** - MySQL 8.0 adatbázis (port 3306)
- **redis** - Redis cache és queue backend (port 6379)
- **queue** - Laravel Queue Worker
- **scheduler** - Laravel Task Scheduler

## Első Indítás

### 1. Environment fájl létrehozása

```bash
cp .env.example .env
```

### 2. .env fájl szerkesztése

Állítsd be a következő értékeket a `.env` fájlban:

```env
APP_NAME="Laravel Subscription Manager"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. Docker konténerek építése és indítása

```bash
docker-compose up -d --build
```

### 4. Composer függőségek telepítése

```bash
docker-compose exec app composer install
```

### 5. Application key generálás

```bash
docker-compose exec app php artisan key:generate
```

### 6. Migráció futtatása

```bash
docker-compose exec app php artisan migrate
```

### 7. Adatbázis feltöltése (seeder)

```bash
docker-compose exec app php artisan db:seed
```

### 8. Storage linkek létrehozása

```bash
docker-compose exec app php artisan storage:link
```

### 9. Cache tisztítása

```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
```

## Alkalmazás elérése

Az alkalmazás elérhető a következő címen:
- **Web**: http://localhost:8000

## Hasznos Docker Parancsok

### Konténerek indítása

```bash
docker-compose up -d
```

### Konténerek leállítása

```bash
docker-compose down
```

### Konténerek leállítása és adatok törlése

```bash
docker-compose down -v
```

### Logok megtekintése

```bash
# Minden szolgáltatás
docker-compose logs -f

# Csak az app szolgáltatás
docker-compose logs -f app

# Csak a queue worker
docker-compose logs -f queue

# Csak a scheduler
docker-compose logs -f scheduler
```

### Belépés a konténerbe

```bash
docker-compose exec app bash
```

### MySQL adatbázishoz kapcsolódás

```bash
docker-compose exec mysql mysql -u laravel -p
# Jelszó: secret
```

### Redis CLI használata

```bash
docker-compose exec redis redis-cli
```

## Laravel Parancsok Docker-en keresztül

### Artisan parancsok

```bash
docker-compose exec app php artisan <parancs>
```

Példák:

```bash
# Migráció futtatása
docker-compose exec app php artisan migrate

# Seeder futtatása
docker-compose exec app php artisan db:seed

# Feliratkozások ellenőrzése (kézi)
docker-compose exec app php artisan subscription:check-expiring

# Tinker indítása
docker-compose exec app php artisan tinker

# Cache törlés
docker-compose exec app php artisan cache:clear

# Queue munkák megtekintése
docker-compose exec app php artisan queue:work --once
```

### Composer parancsok

```bash
docker-compose exec app composer <parancs>
```

Példák:

```bash
# Függőségek telepítése
docker-compose exec app composer install

# Autoload frissítése
docker-compose exec app composer dump-autoload

# Package frissítés
docker-compose exec app composer update
```

## Szolgáltatások Újraindítása

### Egyedi szolgáltatás újraindítása

```bash
docker-compose restart app
docker-compose restart nginx
docker-compose restart queue
docker-compose restart scheduler
```

### Minden szolgáltatás újraindítása

```bash
docker-compose restart
```

## Queue Worker és Scheduler

A docker-compose automatikusan elindítja:
- **Queue Worker** - folyamatosan figyeli a queue-t
- **Scheduler** - percenként futtatja a scheduled taskokat

### Queue Worker újraindítása (kód módosítás után)

```bash
docker-compose restart queue
```

### Scheduler újraindítása

```bash
docker-compose restart scheduler
```

## Hibaelhárítás

### Port foglaltsági probléma

Ha a 8000-es port foglalt, módosítsd a `docker-compose.yml` fájlban:

```yaml
nginx:
  ports:
    - "8080:80"  # 8000 helyett 8080
```

### Jogosultsági problémák

```bash
docker-compose exec app chown -R www-data:www-data /var/www/storage
docker-compose exec app chmod -R 775 /var/www/storage
docker-compose exec app chmod -R 775 /var/www/bootstrap/cache
```

### Konténer újraépítése

```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Adatbázis reset

```bash
docker-compose exec app php artisan migrate:fresh --seed
```

## Adatok perzisztálása

A MySQL adatok egy Docker volume-ban tárolódnak (`mysql-data`), így a konténerek újraindítása után is megmaradnak.

### Volume törlése (összes adat elvesztése)

```bash
docker-compose down -v
```

## Fejlesztői Tippek

### Laravel Vite (Frontend assets)

Ha használod a Vite-ot, add hozzá a docker-compose.yml-hez:

```yaml
  vite:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: laravel-vite
    working_dir: /var/www
    command: npm run dev
    ports:
      - "5173:5173"
    volumes:
      - ./:/var/www
    networks:
      - laravel-network
```

### Xdebug használata

Ha Xdebug-ra van szükséged, módosítsd a Dockerfile-t és add hozzá:

```dockerfile
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
```

## Production Környezet

Production környezetben:

1. Állítsd át az `.env` fájlban:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimalizáld a Laravel alkalmazást:
```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
docker-compose exec app composer install --optimize-autoloader --no-dev
```

3. Használj proper mail driver-t (pl. SMTP, Mailgun, stb.)

## Support

Ha problémád van a Docker környezettel:
1. Ellenőrizd a logokat: `docker-compose logs -f`
2. Ellenőrizd, hogy minden konténer fut: `docker-compose ps`
3. Restart minden szolgáltatást: `docker-compose restart`
