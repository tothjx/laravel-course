@echo off
echo start...

echo composer
call composer install

if exist "package.json" (
    echo npm
    where yarn >nul 2>nul
    if %ERRORLEVEL% EQU 0 (
        call yarn install
    ) else (
        call npm install
    )
)

echo env file
if not exist ".env" (
    copy .env.example .env
    echo .env file letrehozva
) else (
    echo .env file mar letezik
)

echo APP_KEY generalasa
call php artisan key:generate

echo sqlite
if not exist "database" mkdir database
if not exist "database\database.sqlite" (
    type nul > "database\database.sqlite"
    echo sqlite file letrehozva
) else (
    echo sqlite file mar letezik
)

echo cache
call php artisan config:clear
call php artisan route:clear
call php artisan view:clear
call php artisan cache:clear

echo migracio
call php artisan migrate --force

rem echo storage
rem call php artisan storage:link

echo minden ok
pause