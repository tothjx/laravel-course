# Utazáis iroda nyereményjáték - Dokumentáció

## Áttekintés

Ez egy teljes Laravel alapú nyereményjáték rendszer, amely:
- 5 kérdést tartalmaz utazási témában
- Név és email megadást követel
- Automatikusan értékeli a válaszokat
- Megjeleníti az elért eredményt
- Megakadályozza a duplikált jelentkezéseket (egy email csak egyszer játszhat)

## Adatbázis

Az `contest_entries` tábla mezői:

| Mező | Típus | Leírás |
|------|-------|--------|
| `id` | bigint (PK) | Egyedi azonosító |
| `name` | varchar(255) | Résztvevő neve |
| `email` | varchar(255) | Email cím (unique) |
| `answers` | json | A 5 kérdésre adott válaszok tömbje |
| `score` | integer | Elért pontszám (0-5) |
| `created_at` | timestamp | Kitöltés időpontja |
| `updated_at` | timestamp | Módosítás időpontja |

**Indexek:**
- `email` - Gyorsabb duplikáció ellenőrzés
- `score` - Gyorsabb pontszám alapú lekérdezések

## Telepítés

### Migration futtatása

```bash
php artisan migrate
```

## Használat

### URL-ek

- **Nyereményjáték**: `https://yoursite.com/nyeremenyjatek`
- **Beküldés**: `POST https://yoursite.com/nyeremenyjatek/kuldes`
- **Eredmény**: `https://yoursite.com/nyeremenyjatek/eredmeny/{id}`

### Funkciók

1. **Kitöltés**: A felhasználó kitölti a nevet, emailt és válaszol az 5 kérdésre
2. **Validálás**: 
   - Kötelező mezők ellenőrzése
   - Email duplikáció ellenőrzés (unique constraint)
   - Minden kérdésre válasz szükséges
   - Email formátum ellenőrzés
3. **Értékelés**: Automatikus pontozás 0-5 skálán
4. **Eredmény**: Személyre szabott üzenet és emoji az eredmény alapján:
   - Tökéletes teljesítmény (5/5)
   - Kiváló teljesítmény (4+/5)
   - Jó próbálkozás (kevesebb mint 4/5)

## Biztonság

A rendszer tartalmaz:
- CSRF védelem (Laravel beépített)
- Input validálás (név, email, válaszok)
- SQL injection védelem (Eloquent ORM)
- Email duplikáció ellenőrzés (unique index)
- XSS védelem (Blade template engine automatikus escapelés)

## Megjegyzések

- Laravel 12 verzióhoz készült
- A `web.php` fájl már tartalmazhat más route-okat, csak add hozzá az újakat
- Az eredmény oldal a résztvevő adatait is megjeleníti (név, email, dátum)