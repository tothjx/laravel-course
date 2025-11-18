<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 2 admin felhasználó létrehozása (csak ha még nem léteznek)
        User::firstOrCreate(
            ['email' => 'admin1@example.com'],
            [
                'name' => 'Admin User 1',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'subscribed_to_notifications' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin2@example.com'],
            [
                'name' => 'Admin User 2',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'subscribed_to_notifications' => true,
            ]
        );

        // További normál felhasználók létrehozása, ha kevesebb mint 20 van
        $currentUserCount = User::count();
        if ($currentUserCount < 20) {
            User::factory(20 - $currentUserCount)->create();
        }

        // 20 cikk létrehozása különböző felhasználókhoz (csak ha még nincsenek cikkek)
        if (Article::count() === 0) {
            $users = User::all();
            Article::factory(20)->create([
                'user_id' => fn() => $users->random()->id,
            ]);
        }
    }
}
