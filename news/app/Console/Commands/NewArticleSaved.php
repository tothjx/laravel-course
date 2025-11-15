<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Jobs\SendArticleNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class NewArticleSaved extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:check-new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Új cikkek ellenőrzése és értesítések küldése';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Az utolsó ellenőrzés időpontja (cache-ből)
        $lastCheck = Cache::get('last_article_check', now()->subMinute());

        // Új cikkek lekérése az utolsó ellenőrzés óta
        $newArticles = Article::where('created_at', '>', $lastCheck)->get();

        if ($newArticles->count() > 0) {
            $this->info("Új cikkek találva: {$newArticles->count()}");

            foreach ($newArticles as $article) {
                // Értesítés job queue-ba helyezése
                SendArticleNotification::dispatch($article);
                $this->info("Értesítés job hozzáadva: {$article->title}");
            }
        } else {
            $this->info('Nincsenek új cikkek.');
        }

        // Utolsó ellenőrzés időpontjának frissítése
        Cache::put('last_article_check', now(), 3600);

        return Command::SUCCESS;
    }
}
