# AnotherNews - Laravel Hírportál Alkalmazás

## Áttekintés

Ez egy egyszerű hírportál alkalmazás, amely bemutatja a Laravel keretrendszer különböző funkcióit:

- ✅ **Migration** - Adatbázis struktúra kezelés
- ✅ **Seeder & Factory** - Teszt adatok generálása
- ✅ **Cache** - Cikkek listájának 1 órás cache-elése
- ✅ **Console Command** - Új cikkek ellenőrzése parancssorból
- ✅ **Notification** - Értesítések adatbázisban tárolása
- ✅ **Queue Job** - Háttérben futó értesítés küldés
- ✅ **Event & Listener** - Cikk létrehozásakor eseménykezelés
- ✅ **Task Scheduling** - Percenkénti automatikus új cikk ellenőrzés
- ✅ **Form Request Validation** - Cikk validáció tiltott szavakkal

## Funkciók

### Felhasználói jogosultságok

- **Admin felhasználók**:
  - Bármely cikket szerkeszthetik
  - Cikkeket törölhetik
  - 2 admin user létezik: `admin1@example.com` és `admin2@example.com`

- **Normál felhasználók**:
  - Csak saját cikkeiket szerkeszthetik
  - Új cikkeket írhatnak
  - Megtekinthetik a felhasználók listáját

### Cikkek kezelése

- **Listázás**: 10 cikk/oldal, lapozással
- **Rendezés**: Legfrissebb cikk legfelül
- **Megjelenítés**: Cím, lead, létrehozás dátuma (óra:perc:másodperc), szerző
- **Szerkesztés**: Szerző vagy admin
- **Törlés**: Csak admin

### Értesítési rendszer

Amikor egy új cikk létrejön:
1. **ArticleCreated Event** váltódik ki
2. **QueueArticleNotification Listener** reagál rá
3. **SendArticleNotification Job** a queue-ba kerül
4. Job minden feliratkozott felhasználónak létrehoz egy értesítést az adatbázisban

**Scheduled Task**: Percenként fut egy `articles:check-new` parancs, amely ellenőrzi az új cikkeket.

### Validáció

A cikk létrehozásakor/szerkesztésekor:
- Cím: max 255 karakter
- Lead: kötelező
- Body: max 5000 karakter, tiltott szavak (`fuck`, `shit`, `damn`) nem engedélyezettek

## Telepítés és használat

### 1. Függőségek telepítése

```bash
cd c:/www/laravel-course/news
composer install
```

### 2. Környezeti változók

Az `.env` fájl már be van állítva SQLite adatbázisra.

### 3. Adatbázis inicializálása

```bash
php artisan migrate:fresh --seed
```

Ez létrehoz:
- 20 felhasználót (2 admin, 18 normál)
- 20 cikket

### 4. Alkalmazás indítása

```bash
php artisan serve
```

Az alkalmazás elérhető: http://localhost:8000

### 5. Queue Worker indítása (opcionális)

Ha szeretnéd tesztelni a job-okat:

```bash
php artisan queue:work
```

### 6. Task Scheduler tesztelése (opcionális)

```bash
php artisan schedule:work
```

## Belépési adatok

Minden felhasználó jelszava: `password`

**Admin felhasználók:**
- admin1@example.com / password
- admin2@example.com / password

**Példa normál felhasználó:**
- Bármely más generált email / password

## Használt technológiák

- **Laravel 11.x**
- **Bootstrap 5.3.3** (helyi fájlok a `public` mappában)
- **SQLite** adatbázis
- **Blade** template engine

## Projekt struktúra

```
app/
├── Console/Commands/
│   └── NewArticleSaved.php          # Új cikkek ellenőrzése
├── Events/
│   └── ArticleCreated.php           # Cikk létrehozás esemény
├── Http/
│   ├── Controllers/
│   │   ├── ArticleController.php    # Cikk CRUD
│   │   ├── UserController.php       # Felhasználók
│   │   └── Auth/LoginController.php # Authentikáció
│   └── Requests/
│       ├── StoreArticleRequest.php  # Cikk létrehozás validáció
│       └── UpdateArticleRequest.php # Cikk frissítés validáció
├── Jobs/
│   └── SendArticleNotification.php  # Értesítés küldő job
├── Listeners/
│   └── QueueArticleNotification.php # Event listener
└── Models/
    ├── Article.php
    ├── Notification.php
    └── User.php

resources/views/
├── articles/
│   ├── index.blade.php   # Cikkek listája
│   ├── show.blade.php    # Cikk megjelenítés
│   ├── create.blade.php  # Cikk létrehozás
│   └── edit.blade.php    # Cikk szerkesztés
├── auth/
│   └── login.blade.php   # Belépés
├── users/
│   ├── index.blade.php   # Felhasználók listája
│   └── show.blade.php    # Felhasználó profil
└── layouts/
    └── app.blade.php     # Fő layout

database/
├── migrations/
│   ├── 2025_11_15_093702_add_fields_to_users_table.php
│   ├── 2025_11_15_093705_create_articles_table.php
│   └── 2025_11_15_093709_create_notifications_table.php
└── seeders/
    └── DatabaseSeeder.php
```

## Artisan parancsok

```bash
# Új cikkek ellenőrzése
php artisan articles:check-new

# Scheduled task-ok listája
php artisan schedule:list

# Route-ok listája
php artisan route:list

# Adatbázis újraindítása seed-del
php artisan migrate:fresh --seed

# Cache törlése
php artisan cache:clear
```

## Cache működése

A cikkek listája 1 órára cache-elve van. Amikor új cikk jön létre vagy módosul, a cache automatikusan törlődik.

```php
// ArticleController@index
$articles = Cache::remember('articles_list', 3600, function () {
    return Article::with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
});
```

## Hibaelhárítás

### Bootstrap nem töltődik be

Ellenőrizd, hogy a Bootstrap fájlok léteznek:
- `public/css/bootstrap.min.css`
- `public/js/bootstrap.bundle.min.js`

### Queue job nem fut

Indítsd el a queue worker-t:
```bash
php artisan queue:work
```

### Scheduled task nem fut

Fejlesztési környezetben használd:
```bash
php artisan schedule:work
```

Éles környezetben add hozzá a cron-hoz:
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Licenc

Ez egy oktatási célú projekt.
