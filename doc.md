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
</pre>
