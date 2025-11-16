<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = now();

        // Admin user
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@webshop.hu',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Categories
        $categories = [
            ['id' => 1, 'name' => 'Alaplap', 'slug' => 'alaplap'],
            ['id' => 2, 'name' => 'Memória', 'slug' => 'memoria'],
            ['id' => 3, 'name' => 'Processzor', 'slug' => 'processzor'],
            ['id' => 4, 'name' => 'Processzor-hűtő', 'slug' => 'processzor-huto'],
            ['id' => 5, 'name' => 'Videokártya', 'slug' => 'videokartya'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'id' => $category['id'],
                'name' => $category['name'],
                'slug' => $category['slug'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Products
        $products = [
            // Alaplap
            ['id' => 1, 'category_id' => 1, 'name' => 'ASUS ROG Strix B550-F Gaming', 'price' => 45000, 'stock' => 15, 'created_at' => '2025-11-16 10:57:48', 'updated_at' => '2025-11-16 10:57:48'],
            ['id' => 2, 'category_id' => 1, 'name' => 'MSI MPG X570 Gaming Edge WiFi', 'price' => 58000, 'stock' => 12, 'created_at' => '2025-11-16 10:57:49', 'updated_at' => '2025-11-16 10:57:49'],
            ['id' => 3, 'category_id' => 1, 'name' => 'Gigabyte B450 AORUS Elite V2', 'price' => 32000, 'stock' => 20, 'created_at' => '2025-11-16 10:57:50', 'updated_at' => '2025-11-16 10:57:50'],
            ['id' => 4, 'category_id' => 1, 'name' => 'ASRock B660M Pro RS', 'price' => 28000, 'stock' => 18, 'created_at' => '2025-11-16 10:59:19', 'updated_at' => '2025-11-16 10:59:19'],

            // Memória
            ['id' => 5, 'category_id' => 2, 'name' => 'Corsair Vengeance RGB 16GB DDR4', 'price' => 18000, 'stock' => 25, 'created_at' => '2025-11-16 10:57:52', 'updated_at' => '2025-11-16 10:57:52'],
            ['id' => 6, 'category_id' => 2, 'name' => 'G.Skill Ripjaws V 32GB DDR4', 'price' => 32000, 'stock' => 15, 'created_at' => '2025-11-16 10:57:53', 'updated_at' => '2025-11-16 10:57:53'],
            ['id' => 7, 'category_id' => 2, 'name' => 'Kingston Fury Beast 16GB DDR5', 'price' => 28000, 'stock' => 20, 'created_at' => '2025-11-16 10:59:15', 'updated_at' => '2025-11-16 10:59:15'],
            ['id' => 8, 'category_id' => 2, 'name' => 'TeamGroup T-Force 16GB DDR4', 'price' => 15000, 'stock' => 30, 'created_at' => '2025-11-16 10:59:16', 'updated_at' => '2025-11-16 10:59:16'],

            // Processzor
            ['id' => 9, 'category_id' => 3, 'name' => 'AMD Ryzen 5 5600X', 'price' => 68000, 'stock' => 10, 'created_at' => '2025-11-16 10:57:56', 'updated_at' => '2025-11-16 10:57:56'],
            ['id' => 10, 'category_id' => 3, 'name' => 'Intel Core i5-12400F', 'price' => 58000, 'stock' => 12, 'created_at' => '2025-11-16 10:57:57', 'updated_at' => '2025-11-16 10:57:57'],
            ['id' => 11, 'category_id' => 3, 'name' => 'AMD Ryzen 7 5800X3D', 'price' => 125000, 'stock' => 8, 'created_at' => '2025-11-16 10:57:58', 'updated_at' => '2025-11-16 10:57:58'],
            ['id' => 12, 'category_id' => 3, 'name' => 'Intel Core i7-13700K', 'price' => 145000, 'stock' => 6, 'created_at' => '2025-11-16 10:59:18', 'updated_at' => '2025-11-16 10:59:18'],

            // Processzor-hűtő
            ['id' => 13, 'category_id' => 4, 'name' => 'Noctua NH-D15 chromax.black', 'price' => 32000, 'stock' => 15, 'created_at' => '2025-11-16 10:59:20', 'updated_at' => '2025-11-16 10:59:20'],
            ['id' => 14, 'category_id' => 4, 'name' => 'be quiet! Dark Rock Pro 4', 'price' => 28000, 'stock' => 18, 'created_at' => '2025-11-16 10:58:01', 'updated_at' => '2025-11-16 10:58:01'],
            ['id' => 15, 'category_id' => 4, 'name' => 'Cooler Master Hyper 212 Black', 'price' => 12000, 'stock' => 25, 'created_at' => '2025-11-16 10:58:02', 'updated_at' => '2025-11-16 10:58:02'],
            ['id' => 16, 'category_id' => 4, 'name' => 'Arctic Freezer 34 eSports DUO', 'price' => 15000, 'stock' => 20, 'created_at' => '2025-11-16 10:58:03', 'updated_at' => '2025-11-16 10:58:03'],

            // Videokártya
            ['id' => 17, 'category_id' => 5, 'name' => 'NVIDIA GeForce RTX 4060 Ti 8GB', 'price' => 145000, 'stock' => 8, 'created_at' => '2025-11-16 10:59:17', 'updated_at' => '2025-11-16 10:59:17'],
            ['id' => 18, 'category_id' => 5, 'name' => 'AMD Radeon RX 7600 8GB', 'price' => 98000, 'stock' => 10, 'created_at' => '2025-11-16 10:58:05', 'updated_at' => '2025-11-16 10:58:05'],
            ['id' => 19, 'category_id' => 5, 'name' => 'NVIDIA GeForce RTX 4070 Super', 'price' => 225000, 'stock' => 5, 'created_at' => '2025-11-16 10:58:06', 'updated_at' => '2025-11-16 10:58:06'],
            ['id' => 20, 'category_id' => 5, 'name' => 'AMD Radeon RX 7800 XT', 'price' => 185000, 'stock' => 7, 'created_at' => '2025-11-16 10:58:07', 'updated_at' => '2025-11-16 10:58:07'],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'id' => $product['id'],
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'description' => 'Kiváló minőségű ' . DB::table('categories')->where('id', $product['category_id'])->value('name') . ' számítógépekhez.',
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => 'images/products/product-' . $product['id'] . '.jpg',
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->where('email', 'admin@webshop.hu')->delete();
    }
};
