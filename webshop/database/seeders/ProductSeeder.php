<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Alaplap' => [
                ['name' => 'ASUS ROG Strix B550-F Gaming', 'price' => 45000, 'stock' => 15],
                ['name' => 'MSI MPG X570 Gaming Edge WiFi', 'price' => 58000, 'stock' => 12],
                ['name' => 'Gigabyte B450 AORUS Elite V2', 'price' => 32000, 'stock' => 20],
                ['name' => 'ASRock B660M Pro RS', 'price' => 28000, 'stock' => 18],
            ],
            'Memória' => [
                ['name' => 'Corsair Vengeance RGB 16GB DDR4', 'price' => 18000, 'stock' => 25],
                ['name' => 'G.Skill Ripjaws V 32GB DDR4', 'price' => 32000, 'stock' => 15],
                ['name' => 'Kingston Fury Beast 16GB DDR5', 'price' => 28000, 'stock' => 20],
                ['name' => 'TeamGroup T-Force 16GB DDR4', 'price' => 15000, 'stock' => 30],
            ],
            'Processzor' => [
                ['name' => 'AMD Ryzen 5 5600X', 'price' => 68000, 'stock' => 10],
                ['name' => 'Intel Core i5-12400F', 'price' => 58000, 'stock' => 12],
                ['name' => 'AMD Ryzen 7 5800X3D', 'price' => 125000, 'stock' => 8],
                ['name' => 'Intel Core i7-13700K', 'price' => 145000, 'stock' => 6],
            ],
            'Processzor-hűtő' => [
                ['name' => 'Noctua NH-D15 chromax.black', 'price' => 32000, 'stock' => 15],
                ['name' => 'be quiet! Dark Rock Pro 4', 'price' => 28000, 'stock' => 18],
                ['name' => 'Cooler Master Hyper 212 Black', 'price' => 12000, 'stock' => 25],
                ['name' => 'Arctic Freezer 34 eSports DUO', 'price' => 15000, 'stock' => 20],
            ],
            'Videokártya' => [
                ['name' => 'NVIDIA GeForce RTX 4060 Ti 8GB', 'price' => 145000, 'stock' => 8],
                ['name' => 'AMD Radeon RX 7600 8GB', 'price' => 98000, 'stock' => 10],
                ['name' => 'NVIDIA GeForce RTX 4070 Super', 'price' => 225000, 'stock' => 5],
                ['name' => 'AMD Radeon RX 7800 XT', 'price' => 185000, 'stock' => 7],
            ],
        ];

        $productId = 1;
        foreach ($products as $categoryName => $categoryProducts) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($categoryProducts as $productData) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'description' => 'Kiváló minőségű ' . strtolower($categoryName) . ' számítógépekhez.',
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'image' => 'images/products/product-' . $productId . '.jpg',
                ]);
                $productId++;
            }
        }
    }
}
