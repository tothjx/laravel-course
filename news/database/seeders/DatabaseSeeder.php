<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 2 admin felhasználó létrehozása
        User::factory()->create([
            'name' => 'Admin User 1',
            'email' => 'admin1@example.com',
            'is_admin' => true,
            'subscribed_to_notifications' => true,
        ]);

        User::factory()->create([
            'name' => 'Admin User 2',
            'email' => 'admin2@example.com',
            'is_admin' => true,
            'subscribed_to_notifications' => true,
        ]);

        // 18 normál felhasználó létrehozása (összesen 20)
        User::factory(18)->create();

        // 20 cikk létrehozása különböző felhasználókhoz
        $users = User::all();

        Article::factory(20)->create([
            'user_id' => fn() => $users->random()->id,
        ]);
    }
}
