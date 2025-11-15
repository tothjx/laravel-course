<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $body = fake()->paragraphs(rand(3, 8), true);
        // Biztosítjuk, hogy a body ne legyen 5000 karakternél hosszabb
        if (strlen($body) > 5000) {
            $body = substr($body, 0, 5000);
        }

        return [
            'title' => fake()->sentence(rand(4, 8)),
            'lead' => fake()->paragraph(),
            'body' => $body,
            'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
