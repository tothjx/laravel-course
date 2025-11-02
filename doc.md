# Laravel (version 12)
* **web:** https://laravel.com/
* **doc:** https://laravel.com/docs/12.x

<pre>
// start: dirname nevű projekt letrehozasa
composer create-project laravel/laravel dirname
</pre>

## Laravel könyvtárstruktúra
<pre>
----------------------------------------------------------------
app/                    Az alkalmazás kódja (model, kontroller, middleware)
app/Console/            Artisan parancsok
app/Exceptions/         Exception kezelés és hibakezelő osztályok
app/Http/               Kontrollerek, middleware-ek, form request-ek
app/Http/Controllers/   HTTP kontrollerek
app/Http/Middleware/    Middleware osztályok
app/Http/Requests/      Form request validációs osztályok
app/Models/             Eloquent modellek
app/Providers/          Service provider-ek az alkalmazás bootstrap-elésére
----------------------------------------------------------------
bootstrap/              Az alkalmazás indítását végző- és a cache file-ok
----------------------------------------------------------------
config/                 Az összes konfigurációs file
----------------------------------------------------------------
database/               Adatbázis könyvtár
database/migrations/    Adatbázis migrációk
database/seeders/       Adatbázis seeder osztályok
database/factories/     Model factory-k teszteléshez
----------------------------------------------------------------
public/                 A webszerver belépési pontja
----------------------------------------------------------------
resources/              View-k, nyers CSS/JS- és nyelvi file-ok
resources/views/        Blade template-ek
resources/css/          CSS forrás file-ok
resources/js/           JavaScript forrás file-ok
----------------------------------------------------------------
routes/                 Az alkalmazás összes route definíciója
----------------------------------------------------------------
storage/                Lefordított Blade template, session, cache és log
storage/app/            Alkalmazás által generált file-ok
storage/app/public/     Publikusan elérhető user-generated file-ok
storage/framework/          Framework által generált- és cache file-ok
storage/framework/cache/    Framework cache
storage/framework/sessions/ Session file-ok
storage/framework/views/    Lefordított Blade view-k
storage/logs/               Log file-ok
----------------------------------------------------------------
tests/                      Automatizált tesztek
----------------------------------------------------------------
vendor/                     Composer függőségek
----------------------------------------------------------------
</pre>

# ARTISAN COMMANDS
A opciók fordítása a **php artisan -help** kimenete alapján, míg a parancsok fordítása a **php artisan list** kimenete alapján készültek.

## Artisan command's options
<pre>
-h, --help              Súgót jelenít meg az adott parancshoz.
                        Ha nincs parancs megadva, akkor a list
                        parancs súgóját jeleníti meg
--silent                Ne írjon ki semmilyen üzenetet
-q, --quiet             Csak a hibák jelennek meg.
                        Minden más kimenet el van nyomva
-V, --version           Megjeleníti az alkalmazás verzióját
--ansi|--no-ansi        Kényszeríti/letiltja az ANSI kimenetet
-n, --no-interaction    Ne tegyen fel semmilyen interaktív kérdést
--env[=ENV]             A környezet, amelyben a parancsnak futnia kell
-v|vv|vvv, --verbose    Növeli az üzenetek részletességét
                        1: a normál kimenethez
                        2: a részletesebb kimenethez
                        3: a debug-hoz
</pre>

## Alapvető parancsok
* **about** Alapvető információkat jelenít meg az alkalmazásról
* **clear-compiled** Eltávolítja a lefordított osztály fájlt
* **completion** Kiírja a shell automatikus kiegészítés szkriptet
* **db** Elindít egy új adatbázis CLI munkamenetet
* **docs** Hozzáférés a Laravel dokumentációhoz
* **down** Karbantartási / demo módba helyezi az alkalmazást
* **env** Megjeleníti az aktuális keretrendszer környezetet
* **help** Súgót jelenít meg egy parancshoz
* **inspire** Inspiráló idézetet jelenít meg
* **list** Parancsok listázása
* **migrate** Lefuttatja az adatbázis migrációkat
* **optimize** Gyorsítótárazza a keretrendszer bootstrap-et, konfigurációt és metaadatokat a teljesítmény növelése érdekében
* **pail** Követi az alkalmazás naplófájljait
* **serve** Kiszolgálja az alkalmazást a PHP development szerveren
* **test** Lefuttatja az alkalmazás tesztjeit
* **tinker** Interakció az alkalmazással
* **up** Kiveszi az alkalmazást karbantartási módból

## Auth parancsok
* **auth:clear-resets** Törli a lejárt jelszó-visszaállítási tokeneket

## Cache parancsok
* **cache:clear** Kiüríti az alkalmazás gyorsítótárát
* **cache:forget** Eltávolít egy elemet a gyorsítótárból
* **cache:prune-stale-tags** Eltávolítja az elavult cache tag-eket a gyorsítótárból (csak Redis)

## Channel parancsok
* **channel:list** Listázza az összes regisztrált privát broadcast csatornát

## Config parancsok
* **config:cache** Gyorsítótár fájlt hoz létre a gyorsabb konfigurációs betöltéshez
* **config:clear** Eltávolítja a konfigurációs gyorsítótár fájlt
* **config:publish** Publikálja a konfigurációs fájlokat az alkalmazásba
* **config:show** Megjeleníti az összes értéket egy adott konfigurációs fájlhoz vagy kulcshoz

## Database parancsok
* **db:monitor** Monitorozza a kapcsolatok számát a megadott adatbázison
* **db:seed** Feltölti az adatbázist rekordokkal
* **db:show** Információkat jelenít meg az adott adatbázisról
* **db:table** Információkat jelenít meg az adott adatbázis táblázatról
* **db:wipe** Eldob minden táblát, view-t és típust

## Env parancsok
* **env:decrypt** Visszafejt egy környezeti fájlt
* **env:encrypt** Titkosít egy környezeti fájlt

## Event parancsok
* **event:cache** Felderíti és gyorsítótárazza az alkalmazás eseményeit és listener-jeit
* **event:clear** Törli az összes gyorsítótárazott eseményt és listener-t
* **event:list** Listázza az alkalmazás eseményeit és listener-eit

## Install parancsok
* **install:api** Létrehoz egy API routes fájlt és telepíti a Laravel Sanctum-ot vagy Laravel Passport-ot
* **install:broadcasting** Létrehoz egy broadcasting channel routes fájlt

## Key parancsok
* **key:generate** Beállítja az alkalmazás kulcsot

## Lang parancsok
* **lang:publish** Publikálja az összes nyelvi fájlt, amelyek testreszabhatók

## Make parancsok
* **make:cache-table [cache:table]** Migrációt hoz létre a cache adatbázis táblához
* **make:cast** Létrehoz egy új egyedi Eloquent cast osztályt
* **make:channel** Létrehoz egy új channel osztályt
* **make:class** Létrehoz egy új osztályt
* **make:command** Létrehoz egy új Artisan parancsot
* **make:component** Létrehoz egy új view component osztályt
* **make:config [config:make]** Létrehoz egy új konfigurációs fájlt
* **make:controller** Létrehoz egy új controller osztályt
* **make:enum** Létrehoz egy új enum-ot
* **make:event** Létrehoz egy új event osztályt
* **make:exception** Létrehoz egy új egyedi exception osztályt
* **make:factory** Létrehoz egy új model factory-t
* **make:interface** Létrehoz egy új interface-t
* **make:job** Létrehoz egy új job osztályt
* **make:job-middleware** Létrehoz egy új job middleware osztályt
* **make:listener** Létrehoz egy új event listener osztályt
* **make:mail** Létrehoz egy új email osztályt
* **make:middleware** Létrehoz egy új HTTP middleware osztályt
* **make:migration** Létrehoz egy új migrációs fájlt
* **make:model** Létrehoz egy új Eloquent model osztályt
* **make:notification** Létrehoz egy új notification osztályt
* **make:notifications-table [notifications:table]** Migrációt hoz létre a notifications táblához
* **make:observer** Létrehoz egy új observer osztályt
* **make:policy** Létrehoz egy új policy osztályt
* **make:provider** Létrehoz egy új service provider osztályt
* **make:queue-batches-table [queue:batches-table]** Migrációt hoz létre a batches adatbázis táblához
* **make:queue-failed-table [queue:failed-table]** Migrációt hoz létre a sikertelen queue job-ok adatbázis táblájához
* **make:queue-table [queue:table]** Migrációt hoz létre a queue job-ok adatbázis táblájához
* **make:request** Létrehoz egy új form request osztályt
* **make:resource** Létrehoz egy új resource-t
* **make:rule** Létrehoz egy új validációs szabályt
* **make:scope** Létrehoz egy új scope osztályt
* **make:seeder** Létrehoz egy új seeder osztályt
* **make:session-table [session:table]** Migrációt hoz létre a session adatbázis táblához
* **make:test** Létrehoz egy új teszt osztályt
* **make:trait** Létrehoz egy új trait-et
* **make:view** Létrehoz egy új view-t

## Migrate parancsok
* **migrate:fresh** Eldob minden táblát és újrafuttatja az összes migrációt
* **migrate:install** Létrehozza a migrációs tárolót
* **migrate:refresh** Visszaállítja és újrafuttatja az összes migrációt
* **migrate:reset** Visszagörgeti az összes adatbázis migrációt
* **migrate:rollback** Visszagörgeti az utolsó adatbázis migrációt
* **migrate:status** Megjeleníti minden migráció állapotát

## Model parancsok
* **model:prune** Eltávolítja a már nem szükséges modelleket
* **model:show** Információkat jelenít meg egy Eloquent modellről

## Optimize parancsok
* **optimize:clear** Eltávolítja a gyorsítótárazott bootstrap fájlokat

## Package parancsok
* **package:discover** Újraépíti a gyorsítótárazott csomag manifest-et

## Queue parancsok
* **queue:clear** Törli az összes job-ot a megadott queue-ból
* **queue:failed** Listázza az összes sikertelen queue job-ot
* **queue:flush** Kiüríti az összes sikertelen queue job-ot
* **queue:forget** Töröl egy sikertelen queue job-ot
* **queue:listen** Figyel egy adott queue-t
* **queue:monitor** Monitorozza a megadott queue-k méretét
* **queue:prune-batches** Eltávolítja az elavult bejegyzéseket a batches adatbázisból
* **queue:prune-failed** Eltávolítja az elavult bejegyzéseket a sikertelen job-ok táblából
* **queue:restart** Újraindítja a queue worker daemon-okat a jelenlegi job után
* **queue:retry** Újrapróbál egy sikertelen queue job-ot
* **queue:retry-batch** Újrapróbálja a sikertelen job-okat egy batch-ben
* **queue:work** Elindítja a job-ok feldolgozását a queue-n daemon-ként

## Route parancsok
* **route:cache** Route gyorsítótár fájlt hoz létre a gyorsabb route regisztrációhoz
* **route:clear** Eltávolítja a route gyorsítótár fájlt
* **route:list** Listázza az összes regisztrált route-ot

## Sail parancsok
* **sail:add** Hozzáad egy szolgáltatást egy meglévő Sail telepítéshez
* **sail:install** Telepíti a Laravel Sail alapértelmezett Docker Compose fájlját
* **sail:publish** Publikálja a Laravel Sail Docker fájljait

## Schedule parancsok
* **schedule:clear-cache** Törli az ütemező által létrehozott gyorsítótárazott mutex fájlokat
* **schedule:interrupt** Megszakítja az aktuális schedule futást
* **schedule:list** Listázza az összes ütemezett feladatot
* **schedule:run** Lefuttatja az ütemezett parancsokat
* **schedule:test** Lefuttat egy ütemezett parancsot
* **schedule:work** Elindítja az ütemező worker-t

## Schema parancsok
* **schema:dump** Kiírja az adott adatbázis sémát

## Storage parancsok
* **storage:link** Létrehozza az alkalmazáshoz konfigurált szimbolikus linkeket
* **storage:unlink** Törli az alkalmazáshoz konfigurált meglévő szimbolikus linkeket

## Stub parancsok
* **stub:publish** Publikálja az összes stub-ot, amelyek testreszabhatók

## Vendor parancsok
* **vendor:publish** Publikálja a vendor csomagokból származó bármilyen publikálható asset-et

## View parancsok
* **view:cache** Lefordítja az alkalmazás összes Blade template-jét
* **view:clear** Törli az összes lefordított view fájlt

# LARAVEL HELPERS (fordítás a dokumentációból)
* **helpers:** https://laravel.com/docs/12.x/helpers

## 1. Array & object helpers
* **Arr::accessible**
Ellenőrzi, hogy egy érték elérhető-e tömbként (tömb vagy ArrayAccess interfészt implementálja).
* **Arr::add**
Hozzáad egy kulcs/érték párt a tömbhöz, ha a kulcs még nem létezik.
* **Arr::array**
Konvertálja az értéket tömbbé, ha még nem az.
* **Arr::boolean**
Lekéri az adott kulcs értékét a tömbből és boolean típusra konvertálja.
* **Arr::collapse**
Egyesít egy tömb-gyűjteményt egyetlen, lapos tömbbé.
* **Arr::crossJoin**
Keresztszorzatot készít a megadott tömbök között.
* **Arr::divide**
Két tömbre bontja a tömböt: az egyik a kulcsokat, a másik az értékeket tartalmazza.
* **Arr::dot**
Laposítja a többdimenziós tömböt pontozott kulcsokkal ellátott egydimenziós tömbbé.
* **Arr::every**
Ellenőrzi, hogy a tömb minden eleme megfelel-e a megadott feltételnek.
* **Arr::except**
Visszaadja a tömb összes elemét a megadott kulcsok kivételével.
* **Arr::exists**
Ellenőrzi, hogy egy adott kulcs létezik-e a tömbben.
* **Arr::first**
Visszaadja az első elemet, amely megfelel a megadott feltételnek.
* **Arr::flatten**
Laposítja a többdimenziós tömböt egydimenziós tömbbé.
* **Arr::float**
Lekéri az adott kulcs értékét a tömbből és float típusra konvertálja.
* **Arr::forget**
Eltávolít egy elemet a tömbből pontozott kulcs használatával.
* **Arr::from**
Létrehoz egy tömböt az átadott értékből, ha még nem tömb, tömbként kezeli.
* **Arr::get**
Lekér egy értéket a tömbből pontozott kulcs használatával, opcionális alapértelmezett értékkel.
* **Arr::has**
Ellenőrzi, hogy egy vagy több kulcs létezik-e a tömbben pontozott jelölés használatával.
* **Arr::hasAll**
Ellenőrzi, hogy az összes megadott kulcs létezik-e a tömbben.
* **Arr::hasAny**
Ellenőrzi, hogy legalább egy a megadott kulcsok közül létezik-e a tömbben.
* **Arr::integer**
Lekéri az adott kulcs értékét a tömbből és integer típusra konvertálja.
* **Arr::isAssoc**
Ellenőrzi, hogy a tömb asszociatív tömb-e (nem szekvenciális numerikus kulcsokkal rendelkezik).
* **Arr::isList**
Ellenőrzi, hogy a tömb lista-e (szekvenciális numerikus kulcsokkal 0-tól kezdődően).
* **Arr::join**
Összefűzi a tömb elemeit stringgé, különböző elválasztókkal az utolsó elem előtt.
* **Arr::keyBy**
Indexeli a tömböt egy adott kulcs vagy callback alapján.
* **Arr::last**
Visszaadja az utolsó elemet, amely megfelel a megadott feltételnek.
* **Arr::map**
Végigiterál a tömbön és minden elemre alkalmazza a callback függvényt.
* **Arr::mapSpread**
Végigiterál a tömbön és minden nested tömb értékeit szétbontva adja át a callback-nek.
* **Arr::mapWithKeys**
Végigiterál a tömbön és a callback által visszaadott kulcs/érték párokból épít új tömböt.
* **Arr::only**
Visszaadja csak a megadott kulcsokhoz tartozó elemeket a tömbből.
* **Arr::partition**
Két tömbre bontja a tömböt: azokra az elemekre, amelyek megfelelnek a feltételnek, és azokra, amelyek nem.
* **Arr::pluck**
Kiemeli az összes megadott kulcshoz tartozó értéket a tömbből.
* **Arr::prepend**
Hozzáad egy elemet a tömb elejéhez, opcionálisan megadott kulccsal.
* **Arr::prependKeysWith**
Előtagot ad minden kulcs elé a tömbben.
* **Arr::pull**
Visszaadja és eltávolítja egy adott kulcs értékét a tömbből.
* **Arr::push**
Hozzáad egy elemet a tömb végéhez, opcionálisan megadott kulccsal.
* **Arr::query**
Konvertálja a tömböt query string formátumúvá.
* **Arr::random**
Visszaad egy vagy több véletlenszerű elemet a tömbből.
* **Arr::reject**
Kiszűri a tömbből azokat az elemeket, amelyek megfelelnek a megadott feltételnek.
* **Arr::select**
Kiválasztja a megadott kulcsokat minden elemből egy többdimenziós tömbben.
* **Arr::set**
Beállít egy értéket a tömbben pontozott kulcs használatával.
* **Arr::shuffle**
Véletlenszerű sorrendbe rendezi a tömb elemeit.
* **Arr::sole**
Visszaadja az egyetlen elemet, amely megfelel a feltételnek, vagy hibát dob, ha nincs vagy több van.
* **Arr::some**
Alias az exists metódushoz, ellenőrzi a kulcs létezését.
* **Arr::sort**
Rendezi a tömböt értékek szerint növekvő sorrendbe.
* **Arr::sortDesc**
Rendezi a tömböt értékek szerint csökkenő sorrendbe.
* **Arr::sortRecursive**
Rekurzívan rendezi a tömböt és az összes al-tömbjét.
* **Arr::string**
Lekéri az adott kulcs értékét a tömbből és string típusra konvertálja.
* **Arr::take**
Visszaadja a tömb első n elemét (negatív szám esetén az utolsó n elemet).
* **Arr::toCssClasses**
Konvertálja a tömböt CSS osztályok stringjévé, feltételesen hozzáadva osztályokat.
* **Arr::toCssStyles**
Konvertálja a tömböt CSS style attribútum stringgé.
* **Arr::undot**
Kibontja a pontozott kulcsokkal ellátott lapos tömböt többdimenziós tömbbé.
* **Arr::where**
Szűri a tömböt egy adott kulcs/érték pár alapján.
* **Arr::whereNotNull**
Kiszűri a null értékeket a tömbből.
* **Arr::wrap**
Becsomagolja az értéket tömbbe, ha még nem tömb (null esetén üres tömböt ad vissza).
* **data_fill**
Kitölti a hiányzó értékeket egy tömbben vagy objektumban pontozott kulcs használatával.
* **data_get**
Lekér egy értéket tömbből vagy objektumból pontozott kulcs használatával, alapértelmezett értékkel.
* **data_set**
Beállít egy értéket tömbben vagy objektumban pontozott kulcs használatával.
* **data_forget**
Eltávolít egy értéket tömbből vagy objektumból pontozott kulcs használatával.
* **head**
Visszaadja a tömb első elemét.
* **last**
Visszaadja a tömb utolsó elemét.

## 2. Number helpers
* **Number::abbreviate**
Rövidíti a számot emberileg olvasható formátumra (pl. 1000 → 1K, 1000000 → 1M).
* **Number::clamp**
Korlátozza a számot egy minimum és maximum érték közé.
* **Number::currency**
Formázza a számot pénznem formátumban a megadott valutával és lokalizációval.
* **Number::defaultCurrency**
Beállítja az alapértelmezett pénznemet az alkalmazás számára.
* **Number::defaultLocale**
Beállítja az alapértelmezett lokalizációt a számformázáshoz.
* **Number::fileSize**
Konvertálja a bájtban megadott méretet emberileg olvasható fájlméret formátumra (pl. 1024 → 1 KB).
* **Number::forHumans**
Formázza a számot emberileg olvasható formátumra rövidítésekkel és precizitással.
* **Number::format**
Formázza a számot a megadott lokalizáció szerint tizedesjegyekkel és ezres elválasztókkal.
* **Number::ordinal**
Visszaadja a szám sorszám utótagját (pl. 1 → st, 2 → nd, 3 → rd, 4 → th).
* **Number::pairs**
Visszaadja a számot minimum-maximum párként (pl. pagináláshoz használható tartományok).
* **Number::parseInt**
Konvertálja az értéket integer típusra, kezelve a null értékeket is.
* **Number::parseFloat**
Konvertálja az értéket float típusra, kezelve a null értékeket is.
* **Number::percentage**
Formázza a számot százalék formátumban a megadott precizitással.
* **Number::spell**
Kiírja a számot szavakkal a megadott lokalizáció szerint (pl. 123 → "one hundred twenty-three").
* **Number::spellOrdinal**
Kiírja a sorszámot szavakkal a megadott lokalizáció szerint (pl. 1 → "first").
* **Number::trim**
Eltávolítja a felesleges nullákat a szám végéről a formázás után.
* **Number::useLocale**
Beállítja az alapértelmezett lokalizációt az összes további Number művelethez.
* **Number::withLocale**
Átmenetileg beállít egy lokalizációt egyetlen művelethez callback-ben.
* **Number::useCurrency**
Beállítja az alapértelmezett pénznemet az összes további Number művelethez.
* **Number::withCurrency**
Átmenetileg beállít egy pénznemet egyetlen művelethez callback-ben.

## 3. Path helpers
* **app_path**
Visszaadja az app könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **base_path**
Visszaadja a projekt gyökérkönyvtárának teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **config_path**
Visszaadja a config könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **database_path**
Visszaadja a database könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **lang_path**
Visszaadja a lang (nyelvi fájlok) könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **public_path**
Visszaadja a public könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **resource_path**
Visszaadja a resources könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.
* **storage_path**
Visszaadja a storage könyvtár teljes elérési útvonalát, opcionálisan hozzáfűzve egy relatív útvonalat.

## 4. URL helpers
* **action**
Generál egy URL-t egy adott controller action-höz a megadott paraméterekkel.
* **asset**
Generál egy URL-t egy asset fájlhoz a public könyvtárban az alkalmazás URL-jét használva.
* **route**
Generál egy URL-t egy megnevezett route-hoz a megadott paraméterekkel.
* **secure_asset**
Generál egy HTTPS URL-t egy asset fájlhoz a public könyvtárban.
* **secure_url**
Generál egy teljesen minősített HTTPS URL-t a megadott útvonalhoz.
* **to_action**
Alias az action() helper-hez, URL-t generál controller action-höz (elavult, használd az action()-t).
* **to_route**
Alias a route() helper-hez, URL-t generál megnevezett route-hoz (elavult, használd a route()-ot).
* **uri**
Alias az url() helper-hez, URL-t generál a megadott útvonalhoz (elavult, használd az url()-t).
* **url**
Generál egy teljesen minősített URL-t a megadott útvonalhoz, vagy visszaadja az URL generator instance-t.

## 5. Miscellaneous helpers
* **abort**
Dob egy HTTP kivételt a megadott státuszkóddal és opcionális üzenettel.
* **abort_if**
Dob egy HTTP kivételt, ha a megadott feltétel igaz.
* **abort_unless**
Dob egy HTTP kivételt, ha a megadott feltétel hamis.
* **app**
Visszaadja a service container instance-t vagy felold egy binding-ot a containerből.
* **auth**
Visszaadja az authenticator instance-t vagy az aktuálisan bejelentkezett felhasználót.
* **back**
Generál egy redirect választ a felhasználó előző helyére.
* **bcrypt**
Hash-eli a megadott értéket bcrypt algoritmussal.
* **blank**
Ellenőrzi, hogy egy érték "üres"-e (null, üres string, üres tömb, stb.).
* **broadcast**
Broadcast-ol egy eseményt a megadott csatornákra.
* **broadcast_if**
Broadcast-ol egy eseményt, ha a megadott feltétel igaz.
* **broadcast_unless**
Broadcast-ol egy eseményt, ha a megadott feltétel hamis.
* **cache**
Lekér vagy beállít értékeket a cache-ben, vagy visszaadja a cache instance-t.
* **class_uses_recursive**
Visszaadja az összes trait-et, amit egy osztály használ, beleértve a szülő osztályok trait-jeit is.
* **collect**
Létrehoz egy collection instance-t a megadott tömbből vagy értékből.
* **config**
Lekér vagy beállít konfigurációs értékeket pontozott kulcs használatával.
* **context**
Lekéri vagy beállítja a context adatokat a naplózáshoz és nyomkövetéshez.
* **cookie**
Létrehoz egy új cookie instance-t a megadott paraméterekkel.
* **csrf_field**
Generál egy rejtett HTML input mezőt a CSRF token számára.
* **csrf_token**
Visszaadja az aktuális CSRF token értékét.
* **decrypt**
Visszafejti a megadott értéket Laravel titkosítójával.
* **dd**
"Dump and die" - kiírja a változókat és leállítja a szkript futását.
* **dispatch**
Dispatch-el egy job-ot a queue-ba feldolgozásra.
* **dispatch_sync**
Azonnal, szinkron módon hajt végre egy job-ot a queue nélkül.
* **dump**
Kiírja a megadott változók tartalmát debug céljából (nem állítja le a futást).
* **encrypt**
Titkosítja a megadott értéket Laravel titkosítójával.
* **env**
Lekéri egy környezeti változó értékét opcionális alapértelmezett értékkel.
* **event**
Dispatch-el egy eseményt vagy esemény halmazot a listener-ekhez.
* **fake**
Visszaad egy Faker instance-t véletlenszerű test adatok generálásához.
* **filled**
Ellenőrzi, hogy egy érték "kitöltött"-e (nem üres és nem null).
* **info**
Információs szintű üzenetet ír a naplóba.
* **literal**
Létrehoz egy literal objektumot PHP 8.3+ literális típus támogatásához.
* **logger**
Visszaadja a logger instance-t vagy naplóz egy debug üzenetet.
* **method_field**
Generál egy rejtett HTML input mezőt a HTTP metódus felülírásához (PUT, PATCH, DELETE).
* **now**
Visszaad egy Carbon instance-t az aktuális időponttal.
* **old**
Lekéri a korábbi form input értéket a session-ből (form újraküldés után).
* **once**
Biztosítja, hogy egy callback csak egyszer fusson le, még többszöri hívás esetén is.
* **optional**
Lehetővé teszi property-k és metódusok hívását egy objektumon null-safe módon.
* **policy**
Lekéri a policy instance-t egy adott osztályhoz.
* **redirect**
Létrehoz egy redirect response instance-t a megadott útvonalra.
* **report**
Bejelent egy kivételt az exception handler-nek anélkül, hogy megjelenítené.
* **report_if**
Bejelent egy kivételt, ha a megadott feltétel igaz.
* **report_unless**
Bejelent egy kivételt, ha a megadott feltétel hamis.
* **request**
Visszaadja az aktuális request instance-t vagy lekér egy input értéket.
* **rescue**
Megpróbál végrehajtani egy callback-et és visszaad egy alapértelmezett értéket hiba esetén.
* **resolve**
Felold egy osztályt vagy interface-t a service containerből.
* **response**
Létrehoz egy response instance-t vagy visszaadja a response factory-t.
* **retry**
Újrapróbálkozik egy callback végrehajtásával megadott számú alkalommal kivétel esetén.
* **session**
Lekér vagy beállít session értékeket, vagy visszaadja a session instance-t.
* **tap**
Meghív egy callback-et az adott értékkel, majd visszaadja az eredeti értéket (method chaining).
* **throw_if**
Dob egy kivételt, ha a megadott feltétel igaz.
* **throw_unless**
Dob egy kivételt, ha a megadott feltétel hamis.
* **today**
Visszaad egy Carbon instance-t a mai napra, idő nélkül (00:00:00).
* **trait_uses_recursive**
Visszaadja az összes trait-et, amit egy trait használ, rekurzívan.
* **transform**
Alkalmaz egy callback-et az értékre, ha az nem üres, egyébként visszaadja az alapértelmezett értéket.
* **validator**
Létrehoz egy új validator instance-t a megadott adatokkal és szabályokkal.
* **value**
Visszaadja az érték alapértelmezett értékét, ha Closure, akkor meghívja.
* **view**
Renderel egy view template-et a megadott adatokkal vagy visszaadja a view factory-t.
* **with**
Alias a tap() helper-hez, visszaadja az értéket callback végrehajtása után (elavult).
* **when**
Feltételesen hajt végre egy callback-et, ha a feltétel igaz (használható chaining-hez is).

# STRINGS (fordítás a dokumentációból)
* **strings:** https://laravel.com/docs/12.x/strings

Ezek is helper-ek, de külön fejezetben szerepelnek.

## Általános helper-ek
* **__** Lefordítja a megadott fordítási kulcsot a nyelvi fájlok alapján.
* **class_basename** Visszaadja az osztály nevét a namespace nélkül.
* **e** HTML escape-eli a megadott stringet a XSS támadások ellen.
* **preg_replace_array** Szekvenciálisan helyettesíti a mintákat egy tömbben a stringben.
* **Str::after** Visszaadja a string azon részét, ami a megadott érték után következik.
* **Str::afterLast** Visszaadja a string azon részét, ami a megadott érték utolsó előfordulása után következik.
* **Str::apa** Konvertálja a stringet APA stílusú címsorba (title case).
* **Str::ascii** Átalakítja a stringet ASCII karakterekké, eltávolítva az ékezeteket.
* **Str::before** Visszaadja a string azon részét, ami a megadott érték előtt van.
* **Str::beforeLast** Visszaadja a string azon részét, ami a megadott érték utolsó előfordulása előtt van.
* **Str::between** Visszaadja a string két érték között lévő részét.
* **Str::betweenFirst** Visszaadja a string két érték első előfordulása között lévő legkisebb részét.
* **Str::camel** Konvertálja a stringet camelCase formátumra.
* **Str::charAt** Visszaadja a karaktert a megadott indexen.
* **Str::chopStart** Eltávolítja a megadott előtagot a string elejéről, ha létezik.
* **Str::chopEnd** Eltávolítja a megadott utótagot a string végéről, ha létezik.
* **Str::contains** Ellenőrzi, hogy a string tartalmazza-e a megadott értéket vagy értékeket.
* **Str::containsAll** Ellenőrzi, hogy a string tartalmazza-e az összes megadott értéket.
* **Str::doesntContain** Ellenőrzi, hogy a string nem tartalmazza-e a megadott értéket.
* **Str::doesntEndWith** Ellenőrzi, hogy a string nem végződik-e a megadott értékkel.
* **Str::doesntStartWith** Ellenőrzi, hogy a string nem kezdődik-e a megadott értékkel.
* **Str::deduplicate** Eltávolítja az ismétlődő karaktereket a stringből.
* **Str::endsWith** Ellenőrzi, hogy a string a megadott értékkel végződik-e.
* **Str::excerpt** Kivonatot készít a stringből egy adott kifejezés körül.
* **Str::finish** Hozzáadja a megadott értéket a string végéhez, ha még nem végződik azzal.
* **Str::fromBase64** Dekódolja a Base64 kódolt stringet.
* **Str::headline** Konvertálja a stringet olvasható címsor formátumra szóközökkel elválasztva.
* **Str::inlineMarkdown** Konvertálja a Markdown stringet inline HTML-lé (blokk elemek nélkül).
* **Str::is** Ellenőrzi, hogy a string megfelel-e a megadott mintának (wildcard támogatással).
* **Str::isAscii** Ellenőrzi, hogy a string csak ASCII karaktereket tartalmaz-e.
* **Str::isJson** Ellenőrzi, hogy a string érvényes JSON-e.
* **Str::isUlid** Ellenőrzi, hogy a string érvényes ULID-e.
* **Str::isUrl** Ellenőrzi, hogy a string érvényes URL-e.
* **Str::isUuid** Ellenőrzi, hogy a string érvényes UUID-e.
* **Str::kebab** Konvertálja a stringet kebab-case formátumra.
* **Str::lcfirst** Kisbetűssé alakítja a string első karakterét.
* **Str::length** Visszaadja a string hosszát (multibyte biztos).
* **Str::limit** Levágja a stringet a megadott hosszra és hozzáad egy végződést.
* **Str::lower** Kisbetűssé alakítja a stringet.
* **Str::markdown** Konvertálja a Markdown stringet HTML-lé.
* **Str::mask** Maszkol egy string egy részét ismétlődő karakterekkel.
* **Str::match** Visszaadja az első egyezést a megadott regex mintával.
* **Str::matchAll** Visszaadja az összes egyezést a megadott regex mintával.
* **Str::orderedUuid** Generál egy időbélyeggel rendezett UUID-t.
* **Str::padBoth** Kitölti a stringet mindkét oldalon a megadott hosszig.
* **Str::padLeft** Kitölti a stringet balról a megadott hosszig.
* **Str::padRight** Kitölti a stringet jobbról a megadott hosszig.
* **Str::password** Generál egy biztonságos véletlenszerű jelszót.
* **Str::plural** Többes számúvá alakítja a szót.
* **Str::pluralStudly** Többes számúvá alakítja a szót StudlyCase formátumban.
* **Str::position** Megkeresi egy substring első előfordulásának pozícióját.
* **Str::random** Generál egy véletlenszerű stringet a megadott hosszal.
* **Str::remove** Eltávolítja a megadott értéket vagy értékeket a stringből.
* **Str::repeat** Megismétli a stringet a megadott számszor.
* **Str::replace** Helyettesíti a megadott értéket a stringben.
* **Str::replaceArray** Szekvenciálisan helyettesíti a megadott értéket egy tömbből.
* **Str::replaceFirst** Helyettesíti a megadott érték első előfordulását a stringben.
* **Str::replaceLast** Helyettesíti a megadott érték utolsó előfordulását a stringben.
* **Str::replaceMatches** Helyettesíti a regex mintához illeszkedő részeket callback használatával.
* **Str::replaceStart** Helyettesíti a string elejét, ha az megegyezik a megadott értékkel.
* **Str::replaceEnd** Helyettesíti a string végét, ha az megegyezik a megadott értékkel.
* **Str::reverse** Megfordítja a stringet.
* **Str::singular** Egyes számúvá alakítja a szót.
* **Str::slug** Generál egy URL-barát "slug"-ot a stringből.
* **Str::snake** Konvertálja a stringet snake_case formátumra.
* **Str::squish** Eltávolítja a felesleges whitespace-eket a stringből és normalizálja a szóközöket.
* **Str::start** Hozzáadja a megadott értéket a string elejéhez, ha még nem kezdődik azzal.
* **Str::startsWith** Ellenőrzi, hogy a string a megadott értékkel kezdődik-e.
* **Str::studly** Konvertálja a stringet StudlyCase (PascalCase) formátumra.
* **Str::substr** Visszaadja a string egy részét a megadott pozíciótól és hosszig.
* **Str::substrCount** Megszámolja egy substring előfordulásainak számát.
* **Str::substrReplace** Helyettesít egy string egy részét egy másik stringgel.
* **Str::swap** Felcseréli több érték előfordulását a stringben egy asszociatív tömb alapján.
* **Str::take** Kiveszi a megadott számú karaktert a string elejéről (negatív szám esetén a végéről).
* **Str::title** Konvertálja a stringet Title Case formátumra.
* **Str::toBase64** Kódolja a stringet Base64 formátumba.
* **Str::transliterate** Átírja a stringet a legközelebbi ASCII reprezentációjára.
* **Str::trim** Eltávolítja a whitespace-eket (vagy más karaktereket) a string elejéről és végéről.
* **Str::ltrim** Eltávolítja a whitespace-eket (vagy más karaktereket) a string elejéről.
* **Str::rtrim** Eltávolítja a whitespace-eket (vagy más karaktereket) a string végéről.
* **Str::ucfirst** Nagybetűssé alakítja a string első karakterét.
* **Str::ucsplit** Felbontja a stringet tömbre minden nagybetűnél.
* **Str::upper** Nagybetűssé alakítja a stringet.
* **Str::ulid** Generál egy ULID-t (Universally Unique Lexicographically Sortable Identifier).
* **Str::unwrap** Eltávolítja a megadott stringeket a string elejéről és végéről.
* **Str::uuid** Generál egy UUID-t (version 4).
* **Str::uuid7** Generál egy UUID-t (version 7, időbélyeggel rendezett).
* **Str::wordCount** Megszámolja a szavak számát a stringben.
* **Str::wordWrap** Sortöréseket helyez a stringbe a megadott karakter szélességnél.
* **Str::words** Korlátozza a stringben lévő szavak számát.
* **Str::wrap** Becsomagolja a stringet a megadott stringekkel mindkét oldalon.
* **str** Létrehoz egy Stringable instance-t a megadott stringből (method chaining-hez).
* **trans** Lefordítja a megadott fordítási kulcsot (alias a `__()` függvényhez).
* **trans_choice** Lefordítja a megadott fordítási kulcsot ragozással többes szám figyelembevételével.

## Fluent helper-ek
* **after** Visszaadja a string azon részét, ami a megadott érték után következik.
* **afterLast** Visszaadja a string azon részét, ami a megadott érték utolsó előfordulása után következik.
* **apa** Konvertálja a stringet APA stílusú címsorba (title case).
* **append** Hozzáfűz egy vagy több értéket a string végéhez.
* **ascii** Átalakítja a stringet ASCII karakterekké, eltávolítva az ékezeteket.
* **basename** Visszaadja a fájlnév részét egy fájl elérési útvonalból.
* **before** Visszaadja a string azon részét, ami a megadott érték előtt van.
* **beforeLast** Visszaadja a string azon részét, ami a megadott érték utolsó előfordulása előtt van.
* **between** Visszaadja a string két érték között lévő részét.
* **betweenFirst** Visszaadja a string két érték első előfordulása között lévő legkisebb részét.
* **camel** Konvertálja a stringet camelCase formátumra.
* **charAt** Visszaadja a karaktert a megadott indexen.
* **classBasename** Visszaadja az osztály nevét a namespace nélkül.
* **chopStart** Eltávolítja a megadott előtagot a string elejéről, ha létezik.
* **chopEnd** Eltávolítja a megadott utótagot a string végéről, ha létezik.
* **contains** Ellenőrzi, hogy a string tartalmazza-e a megadott értéket vagy értékeket.
* **containsAll** Ellenőrzi, hogy a string tartalmazza-e az összes megadott értéket.
* **decrypt** Visszafejti a titkosított stringet.
* **deduplicate** Eltávolítja az ismétlődő karaktereket a stringből.
* **dirname** Visszaadja a szülő könyvtár részét egy fájl elérési útvonalból.
* **doesntEndWith** Ellenőrzi, hogy a string nem végződik-e a megadott értékkel.
* **doesntStartWith** Ellenőrzi, hogy a string nem kezdődik-e a megadott értékkel.
* **encrypt** Titkosítja a stringet.
* **endsWith** Ellenőrzi, hogy a string a megadott értékkel végződik-e.
* **exactly** Ellenőrzi, hogy a string pontosan megegyezik-e a megadott stringgel.
* **excerpt** Kivonatot készít a stringből egy adott kifejezés körül.
* **explode** Felbontja a stringet tömbre a megadott elválasztó mentén.
* **finish** Hozzáadja a megadott értéket a string végéhez, ha még nem végződik azzal.
* **fromBase64** Dekódolja a Base64 kódolt stringet.
* **hash** Generál egy hash-t a stringből a megadott algoritmussal.
* **headline** Konvertálja a stringet olvasható címsor formátumra szóközökkel elválasztva.
* **inlineMarkdown** Konvertálja a Markdown stringet inline HTML-lé (blokk elemek nélkül).
* **is** Ellenőrzi, hogy a string megfelel-e a megadott mintának (wildcard támogatással).
* **isAscii** Ellenőrzi, hogy a string csak ASCII karaktereket tartalmaz-e.
* **isEmpty** Ellenőrzi, hogy a string üres-e.
* **isNotEmpty** Ellenőrzi, hogy a string nem üres-e.
* **isJson** Ellenőrzi, hogy a string érvényes JSON-e.
* **isUlid** Ellenőrzi, hogy a string érvényes ULID-e.
* **isUrl** Ellenőrzi, hogy a string érvényes URL-e.
* **isUuid** Ellenőrzi, hogy a string érvényes UUID-e.
* **kebab** Konvertálja a stringet kebab-case formátumra.
* **lcfirst** Kisbetűssé alakítja a string első karakterét.
* **length** Visszaadja a string hosszát (multibyte biztos).
* **limit** Levágja a stringet a megadott hosszra és hozzáad egy végződést.
* **lower** Kisbetűssé alakítja a stringet.
* **markdown** Konvertálja a Markdown stringet HTML-lé.
* **mask** Maszkol egy string egy részét ismétlődő karakterekkel.
* **match** Visszaadja az első egyezést a megadott regex mintával.
* **matchAll** Visszaadja az összes egyezést a megadott regex mintával.
* **isMatch** Ellenőrzi, hogy a string illeszkedik-e a megadott regex mintára.
* **newLine** Hozzáfűz egy vagy több új sor karaktert a string végéhez.
* **padBoth** Kitölti a stringet mindkét oldalon a megadott hosszig.
* **padLeft** Kitölti a stringet balról a megadott hosszig.
* **padRight** Kitölti a stringet jobbról a megadott hosszig.
* **pipe** Átadja a stringet egy callback függvénynek és visszaadja az eredményt.
* **plural** Többes számúvá alakítja a szót.
* **position** Megkeresi egy substring első előfordulásának pozícióját.
* **prepend** Hozzáad egy vagy több értéket a string elejéhez.
* **remove** Eltávolítja a megadott értéket vagy értékeket a stringből.
* **repeat** Megismétli a stringet a megadott számszor.
* **replace** Helyettesíti a megadott értéket a stringben.
* **replaceArray** Szekvenciálisan helyettesíti a megadott értéket egy tömbből.
* **replaceFirst** Helyettesíti a megadott érték első előfordulását a stringben.
* **replaceLast** Helyettesíti a megadott érték utolsó előfordulását a stringben.
* **replaceMatches** Helyettesíti a regex mintához illeszkedő részeket callback használatával.
* **replaceStart** Helyettesíti a string elejét, ha az megegyezik a megadott értékkel.
* **replaceEnd** Helyettesíti a string végét, ha az megegyezik a megadott értékkel.
* **scan** Elemzi a stringet egy formátum string alapján és visszaadja a találatokat.
* **singular** Egyes számúvá alakítja a szót.
* **slug** Generál egy URL-barát "slug"-ot a stringből.
* **snake** Konvertálja a stringet snake_case formátumra.
* **split** Felbontja a stringet tömbre a megadott minta vagy delimiter mentén.
* **squish** Eltávolítja a felesleges whitespace-eket a stringből és normalizálja a szóközöket.
* **start** Hozzáadja a megadott értéket a string elejéhez, ha még nem kezdődik azzal.
* **startsWith** Ellenőrzi, hogy a string a megadott értékkel kezdődik-e.
* **stripTags** Eltávolítja a HTML és PHP tag-eket a stringből.
* **studly** Konvertálja a stringet StudlyCase (PascalCase) formátumra.
* **substr** Visszaadja a string egy részét a megadott pozíciótól és hosszig.
* **substrReplace** Helyettesít egy string egy részét egy másik stringgel.
* **swap** Felcseréli több érték előfordulását a stringben egy asszociatív tömb alapján.
* **take** Kiveszi a megadott számú karaktert a string elejéről (negatív szám esetén a végéről).
* **tap** Átadja a stringet egy callback-nek anélkül, hogy módosítaná az eredeti stringet.
* **test** Ellenőrzi, hogy a string illeszkedik-e a megadott regex mintára.
* **title** Konvertálja a stringet Title Case formátumra.
* **toBase64** Kódolja a stringet Base64 formátumba.
* **toHtmlString** Konvertálja a stringet HtmlString instance-szá.
* **toUri** Konvertálja a stringet URI komponenssé (URL encoding).
* **transliterate** Átírja a stringet a legközelebbi ASCII reprezentációjára.
* **trim** Eltávolítja a whitespace-eket (vagy más karaktereket) a string elejéről és végéről.
* **ltrim** Eltávolítja a whitespace-eket (vagy más karaktereket) a string elejéről.
* **rtrim** Eltávolítja a whitespace-eket (vagy más karaktereket) a string végéről.
* **ucfirst** Nagybetűssé alakítja a string első karakterét.
* **ucsplit** Felbontja a stringet tömbre minden nagybetűnél.
* **unwrap** Eltávolítja a megadott stringeket a string elejéről és végéről.
* **upper** Nagybetűssé alakítja a stringet.
* **when** Feltételesen hajt végre egy callback-et, ha a feltétel igaz.
* **whenContains** Callback-et hajt végre, ha a string tartalmazza a megadott értéket.
* **whenContainsAll** Callback-et hajt végre, ha a string tartalmazza az összes megadott értéket.
* **whenDoesntEndWith** Callback-et hajt végre, ha a string nem végződik a megadott értékkel.
* **whenDoesntStartWith** Callback-et hajt végre, ha a string nem kezdődik a megadott értékkel.
* **whenEmpty** Callback-et hajt végre, ha a string üres.
* **whenNotEmpty** Callback-et hajt végre, ha a string nem üres.
* **whenStartsWith** Callback-et hajt végre, ha a string a megadott értékkel kezdődik.
* **whenEndsWith** Callback-et hajt végre, ha a string a megadott értékkel végződik.
* **whenExactly** Callback-et hajt végre, ha a string pontosan megegyezik a megadott értékkel.
* **whenNotExactly** Callback-et hajt végre, ha a string nem egyezik meg pontosan a megadott értékkel.
* **whenIs** Callback-et hajt végre, ha a string megfelel a megadott mintának.
* **whenIsAscii** Callback-et hajt végre, ha a string csak ASCII karaktereket tartalmaz.
* **whenIsUlid** Callback-et hajt végre, ha a string érvényes ULID.
* **whenIsUuid** Callback-et hajt végre, ha a string érvényes UUID.
* **whenTest** Callback-et hajt végre, ha a string illeszkedik a megadott regex mintára.
* **wordCount** Megszámolja a szavak számát a stringben.
* **words** Korlátozza a stringben lévő szavak számát.
* **wrap** Becsomagolja a stringet a megadott stringekkel mindkét oldalon.



# Gyakorlati információk
## Elemi artisan parancsok induláshoz
<pre>
php artisan make:controller WelcomeController
php artisan route:list

// szerver inditasa
php artisan serve
php artisan serve --port=8080
php artisan serve --host=192.168.1.100 --port=8000
php artisan serve --host=0.0.0.0 --port=8000

// szerver inditasa hatterben
php artisan serve > /dev/null 2>&1 &

// szerver inditasa logolassal
php artisan serve > server.log 2>&1 &

// migracio
php artisan migrate:refresh --seed

php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=PostSeeder

// regisztralt seeder-ek futtatasa
php artisan db:seed
</pre>

## Breeze telepítés
<pre>
composer create-project "laravel/laravel:^12.0" breeze-app
composer require laravel/breeze

php artisan breeze:install

Which Breeze stack would you like to install?
- blade

Would you like dark mode support?
- yes

Which testing framework do you prefer?
PHPUnit
</pre>
