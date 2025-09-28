<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\PhoneHelper;

class HomeController extends Controller
{
    public function index()
    {
        return view('guest.home');
    }

    public function about()
    {
        $name = 'Tóth József';
        $email = 'tothjx@gmail.com';
        $phone = '36301655602';
        $skills = [
            'Arculat-, újságok-, magazinok-, könyvek- és egyéb kiadványok tervezése.',
            'PHP fejlesztés, Yii keretrendszer és egyedi fejlesztések.',
            'Typescript és javascript alkalmazások, desktop Electron alkalmazások fejlesztése.',
            'Python alkalmazások fejlesztése, grafikos nyelvi modellek alkalmazása.'
        ];
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit, nisl et eleifend congue, enim augue tincidunt massa, nec facilisis urna mauris vel odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec vehicula augue eu neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras justo odio, dapibus ac facilisis in, egestas eget quam.';

        return view('guest.about', [
            'name' => Str::upper($name),
            'email' => Str::mask($email, '*', 1, 4),
            'phone' => PhoneHelper::formatNumber($phone),
            'skills' => array_map(fn($skill) => Str::ucfirst($skill), $skills),
            'description' => Str::limit($description, 150)
        ]);
    }
}
