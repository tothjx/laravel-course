<?php

use App\Http\Controllers\ContestController;

// Nyereményjáték routes
Route::prefix('nyeremenyjatek')->name('contest.')->group(function () {
    
    // Nyereményjáték űrlap megjelenítése
    Route::get('/', [ContestController::class, 'show'])
        ->name('show');
    
    // Nyereményjáték beküldése
    Route::get('/kuldes', [ContestController::class, 'submit'])
        ->name('submit');
    
    // Eredmény megjelenítése
    Route::get('/eredmeny/{id}', [ContestController::class, 'result'])
        ->name('result');ű
});