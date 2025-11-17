<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productNames = [
            'Alaplap' => ['ASUS ROG Strix B550-F', 'MSI MPG X570 Gaming Edge', 'Gigabyte B450 AORUS Elite'],
            'Memória' => ['Corsair Vengeance 16GB DDR4', 'G.Skill Ripjaws V 32GB DDR4', 'Kingston Fury Beast 16GB DDR5'],
            'Processzor' => ['AMD Ryzen 5 5600X', 'Intel Core i5-12400F', 'AMD Ryzen 7 5800X3D'],
            'Processzor-hűtő' => ['Noctua NH-D15', 'be quiet! Dark Rock Pro 4', 'Cooler Master Hyper 212'],
            'Videokártya' => ['NVIDIA RTX 4060 Ti', 'AMD Radeon RX 7600', 'NVIDIA RTX 4070 Super']
        ];

        return [
            'name' => fake()->randomElement([
                'ASUS ROG Strix B550-F Gaming',
                'MSI GeForce RTX 4060',
                'AMD Ryzen 5 5600X',
                'Corsair Vengeance RGB 16GB',
                'Samsung 970 EVO Plus 1TB',
                'Noctua NH-D15 CPU Cooler',
                'Seasonic Focus GX-750W',
                'WD Black SN850 2TB',
                'Kingston Fury Beast 32GB',
                'be quiet! Dark Rock Pro 4'
            ]),
            'description' => fake()->sentence(15),
            'price' => fake()->randomFloat(2, 5000, 150000),
            'stock' => fake()->numberBetween(5, 50),
            'image' => null,
        ];
    }
}
