<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendArticleNotification implements ShouldQueue
{
    use Queueable;

    public Article $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Feliratkozott felhasználók lekérése
        $subscribedUsers = User::where('subscribed_to_notifications', true)->get();

        foreach ($subscribedUsers as $user) {
            // Értesítés mentése az adatbázisba
            Notification::create([
                'email' => $user->email,
                'article_title' => $this->article->title,
                'article_id' => $this->article->id,
            ]);

            // Itt valós esetben email küldés történne:
            // Mail::to($user->email)->send(new NewArticleNotification($this->article));
        }
    }
}
