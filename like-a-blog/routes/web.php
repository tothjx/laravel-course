<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// http://localhost:8000/
Route::get('/', [HomeController::class, 'index'])->name('home');

// http://localhost:8000/posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// // http://localhost:8000/posts/1
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// http://localhost:8000/about
Route::get('/about', [HomeController::class, 'about'])->name('about');
