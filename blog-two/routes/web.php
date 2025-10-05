<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

// http://127.0.0.1:8000/
Route::get('/', [HomeController::class, 'index'])->name('home');

// http://127.0.0.1:8000/blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// http://127.0.0.1:8000/about
Route::get('/about', [AboutController::class, 'index'])->name('about');
