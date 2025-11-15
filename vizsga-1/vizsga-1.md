# Laravel Alapfogalmak - Átfogó Leírás

## 1. Migration (Migráció)

### Mire való?
A migrációk az adatbázis verziókezelő rendszerét jelentik. Lehetővé teszik az adatbázis séma módosításait úgy, hogy azok követhetőek és visszavonhatóak legyenek.

### Előnyök
- Csapatmunka esetén mindenki azonos adatbázis struktúrával dolgozhat
- Verziókövetés az adatbázis sémára
- Egyszerű rollback lehetőség
- Környezetfüggetlen (fejlesztés, teszt, éles)

### Parancsok
```bash
# Új migráció létrehozása
php artisan make:migration create_posts_table

# Migrációk futtatása
php artisan migrate

# Utolsó migráció visszavonása
php artisan migrate:rollback

# Összes migráció visszavonása
php artisan migrate:reset

# Összes visszavonása és újrafuttatása
php artisan migrate:refresh
```

### Példa: Posts tábla létrehozása
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```

### Példa: Oszlop hozzáadása meglévő táblához
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
            $table->integer('views')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['slug', 'views']);
        });
    }
};
```

---

## 2. Seeder (Adatfeltöltő)

### Mire való?
A seederek segítségével tesztadatokkal vagy kezdeti adatokkal tölthetjük fel az adatbázist. Fejlesztés és tesztelés során különösen hasznosak.

### Parancsok
```bash
# Új seeder létrehozása
php artisan make:seeder PostSeeder

# Seederek futtatása
php artisan db:seed

# Konkrét seeder futtatása
php artisan db:seed --class=PostSeeder

# Migráció + seed egyben
php artisan migrate:fresh --seed
```

### Példa: Egyszerű Post Seeder
```php
<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Post::create([
            'title' => 'Első bejegyzésem',
            'content' => 'Ez az első blog bejegyzés tartalma.',
            'user_id' => $user->id,
            'is_published' => true,
        ]);

        Post::create([
            'title' => 'Laravel tippek',
            'content' => 'Hasznos Laravel tippek kezdőknek.',
            'user_id' => $user->id,
            'is_published' => false,
        ]);
    }
}
```

### Példa: Factory használatával (nagyobb mennyiségű adat)
```php
<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 10 felhasználó létrehozása
        User::factory(10)->create();

        // Minden felhasználónak 5 bejegyzés
        User::all()->each(function ($user) {
            Post::factory(5)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
```

---

## 3. Laravel Cache (Gyorsítótár)

### Mire való?
A cache rendszer lehetővé teszi az adatok ideiglenes tárolását a gyorsabb elérés érdekében. Csökkenti az adatbázis lekérdezések számát és javítja a teljesítményt.

### Támogatott tárolók
- File (fájlrendszer)
- Database (adatbázis)
- Redis
- Memcached
- Array (csak teszteléshez)

### Konfigurációs fájl
`config/cache.php`

### Parancsok
```bash
# Cache törlése
php artisan cache:clear

# Config cache létrehozása (production)
php artisan config:cache

# Route cache létrehozása
php artisan route:cache

# View cache létrehozása
php artisan view:cache
```

### Példák: Cache használata
```php
<?php

use Illuminate\Support\Facades\Cache;

// 1. Érték tárolása (örökre)
Cache::put('key', 'value');

// 2. Érték tárolása időkorláttal (másodpercben)
Cache::put('key', 'value', 3600); // 1 óra

// 3. Carbon használatával
Cache::put('key', 'value', now()->addMinutes(10));

// 4. Érték lekérése
$value = Cache::get('key');

// 5. Alapértelmezett érték megadása
$value = Cache::get('key', 'default');

// 6. Érték lekérése és törlése
$value = Cache::pull('key');

// 7. Ellenőrzés: létezik-e a kulcs
if (Cache::has('key')) {
    // ...
}

// 8. Érték törlése
Cache::forget('key');

// 9. Összes cache törlése
Cache::flush();

// 10. Remember: ha nincs cache, akkor készít
$posts = Cache::remember('posts', 3600, function () {
    return Post::all();
});

// 11. RememberForever: örökre cache-el
$settings = Cache::rememberForever('settings', function () {
    return Setting::all();
});

// 12. Increment/Decrement
Cache::increment('page_views');
Cache::decrement('items_left', 5);
```

### Gyakorlati példa: Komplex lekérdezés cache-elése
```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        // Komplex lekérdezés cache-elése 1 órára
        $popularPosts = Cache::remember('popular_posts', 3600, function () {
            return Post::with('user', 'comments')
                ->where('is_published', true)
                ->where('views', '>', 1000)
                ->orderBy('views', 'desc')
                ->take(10)
                ->get();
        });

        return view('posts.index', compact('popularPosts'));
    }

    public function clearCache()
    {
        Cache::forget('popular_posts');
        return back()->with('success', 'Cache törölve!');
    }
}
```

---

## 4. Laravel Console (Artisan parancsok)

### Mire való?
A Laravel Console (Artisan) egy parancssori interfész, amely egyedi parancsok létrehozását teszi lehetővé. Automatizálhatunk feladatokat, karbantartási műveleteket végezhetünk.

### Parancsok
```bash
# Új console parancs létrehozása
php artisan make:command SendEmails

# Parancsok listázása
php artisan list

# Parancs súgó
php artisan help migrate
```

### Példa: Egyszerű parancs - felhasználók emailezése
```php
<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\WeeklyNewsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNewsletterCommand extends Command
{
    // A parancs neve
    protected $signature = 'newsletter:send {--queue : Queue the emails}';

    // A parancs leírása
    protected $description = 'Heti hírlevél küldése minden felhasználónak';

    public function handle(): int
    {
        $this->info('Hírlevél küldése elkezdődött...');

        $users = User::whereNotNull('email_verified_at')->get();
        $bar = $this->output->createProgressBar($users->count());

        foreach ($users as $user) {
            if ($this->option('queue')) {
                Mail::to($user)->queue(new WeeklyNewsletter());
            } else {
                Mail::to($user)->send(new WeeklyNewsletter());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Hírlevél sikeresen elküldve!');

        return Command::SUCCESS;
    }
}
```

### Futtatás
```bash
# Normál futtatás
php artisan newsletter:send

# Queue-val
php artisan newsletter:send --queue
```

### Példa: Argumentumokkal és opciókkal
```php
<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create
                            {name : A felhasználó neve}
                            {email : A felhasználó email címe}
                            {--admin : Admin jogosultság}';

    protected $description = 'Új felhasználó létrehozása';

    public function handle(): int
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $isAdmin = $this->option('admin');

        // Megerősítés kérése
        if (!$this->confirm("Létrehozod a felhasználót: {$name}?")) {
            $this->error('Művelet megszakítva.');
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('password'),
            'is_admin' => $isAdmin,
        ]);

        $this->info("Felhasználó sikeresen létrehozva! ID: {$user->id}");

        // Táblázat megjelenítése
        $this->table(
            ['ID', 'Név', 'Email', 'Admin'],
            [[$user->id, $user->name, $user->email, $isAdmin ? 'Igen' : 'Nem']]
        );

        return Command::SUCCESS;
    }
}
```

### Futtatás
```bash
php artisan user:create "Kovács János" "kovacs@example.com" --admin
```

---

## 5. Notification (Értesítések)

### Mire való?
A notificationök különböző csatornákon keresztül értesíthetik a felhasználókat: email, SMS, Slack, adatbázis, stb.

### Támogatott csatornák
- Database (adatbázis)
- Mail (email)
- Broadcast (WebSocket)
- Vonage (SMS)
- Slack

### Parancsok
```bash
# Notification létrehozása
php artisan make:notification InvoicePaid

# Notifications tábla létrehozása
php artisan notifications:table
php artisan migrate
```

### Példa: Invoice Payment Notification
```php
<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class InvoicePaid extends Notification
{
    use Queueable;

    public function __construct(
        public Invoice $invoice
    ) {}

    // Milyen csatornákon küldje
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    // Email tartalom
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Számla kifizetve')
            ->greeting('Kedves ' . $notifiable->name . '!')
            ->line('A számlája sikeresen ki lett fizetve.')
            ->line('Számla összege: ' . $this->invoice->amount . ' Ft')
            ->action('Számla megtekintése', url('/invoices/' . $this->invoice->id))
            ->line('Köszönjük!');
    }

    // Database tartalom
    public function toDatabase(object $notifiable): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'amount' => $this->invoice->amount,
            'message' => 'Számla kifizetve: ' . $this->invoice->amount . ' Ft',
        ];
    }
}
```

### Notification küldése
```php
<?php

use App\Models\User;
use App\Notifications\InvoicePaid;

// Egy felhasználónak
$user = User::find(1);
$user->notify(new InvoicePaid($invoice));

// Több felhasználónak
$users = User::where('role', 'admin')->get();
Notification::send($users, new InvoicePaid($invoice));

// On-Demand notification (email cím alapján, user nélkül)
Notification::route('mail', 'info@example.com')
    ->notify(new InvoicePaid($invoice));
```

### Notificationök lekérdezése
```php
<?php

// Összes notification
$notifications = $user->notifications;

// Olvasatlan notificationök
$unread = $user->unreadNotifications;

// Notification megjelölése olvasottként
$user->unreadNotifications->markAsRead();

// Egy konkrét notification olvasottnak jelölése
$notification = $user->notifications()->find($id);
$notification->markAsRead();
```

### Blade-ben való megjelenítés
```blade
@if($user->unreadNotifications->count())
    <div class="notifications">
        <h3>Új értesítések ({{ $user->unreadNotifications->count() }})</h3>
        @foreach($user->unreadNotifications as $notification)
            <div class="notification">
                {{ $notification->data['message'] }}
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
@endif
```

---

## 6. Queue Job (Sor feldolgozás)

### Mire való?
A queue jobokkal időigényes feladatokat háttérben futtathatunk, így nem lassítja a felhasználói élményt. Például: email küldés, képfeldolgozás, jelentés generálás.

### Támogatott queue driverek
- Database
- Redis
- Beanstalkd
- Amazon SQS
- Sync (azonnal, teszt környezetben)

### Parancsok
```bash
# Job létrehozása
php artisan make:job ProcessPodcast

# Queue tábla létrehozása (database driver)
php artisan queue:table
php artisan migrate

# Queue worker indítása
php artisan queue:work

# Konkrét kapcsolat feldolgozása
php artisan queue:work redis

# Csak egy job feldolgozása
php artisan queue:work --once

# Failed jobs tábla
php artisan queue:failed-table
php artisan migrate

# Failed jobök listázása
php artisan queue:failed

# Failed job újrapróbálása
php artisan queue:retry {id}

# Összes failed job újrapróbálása
php artisan queue:retry all
```

### Példa: Email küldő Job
```php
<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; // Hányszor próbálja újra
    public $timeout = 120; // Timeout másodpercben

    public function __construct(
        public User $user
    ) {}

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }

    // Ha sikertelen
    public function failed(\Throwable $exception): void
    {
        // Naplózás vagy értesítés küldése az adminnak
        logger()->error('Welcome email failed', [
            'user_id' => $this->user->id,
            'error' => $exception->getMessage()
        ]);
    }
}
```

### Job indítása
```php
<?php

use App\Jobs\SendWelcomeEmail;
use App\Models\User;

// Azonnal hozzáadás a queue-hoz
SendWelcomeEmail::dispatch($user);

// Késleltetett indítás (5 perc múlva)
SendWelcomeEmail::dispatch($user)->delay(now()->addMinutes(5));

// Konkrét queue megadása
SendWelcomeEmail::dispatch($user)->onQueue('emails');

// Több job egymás után (chain)
Bus::chain([
    new ProcessPodcast,
    new OptimizePodcast,
    new ReleasePodcast
])->dispatch();
```

### Példa: Képfeldolgozó Job
```php
<?php

namespace App\Jobs;

use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class ProcessPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Photo $photo
    ) {}

    public function handle(): void
    {
        $path = storage_path('app/public/' . $this->photo->path);

        // Különböző méretek generálása
        $this->createThumbnail($path);
        $this->createMedium($path);
        $this->optimizeOriginal($path);

        $this->photo->update(['processed' => true]);
    }

    private function createThumbnail(string $path): void
    {
        $thumbnail = Image::make($path)->fit(150, 150);
        $thumbnail->save(str_replace('.jpg', '_thumb.jpg', $path));
    }

    private function createMedium(string $path): void
    {
        $medium = Image::make($path)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $medium->save(str_replace('.jpg', '_medium.jpg', $path));
    }

    private function optimizeOriginal(string $path): void
    {
        $image = Image::make($path);
        $image->save($path, 85); // 85% minőség
    }
}
```

### Controller-ből való használat
```php
<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:10240'
        ]);

        // Kép mentése
        $path = $request->file('photo')->store('photos', 'public');

        $photo = Photo::create([
            'path' => $path,
            'processed' => false
        ]);

        // Feldolgozás queue-ba
        ProcessPhoto::dispatch($photo);

        return back()->with('success', 'Kép feltöltve, feldolgozás folyamatban...');
    }
}
```

---

## 7. Event (Események)

### Mire való?
Az eventek lehetővé teszik az alkalmazás különböző részei közötti laza kapcsolatot. Egy esemény bekövetkeztekor több listener is reagálhat rá.

### Parancsok
```bash
# Event létrehozása
php artisan make:event UserRegistered

# Listener létrehozása
php artisan make:listener SendWelcomeEmail --event=UserRegistered

# Event és listener generálása az EventServiceProvider alapján
php artisan event:generate
```

### Példa: User Registered Event
```php
<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public User $user
    ) {}
}
```

### Event regisztrálása (EventServiceProvider)
```php
<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\CreateUserProfile;
use App\Listeners\NotifyAdmins;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegistered::class => [
            SendWelcomeEmail::class,
            CreateUserProfile::class,
            NotifyAdmins::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
```

### Event kiváltása
```php
<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Event kiváltása
        event(new UserRegistered($user));
        // vagy
        UserRegistered::dispatch($user);

        return redirect()->route('home');
    }
}
```

### Gyakorlati példa: E-commerce rendelés
```php
<?php

// Event
namespace App\Events;

use App\Models\Order;

class OrderPlaced
{
    public function __construct(public Order $order) {}
}

// Listener 1: Email küldése
namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmation;
use Mail;

class SendOrderConfirmation
{
    public function handle(OrderPlaced $event): void
    {
        Mail::to($event->order->user->email)
            ->send(new OrderConfirmation($event->order));
    }
}

// Listener 2: Készlet frissítése
namespace App\Listeners;

use App\Events\OrderPlaced;

class UpdateInventory
{
    public function handle(OrderPlaced $event): void
    {
        foreach ($event->order->items as $item) {
            $item->product->decrement('stock', $item->quantity);
        }
    }
}

// Listener 3: Számla generálása
namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\GenerateInvoice;

class CreateInvoice
{
    public function handle(OrderPlaced $event): void
    {
        GenerateInvoice::dispatch($event->order);
    }
}
```

---

## 8. Listener (Eseményfigyelők)

### Mire való?
A listenerek az eventekre reagálnak. Egy event bekövetkeztekor a hozzá tartozó listenerek automatikusan lefutnak.

### Listener létrehozása
```bash
php artisan make:listener SendWelcomeEmail --event=UserRegistered
```

### Példa: Welcome Email Listener
```php
<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 3;

    public function handle(UserRegistered $event): void
    {
        Mail::to($event->user->email)
            ->send(new WelcomeEmail($event->user));
    }

    public function failed(UserRegistered $event, \Throwable $exception): void
    {
        // Log vagy értesítés hiba esetén
        logger()->error('Welcome email failed', [
            'user_id' => $event->user->id,
            'error' => $exception->getMessage()
        ]);
    }
}
```

### Listener feltételes futtatása
```php
<?php

namespace App\Listeners;

use App\Events\OrderPlaced;

class SendPremiumDiscount
{
    public function handle(OrderPlaced $event): void
    {
        // Csak prémium felhasználóknak
        if (!$event->order->user->isPremium()) {
            return;
        }

        // Kedvezmény küldése
    }
}
```

### Listener leállítása
```php
<?php

namespace App\Listeners;

use App\Events\UserRegistered;

class CheckUserBan
{
    public function handle(UserRegistered $event): bool
    {
        if ($event->user->email === 'banned@example.com') {
            // false visszaadásával megállítja a többi listener futását
            return false;
        }
    }
}
```

---

## 9. Task Scheduling (Feladat ütemezés)

### Mire való?
A task scheduling lehetővé teszi parancsok, jobbok periodikus futtatását (pl. naponta, hetente). Egyetlen cron bejegyzés szükséges a szerveren.

### Cron beállítás (csak egyszer kell)
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Ütemezések definiálása (app/Console/Kernel.php)
```php
<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // 1. Parancs futtatása naponta éjfélkor
        $schedule->command('emails:send')->daily();

        // 2. Job futtatása óránként
        $schedule->job(new ProcessPodcasts)->hourly();

        // 3. Closure futtatása minden nap 13:00-kor
        $schedule->call(function () {
            DB::table('recent_users')->delete();
        })->dailyAt('13:00');

        // 4. Hetente egyszer, hétfőn 8:00-kor
        $schedule->command('reports:generate')
            ->weeklyOn(1, '8:00');

        // 5. Havonta egyszer, a hónap első napján
        $schedule->command('invoices:monthly')
            ->monthlyOn(1, '00:00');

        // 6. Minden 5 percben
        $schedule->command('cache:prune')->everyFiveMinutes();

        // 7. Csak éles környezetben
        $schedule->command('backup:run')
            ->daily()
            ->environments(['production']);

        // 8. Feltétellel
        $schedule->command('emails:send')->daily()->when(function () {
            return date('N') < 6; // Csak hétköznapokon
        });

        // 9. Átfedések elkerülése
        $schedule->command('reports:generate')
            ->daily()
            ->withoutOverlapping();

        // 10. Háttérben futtatás
        $schedule->command('backup:run')
            ->daily()
            ->runInBackground();
    }
}
```

### Időzítési lehetőségek
```php
->cron('* * * * *');        // Egyedi cron kifejezés
->everyMinute();            // Percenként
->everyTwoMinutes();        // 2 percenként
->everyFiveMinutes();       // 5 percenként
->everyTenMinutes();        // 10 percenként
->everyFifteenMinutes();    // 15 percenként
->everyThirtyMinutes();     // 30 percenként
->hourly();                 // Óránként
->hourlyAt(17);             // Óránként, a 17. percben
->everyTwoHours();          // 2 óránként
->daily();                  // Naponta éjfélkor
->dailyAt('13:00');         // Naponta 13:00-kor
->twiceDaily(1, 13);        // Naponta 1:00 és 13:00-kor
->weekly();                 // Hetente vasárnap 00:00-kor
->weeklyOn(1, '8:00');      // Hetente hétfőn 8:00-kor
->monthly();                // Havonta első nap 00:00-kor
->monthlyOn(4, '15:00');    // Havonta 4-én 15:00-kor
->quarterly();              // Negyedévente
->yearly();                 // Évente
->timezone('Europe/Budapest'); // Időzóna beállítása
```

### Gyakorlati példák

#### Napi backup
```php
$schedule->command('backup:database')
    ->dailyAt('02:00')
    ->emailOutputOnFailure('admin@example.com');
```

#### Inaktív felhasználók törlése
```php
$schedule->call(function () {
    User::where('last_login_at', '<', now()->subMonths(6))
        ->delete();
})->monthly();
```

#### Napi jelentés emailben
```php
$schedule->command('reports:daily')
    ->dailyAt('09:00')
    ->sendOutputTo(storage_path('logs/reports.log'))
    ->emailOutputTo('manager@example.com');
```

#### Cache ürítés
```php
$schedule->command('cache:prune-stale-tags')
    ->hourly()
    ->onSuccess(function () {
        Log::info('Cache successfully pruned');
    })
    ->onFailure(function () {
        Log::error('Cache pruning failed');
    });
```

### Schedule tesztelése
```bash
# Ütemezett feladatok listázása
php artisan schedule:list

# Teszt futtatás (azonnal végrehajtja)
php artisan schedule:run

# Worker indítása fejlesztéshez
php artisan schedule:work
```

---

## 10. Request (Form Request validáció)

### Mire való?
A Form Request osztályok lehetővé teszik a bejövő HTTP kérések validációját és autorizációját. Elkülöníti a validációs logikát a controllerektől.

### Parancsok
```bash
# Form Request létrehozása
php artisan make:request StorePostRequest
```

### Példa: Post létrehozás validáció
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    // Jogosultság ellenőrzés
    public function authorize(): bool
    {
        // Csak bejelentkezett felhasználók
        return auth()->check();
    }

    // Validációs szabályok
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:posts',
            'content' => 'required|string|min:100',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date|after:now',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    // Egyedi hibaüzenetek
    public function messages(): array
    {
        return [
            'title.required' => 'A cím megadása kötelező.',
            'title.unique' => 'Ez a cím már használatban van.',
            'content.required' => 'A tartalom megadása kötelező.',
            'content.min' => 'A tartalomnak legalább 100 karakter hosszúnak kell lennie.',
            'category_id.exists' => 'A kiválasztott kategória nem létezik.',
            'image.max' => 'A kép maximum 2MB lehet.',
        ];
    }

    // Attribútumok nevei (hibaüzenetekben)
    public function attributes(): array
    {
        return [
            'title' => 'cím',
            'content' => 'tartalom',
            'category_id' => 'kategória',
        ];
    }

    // Adatok előkészítése validáció előtt
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => str_slug($this->title),
            'user_id' => auth()->id(),
        ]);
    }
}
```

### Request használata controller-ben
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        // A validáció automatikusan lefut
        // Ha sikertelen, 422 hibával visszairányít

        // Validált adatok lekérése
        $validated = $request->validated();

        // Post létrehozása
        $post = Post::create($validated);

        // Kép feltöltés kezelése
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->update(['image' => $path]);
        }

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Bejegyzés sikeresen létrehozva!');
    }
}
```

### Példa: Komplex validáció frissítéshez
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post = $this->route('post');

        // Csak a tulajdonos vagy admin szerkesztheti
        return $this->user()->id === $post->user_id ||
               $this->user()->isAdmin();
    }

    public function rules(): array
    {
        $postId = $this->route('post')->id;

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                // Unique, de figyelmen kívül hagyja a jelenlegi rekordot
                Rule::unique('posts')->ignore($postId),
            ],
            'content' => 'required|string|min:100',
            'status' => [
                'required',
                Rule::in(['draft', 'published', 'archived']),
            ],
        ];
    }

    // Egyedi validációs logika
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->status === 'published' && empty($this->published_at)) {
                $validator->errors()->add(
                    'published_at',
                    'Publikálási dátum kötelező publikált bejegyzéseknél.'
                );
            }
        });
    }
}
```

### Blade-ben hibák megjelenítése
```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="title">Cím</label>
        <input type="text"
               name="title"
               id="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">Tartalom</label>
        <textarea name="content"
                  id="content"
                  class="form-control @error('content') is-invalid @enderror"
        >{{ old('content') }}</textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Mentés</button>
</form>
```

### API validáció (JSON válasz)
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiStorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    // API hibák JSON formátumban
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validációs hiba',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
```

---
