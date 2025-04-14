<?php

use App\Http\Controllers\Web\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArtistController;

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Terms and Privacy Routes
Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

/// Artist Routes 
Route::get('/artist/space', [ArtistController::class, 'index'])->name('artist.space');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::put('/artist/profile', [ArtistController::class, 'updateProfile'])
        ->name('artist.profile.update');
});
