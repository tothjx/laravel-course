<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $faker = \Faker\Factory::create();
        
        $blogPosts = [
            [
                'title' => $faker->sentence(4),
                'image' => config('app.urlDefaultImage').'1',
                'date' => $faker->date(),
                'excerpt' => $faker->paragraph(2),
            ],
            [
                'title' => $faker->sentence(4),
                'image' => config('app.urlDefaultImage').'2',
                'date' => $faker->date(),
                'excerpt' => $faker->paragraph(2),
            ],
            [
                'title' => $faker->sentence(4),
                'image' => config('app.urlDefaultImage').'3',
                'date' => $faker->date(),
                'excerpt' => $faker->paragraph(2),
            ],
        ];

        return view('blog', compact('blogPosts'));
    }
}
