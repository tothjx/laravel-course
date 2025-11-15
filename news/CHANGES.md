# AnotherNews - Változások dokumentációja

Ez a dokumentum részletezi az AnotherNews projekt során létrehozott és módosított fájlokat.

---

## 📁 Új fájlok (26 db)

### Database - Migrations (3 db)

#### `database/migrations/2025_11_15_093702_add_fields_to_users_table.php`
**Leírás:** Users tábla kiterjesztése
**Változtatások:**
- `is_admin` boolean mező (default: false)
- `subscribed_to_notifications` boolean mező (default: true)

#### `database/migrations/2025_11_15_093705_create_articles_table.php`
**Leírás:** Articles tábla létrehozása
**Mezők:**
- `id` - primary key
- `user_id` - foreign key (users táblához)
- `title` - string
- `lead` - text (bevezető szöveg)
- `body` - text (max 5000 karakter)
- `timestamps`

#### `database/migrations/2025_11_15_093709_create_notifications_table.php`
**Leírás:** Notifications tábla létrehozása
**Mezők:**
- `id` - primary key
- `email` - string (értesített email címe)
- `article_title` - string (új cikk címe)
- `article_id` - foreign key (articles táblához)
- `timestamps`

---

### Models (2 db)

#### `app/Models/Article.php`
**Leírás:** Article model
**Funkciók:**
- Mass assignment: `user_id`, `title`, `lead`, `body`
- HasFactory trait
- Kapcsolatok:
  - `user()` - belongsTo User
  - `notifications()` - hasMany Notification

#### `app/Models/Notification.php`
**Leírás:** Notification model
**Funkciók:**
- Mass assignment: `email`, `article_title`, `article_id`
- Kapcsolat:
  - `article()` - belongsTo Article

---

### Factories (1 db)

#### `database/factories/ArticleFactory.php`
**Leírás:** Article factory tesztadatokhoz
**Generált adatok:**
- `title` - random mondat (4-8 szó)
- `lead` - random bekezdés
- `body` - 3-8 bekezdés (max 5000 karakter)
- `created_at` - random dátum (utolsó 30 nap)

---

### Controllers (3 db)

#### `app/Http/Controllers/ArticleController.php`
**Leírás:** Article CRUD műveletek
**Metódusok:**
- `index()` - Cikkek listázása (cache-elve 1 órára, 10/oldal)
- `create()` - Új cikk form
- `store()` - Új cikk mentése + ArticleCreated event
- `show()` - Cikk megjelenítése
- `edit()` - Cikk szerkesztő form (szerző vagy admin)
- `update()` - Cikk frissítése
- `destroy()` - Cikk törlése (csak admin)

#### `app/Http/Controllers/UserController.php`
**Leírás:** Felhasználók kezelése
**Metódusok:**
- `index()` - Felhasználók listázása (cikkek számával, 20/oldal)
- `show()` - Felhasználó profil + cikkei

#### `app/Http/Controllers/Auth/LoginController.php`
**Leírás:** Authentikáció kezelése
**Metódusok:**
- `showLoginForm()` - Login form megjelenítése
- `login()` - Belépés kezelése (email + password)
- `logout()` - Kilépés

---

### Requests - Validation (2 db)

#### `app/Http/Requests/StoreArticleRequest.php`
**Leírás:** Új cikk validációja
**Szabályok:**
- `title` - kötelező, max 255 karakter
- `lead` - kötelező
- `body` - kötelező, max 5000 karakter, tiltott szavak ellenőrzése (`fuck`, `shit`, `damn`)
**Jogosultság:** Bejelentkezett felhasználó

#### `app/Http/Requests/UpdateArticleRequest.php`
**Leírás:** Cikk frissítés validációja
**Szabályok:** Ugyanazok mint StoreArticleRequest
**Jogosultság:** Szerző vagy admin

---

### Events & Listeners (2 db)

#### `app/Events/ArticleCreated.php`
**Leírás:** Cikk létrehozása esemény
**Tulajdonságok:**
- `public Article $article` - Az újonnan létrehozott cikk

#### `app/Listeners/QueueArticleNotification.php`
**Leírás:** ArticleCreated esemény kezelője
**Funkció:**
- SendArticleNotification job queue-ba helyezése

---

### Jobs (1 db)

#### `app/Jobs/SendArticleNotification.php`
**Leírás:** Értesítések küldése queue-ban
**Funkció:**
- Feliratkozott felhasználók lekérése
- Minden feliratkozottnak értesítés mentése az adatbázisba
- `email`, `article_title`, `article_id` tárolása

---

### Console Commands (1 db)

#### `app/Console/Commands/NewArticleSaved.php`
**Leírás:** Új cikkek ellenőrzése
**Signature:** `articles:check-new`
**Funkció:**
- Utolsó ellenőrzés óta létrehozott cikkek keresése (cache-ből)
- Minden új cikkhez SendArticleNotification job indítása
- Utolsó ellenőrzés időpontjának frissítése

---

### Views - Layouts (1 db)

#### `resources/views/layouts/app.blade.php`
**Leírás:** Fő layout template
**Elemek:**
- Bootstrap 5 CSS/JS (helyi fájlok)
- Navbar (AnotherNews brand, menüpontok, user dropdown)
- Flash üzenetek (success, error)
- Footer
- Responsive design

---

### Views - Auth (1 db)

#### `resources/views/auth/login.blade.php`
**Leírás:** Belépési form
**Mezők:**
- Email
- Password
- Remember me checkbox
**Extra:** Teszt felhasználók listája

---

### Views - Articles (4 db)

#### `resources/views/articles/index.blade.php`
**Leírás:** Cikkek listázása
**Funkciók:**
- Cikkek lapozással (10/oldal)
- Cím, lead, szerző, dátum megjelenítése
- Szerkesztés/törlés gombok (jogosultság alapján)
- "Új cikk írása" gomb (bejelentkezett usereknek)

#### `resources/views/articles/show.blade.php`
**Leírás:** Egyedi cikk megjelenítése
**Funkciók:**
- Teljes cikk (cím, lead, body)
- Szerző + időbélyeg (óra:perc:másodperc)
- Szerkesztés/törlés gombok (jogosultság alapján)

#### `resources/views/articles/create.blade.php`
**Leírás:** Új cikk form
**Mezők:**
- Title (max 255 karakter)
- Lead (textarea)
- Body (textarea, max 5000 karakter)
**Validáció:** Client-side character limit

#### `resources/views/articles/edit.blade.php`
**Leírás:** Cikk szerkesztő form
**Funkciók:** Ugyanaz mint create, de pre-filled adatokkal

---

### Views - Users (2 db)

#### `resources/views/users/index.blade.php`
**Leírás:** Felhasználók táblázata
**Oszlopok:**
- Név, Email
- Szerepkör (Admin/User badge)
- Cikkek száma
- Értesítés státusz (Feliratkozott/Nem)
**Lapozás:** 20/oldal

#### `resources/views/users/show.blade.php`
**Leírás:** Felhasználó profil
**Funkciók:**
- User alapadatok + badge-ek
- Összes cikke időrendben
- Cikkenkénti preview + link

---

### Assets - Bootstrap (2 db)

#### `public/css/bootstrap.min.css`
**Verzió:** Bootstrap 5.3.3
**Forrás:** CDN-ről letöltve (helyi verzió)

#### `public/js/bootstrap.bundle.min.js`
**Verzió:** Bootstrap 5.3.3
**Forrás:** CDN-ről letöltve (helyi verzió)
**Tartalmaz:** Bootstrap + Popper.js

---

### Documentation (1 db)

#### `README_HU.md`
**Leírás:** Magyar nyelvű projekt dokumentáció
**Tartalom:**
- Áttekintés és funkciók
- Telepítési útmutató
- Használati útmutató
- Belépési adatok
- Artisan parancsok
- Hibaelhárítás
- Projekt struktúra

---

## ✏️ Módosított fájlok (6 db)

### `app/Models/User.php`
**Változtatások:**
- `fillable` bővítése: `is_admin`, `subscribed_to_notifications`
- `casts()` bővítése: boolean típusok
- Új kapcsolat: `articles()` - hasMany Article

---

### `database/factories/UserFactory.php`
**Változtatások:**
- `is_admin` mező: false (alapértelmezett)
- `subscribed_to_notifications` mező: 70% eséllyel true

---

### `database/seeders/DatabaseSeeder.php`
**Változtatások:**
- 2 admin user létrehozása (admin1@example.com, admin2@example.com)
- 18 normál user létrehozása
- 20 article létrehozása random userekhez

---

### `app/Providers/AppServiceProvider.php`
**Változtatások:**
- Import: `Illuminate\Pagination\Paginator`
- Import: `App\Events\ArticleCreated`, `App\Listeners\QueueArticleNotification`
- `boot()` metódus:
  - `Paginator::useBootstrapFive()` - Bootstrap pagination
  - `Event::listen()` - ArticleCreated event listener regisztrálása

---

### `routes/web.php`
**Változtatások:**
- Főoldal átirányítás: `/` → `articles.index`
- Authentication route-ok:
  - GET `/login` - login form
  - POST `/login` - belépés
  - POST `/logout` - kilépés
- Article route-ok:
  - GET `/articles` - public lista
  - GET `/articles/{article}` - public cikk megtekintés
  - Auth middleware csoport:
    - GET `/articles/create` - új cikk form
    - POST `/articles` - cikk mentés
    - GET `/articles/{article}/edit` - szerkesztés
    - PUT `/articles/{article}` - frissítés
    - DELETE `/articles/{article}` - törlés
- User route-ok (auth middleware):
  - GET `/users` - felhasználók listája
  - GET `/users/{user}` - user profil

**FONTOS:** Route sorrend! `/articles/create` ELŐBB van mint `/articles/{article}`

---

### `routes/console.php`
**Változtatások:**
- Import: `Illuminate\Support\Facades\Schedule`
- Scheduled task:
  - `Schedule::command('articles:check-new')->everyMinute()`
  - Percenként fut, ellenőrzi az új cikkeket

---

## 📊 Statisztikák

| Kategória | Új fájlok | Módosított |
|-----------|-----------|------------|
| Migrations | 3 | 0 |
| Models | 2 | 1 |
| Factories | 1 | 1 |
| Seeders | 0 | 1 |
| Controllers | 3 | 0 |
| Requests | 2 | 0 |
| Events/Listeners | 2 | 0 |
| Jobs | 1 | 0 |
| Commands | 1 | 0 |
| Providers | 0 | 1 |
| Routes | 0 | 2 |
| Views | 8 | 0 |
| Assets | 2 | 0 |
| Documentation | 1 | 0 |
| **ÖSSZESEN** | **26** | **6** |

---

## 🎯 Főbb funkciók implementációja

### 1. Migration ✅
- 3 migráció: users kiterjesztés, articles, notifications

### 2. Seeder & Factory ✅
- UserFactory: is_admin, subscribed_to_notifications mezők
- ArticleFactory: title, lead, body generálás
- DatabaseSeeder: 20 user + 20 article

### 3. Cache ✅
- `ArticleController@index`: 1 órás cache
- Cache törlés cikk create/update/delete esetén
- Console Command: cache használata az utolsó ellenőrzéshez

### 4. Console Command ✅
- `articles:check-new`: új cikkek ellenőrzése
- Cache-alapú időkövetés

### 5. Notification ✅
- Notification model + migráció
- Email és article_title mentése adatbázisba

### 6. Queue Job ✅
- `SendArticleNotification`: feliratkozottak értesítése
- ShouldQueue interface implementálva

### 7. Event & Listener ✅
- `ArticleCreated` event cikk létrehozásakor
- `QueueArticleNotification` listener → job dispatching
- AppServiceProvider-ben regisztrálva

### 8. Task Scheduling ✅
- `routes/console.php`: percenkénti futás
- `articles:check-new` command

### 9. Request Validation ✅
- `StoreArticleRequest`: title, lead, body validáció
- `UpdateArticleRequest`: ugyanaz + authorization
- Tiltott szavak: fuck, shit, damn
- Body max 5000 karakter

### 10. Bootstrap 5.3.3 ✅
- Helyi fájlok: `public/css/bootstrap.min.css`, `public/js/bootstrap.bundle.min.js`
- `Paginator::useBootstrapFive()` a pagination-höz
- Responsive layout minden view-ban

---

## 🔐 Jogosultságok

| Művelet | Vendég | User | Admin |
|---------|--------|------|-------|
| Cikkek listázása | ✅ | ✅ | ✅ |
| Cikk megtekintése | ✅ | ✅ | ✅ |
| Új cikk írása | ❌ | ✅ | ✅ |
| Saját cikk szerkesztése | ❌ | ✅ | ✅ |
| Más cikke szerkesztése | ❌ | ❌ | ✅ |
| Cikk törlése | ❌ | ❌ | ✅ |
| Felhasználók listája | ❌ | ✅ | ✅ |
| User profil | ❌ | ✅ | ✅ |

---

## 🚀 Indítási útmutató

```bash
# Adatbázis inicializálás
php artisan migrate:fresh --seed

# Szerver indítása
php artisan serve

# Queue worker (opcionális)
php artisan queue:work

# Scheduler (opcionális, dev környezetben)
php artisan schedule:work
```

**Belépés:**
- Admin: `admin1@example.com` / `password`
- Admin: `admin2@example.com` / `password`
- User: bármely generált email / `password`

---

**Készítve:** 2025-11-15
**Projekt:** AnotherNews Laravel Hírportál
**Verzió:** 1.0.0
