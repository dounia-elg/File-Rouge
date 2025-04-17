<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtistController;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Terms and Privacy Routes
Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// Artist Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/artist/space', [ArtistController::class, 'space'])->name('artist.space');
    Route::get('/artist/edit', [ArtistController::class, 'edit'])->name('artist.edit');
    Route::post('/artist/update', [ArtistController::class, 'update'])->name('artist.update');
    
    // Artwork Routes
    Route::get('/artworks/create', [ArtistController::class, 'createArtwork'])->name('artworks.create');
    Route::post('/artworks/store', [ArtistController::class, 'storeArtwork'])->name('artworks.store');
});
