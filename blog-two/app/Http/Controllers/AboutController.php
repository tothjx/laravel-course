<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $faker = \Faker\Factory::create();

        $title = 'About us';
        $urlImage = config('app.urlAboutImage');
        $introduction = $faker->paragraph(2);
        $description = $faker->paragraph(16);
        $mission = $faker->paragraph(4);
        $featuresTitle = $faker->sentence(6);
        $features = [
            $faker->sentence(4),
            $faker->sentence(4),
            $faker->sentence(4),
            $faker->sentence(4),
            $faker->sentence(4),
        ];

        return view(
            'about',
            compact(
                'title',
                'urlImage',
                'introduction',
                'description',
                'mission',
                'featuresTitle',
                'features'
            )
        );
    }
}
