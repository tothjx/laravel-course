<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    public function __construct(
        private User $model
    ) {
    }

    /**
     * Visszaadja azokat a felhasználókat, akiknek a feliratkozása lejár a megadott dátumon belül,
     * és még nem kaptak értesítést
     *
     * @param string $date
     * @return Collection
     */
    public function getUsersWithExpiringSubscription(string $date): Collection
    {
        $cacheKey = 'users_expiring_subscription_' . $date;

        return Cache::remember($cacheKey, 3600, function () use ($date) {
            return $this->model
                ->whereNotNull('subscription_at')
                ->where('subscription_at', '<=', $date)
                ->where('subscription_notify', false)
                ->get();
        });
    }

    /**
     * Beállítja, hogy a felhasználó kapott értesítést
     *
     * @param User $user
     * @return bool
     */
    public function markAsNotified(User $user): bool
    {
        return $user->update([
            'subscription_notify' => true
        ]);
    }
}
