<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faker = \Faker\Factory::create();

        $title = $faker->sentence(4);
        $content = $faker->paragraph(16);

        return view('home', compact('title', 'content'));
    }
}
