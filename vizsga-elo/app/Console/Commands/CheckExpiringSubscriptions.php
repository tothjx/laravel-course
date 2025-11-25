<?php

namespace App\Console\Commands;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class CheckExpiringSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ellenőrzi a következő 10 napban lejáró feliratkozásokat és értesítést küld';

    /**
     * Execute the console command.
     */
    public function handle(SubscriptionService $subscriptionService): int
    {
        $this->info('Lejáró feliratkozások ellenőrzése...');

        $count = $subscriptionService->checkExpiringSubscriptions();

        $this->info("Értesítés elküldve {$count} felhasználónak.");

        return Command::SUCCESS;
    }
}
