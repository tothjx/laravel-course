@echo off
echo ========================================
echo Laravel Project Update Script
echo ========================================
echo.

:: Git pull
echo [1/6] Pulling latest changes from git...
git pull
if %errorlevel% neq 0 (
    echo ERROR: Git pull failed!
    pause
    exit /b 1
)
echo Git pull completed successfully.
echo.

:: Composer install/update
echo [2/6] Installing/updating Composer dependencies...
composer install --no-interaction
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)
echo Composer dependencies installed successfully.
echo.

:: Check and copy .env file if needed
echo [3/6] Checking .env file...
if not exist .env (
    if exist .env.example (
        echo .env file not found. Copying from .env.example...
        copy .env.example .env
        echo .env file created. Please configure it before continuing.
        echo Opening .env file in notepad...
        notepad .env
        pause
    ) else (
        echo ERROR: Neither .env nor .env.example found!
        pause
        exit /b 1
    )
) else (
    echo .env file exists.
)
echo.

:: Generate application key if needed
echo [4/6] Checking application key...
findstr /C:"APP_KEY=" .env | findstr /C:"APP_KEY=base64:" >nul
if %errorlevel% neq 0 (
    echo Generating application key...
    php artisan key:generate
) else (
    echo Application key already exists.
)
echo.

:: Run migrations
echo [5/6] Running database migrations...
php artisan migrate --force
if %errorlevel% neq 0 (
    echo WARNING: Migration failed! Check your database configuration.
    echo Do you want to continue anyway? (Y/N)
    choice /C YN /N
    if errorlevel 2 exit /b 1
)
echo Migrations completed.
echo.

:: Run seeders (optional - uncomment if needed)
echo [6/6] Running database seeders...
set /p run_seeders="Do you want to run seeders? (Y/N): "
if /i "%run_seeders%"=="Y" (
    php artisan db:seed --force
    if %errorlevel% neq 0 (
        echo WARNING: Seeding failed!
    ) else (
        echo Seeders completed successfully.
    )
) else (
    echo Skipping seeders.
)
echo.

:: Optional: Clear and cache config
echo.
echo Additional optimization tasks:
set /p run_optimize="Do you want to clear and rebuild cache? (Y/N): "
if /i "%run_optimize%"=="Y" (
    echo Clearing configuration cache...
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear
    php artisan route:clear

    echo Rebuilding cache...
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    echo Cache optimization completed.
)
echo.

:: Optional: Install NPM dependencies and build assets
echo.
set /p run_npm="Do you want to install NPM dependencies and build assets? (Y/N): "
if /i "%run_npm%"=="Y" (
    if exist package.json (
        echo Installing NPM dependencies...
        call npm install

        echo Building assets...
        call npm run build

        echo NPM tasks completed.
    ) else (
        echo No package.json found, skipping NPM tasks.
    )
)
echo.

echo ========================================
echo Update completed successfully!
echo ========================================
pause
