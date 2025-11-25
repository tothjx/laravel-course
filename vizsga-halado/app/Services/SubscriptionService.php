<?php

namespace App\Services;

use App\Jobs\SendSubscriptionExpiringNotification;
use App\Repositories\UserRepository;

class SubscriptionService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * ellenorzi a lejaro feliratkozasokat
     * valamint ertesitest kuld
     *
     * @return int
     */
    public function checkExpiringSubscriptions(): int
    {
        $targetDate = tenDaysFromNow()->format('Y-m-d');

        $users = $this->userRepository->getUsersWithExpiringSubscription($targetDate);

        foreach ($users as $user) {
            SendSubscriptionExpiringNotification::dispatch($user);
        }

        return $users->count();
    }
}
