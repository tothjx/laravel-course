<?php

namespace App\Providers;

use App\Events\ArticleCreated;
use App\Listeners\QueueArticleNotification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bootstrap pagination használata
        Paginator::useBootstrapFive();

        Event::listen(
            ArticleCreated::class,
            QueueArticleNotification::class
        );
    }
}
