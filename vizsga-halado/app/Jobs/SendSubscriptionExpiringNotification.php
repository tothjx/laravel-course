<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\SubscriptionExpiringNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendSubscriptionExpiringNotification implements ShouldQueue
{
    use Queueable;

    /**
     * uj job peldany letrehozasa
     */
    public function __construct(
        public User $user
    ) {
        //
    }

    /**
     * job futtatasa
     */
    public function handle(): void
    {
        $this->user->notify(new SubscriptionExpiringNotification());

        $this->user->update([
            'subscription_notify' => true
        ]);
    }
}
