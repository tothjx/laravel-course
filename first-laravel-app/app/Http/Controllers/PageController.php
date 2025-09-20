<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view(
            'home',
            [
                'appName' => config('app.name'),
                'viewName' => request()->segment(1) ?: 'home'
            ]
        );
    }
}
