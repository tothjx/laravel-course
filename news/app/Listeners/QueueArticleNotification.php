<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Jobs\SendArticleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class QueueArticleNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleCreated $event): void
    {
        // A job-ot a queue-ba tesszük
        SendArticleNotification::dispatch($event->article);
    }
}
