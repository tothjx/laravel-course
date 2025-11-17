@echo off
echo ========================================
echo Laravel Fresh Migration and Seed
echo ========================================
echo.
echo WARNING: This will DELETE all data in the database!
echo.
set /p confirm="Are you sure you want to continue? (Y/N): "
if /i not "%confirm%"=="Y" (
    echo Operation cancelled.
    pause
    exit /b 0
)
echo.

echo Dropping all tables and re-running migrations with seeders...
php artisan migrate:fresh --seed

if %errorlevel% neq 0 (
    echo ERROR: Migration failed!
    pause
    exit /b 1
)

echo.
echo ========================================
echo Database refreshed successfully!
echo ========================================
pause
