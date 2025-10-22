# Kezdetek
<pre>
// projekt letrehozasa
composer create-project laravel/laravel app-dir-name
</pre>

# Használt artisan parancsok
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

# Breeze
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
