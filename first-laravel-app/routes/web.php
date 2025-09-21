<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VersionController;

// home
// termekek listazasa
// http://127.0.0.1:8000/
// http://127.0.0.1:8000/index
// http://127.0.0.1:8000/home
Route::group(['controller' => PageController::class], function () {
    Route::get('/', 'home');
    Route::get('/index', 'home');
    Route::get('/home', 'home');
});

// Route::get('/', [PageController::class, 'home']);
// Route::get('/index', [PageController::class, 'home']);
// Route::get('/home', [PageController::class, 'home']);

// alkalmazas-verziokat tartalmazo oldal elerese
// http://127.0.0.1:8000/versions
Route::get('/versions', [VersionController::class, 'versions']);

// termekek listazasa
// http://127.0.0.1:8000/products
Route::get('/products', function () {
    return response()->json(
        ['msg' => 'Termékek listázása']
    );
});

// termek hozzaadasa
Route::post('/products/create', function () {
    return response()->json(
        ['msg' => 'Új termék hozzáadása']
    );
});

// termek modositasa
Route::put('/products/{id}/edit', function ($id) {
    return response()->json(
        ['message' => "Termék módosítása: {$id}"]
    );
});

// termek torlese
Route::delete('/products/{id}/delete', function ($id) {
    return response()->json(
        ['message' => "Termék törlése: {$id}"]
    );
});

// felhasznalo es post megjelenitese
// http://127.0.0.1:8000/user/5/post/10
Route::get('/user/{id}/post/{idPost}', function ($id, $idPost) {
    return "Felhasználó: {$id}, Bejegyzés: {$idPost}";
});

// welcome oldal
// http://127.0.0.1:8000/welcome/Kelemen
// http://127.0.0.1:8000/welcome
Route::get('/welcome/{name?}', function ($name = null) {
    if ($name) {
        return "hello {$name}!";
    }
    return "hello vendég!";
});

// profil megjelenitese
// http://127.0.0.1:8000/profile
Route::get('/profile', function () {
    // ez majd csinal vmit
})->name('profile.show');

// profile route elerese
// http://127.0.0.1:8000/profileurl
Route::get('/profileurl', function () {
    return 'profil-oldal URL-je: ' . route('profile.show');
});
