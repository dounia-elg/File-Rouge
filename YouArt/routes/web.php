<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;

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
    // Artist profile routes
    Route::get('/artist/space', [ArtistController::class, 'space'])->name('artist.space');
    Route::get('/artist/edit', [ArtistController::class, 'edit'])->name('artist.edit');
    Route::post('/artist/update', [ArtistController::class, 'update'])->name('artist.update');
    
    // Artwork Routes
    Route::get('/artworks/create', [ArtworkController::class, 'create'])->name('artworks.create');
    Route::post('/artworks/store', [ArtworkController::class, 'store'])->name('artworks.store');
    Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show');
    Route::get('/artworks/{artwork}/edit', [ArtworkController::class, 'edit'])->name('artworks.edit');
    Route::put('/artworks/{artwork}', [ArtworkController::class, 'update'])->name('artworks.update');
    Route::delete('/artworks/{artwork}', [ArtworkController::class, 'destroy'])->name('artworks.destroy');
});

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    
    // User management
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    
    // Artwork management
    Route::get('/artworks', [App\Http\Controllers\Admin\AdminController::class, 'artworks'])->name('artworks');
    
    // Workshop management
    Route::get('/workshops', [App\Http\Controllers\Admin\WorkshopController::class, 'index'])->name('workshops.index');
    Route::get('/workshops/create', [App\Http\Controllers\Admin\WorkshopController::class, 'create'])->name('workshops.create');
    Route::post('/workshops', [App\Http\Controllers\Admin\WorkshopController::class, 'store'])->name('workshops.store');
    Route::get('/workshops/{workshop}/edit', [App\Http\Controllers\Admin\WorkshopController::class, 'edit'])->name('workshops.edit');
    Route::put('/workshops/{workshop}', [App\Http\Controllers\Admin\WorkshopController::class, 'update'])->name('workshops.update');
    Route::delete('/workshops/{workshop}', [App\Http\Controllers\Admin\WorkshopController::class, 'destroy'])->name('workshops.destroy');
});
