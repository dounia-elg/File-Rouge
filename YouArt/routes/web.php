<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\WorkshopController as AdminWorkshopController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Workshop;

// Home route
Route::get('/', function () {
    $featuredWorkshops = Workshop::where('is_active', true)
        ->where('is_featured', true)
        ->orderBy('date', 'desc')
        ->take(3)
        ->get();
    
    return view('welcome', compact('featuredWorkshops'));
})->name('home');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Workshop Routes
Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshops/{workshop}', [WorkshopController::class, 'show'])->name('workshops.show');
Route::post('/workshops/{workshop}/like', [WorkshopController::class, 'like'])->name('workshops.like');

// Terms and Privacy Routes
Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// Artist 

Route::middleware(['auth'])->group(function () {
    // Artist profile 
    Route::get('/artist/space', [ArtistController::class, 'space'])->name('artist.space');
    Route::get('/artist/edit', [ArtistController::class, 'edit'])->name('artist.edit');
    Route::post('/artist/update', [ArtistController::class, 'update'])->name('artist.update');
    
    // Artwork 
    Route::get('/artworks/create', [ArtworkController::class, 'create'])->name('artworks.create');
    Route::post('/artworks/store', [ArtworkController::class, 'store'])->name('artworks.store');
    Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show');
    Route::get('/artworks/{artwork}/edit', [ArtworkController::class, 'edit'])->name('artworks.edit');
    Route::put('/artworks/{artwork}', [ArtworkController::class, 'update'])->name('artworks.update');
    Route::delete('/artworks/{artwork}', [ArtworkController::class, 'destroy'])->name('artworks.destroy');
});

// Admin  
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    
    // User management 
    Route::get('/users', function() {
        return view('admin.dashboard'); 
    })->name('users');
    
    // Artwork management 
    Route::get('/artworks', function() {
        return view('admin.dashboard'); 
    })->name('artworks');
    
    // Workshop management
    Route::get('/workshops', [AdminWorkshopController::class, 'index'])->name('workshops.index');
    Route::get('/workshops/create', [AdminWorkshopController::class, 'create'])->name('workshops.create');
    Route::post('/workshops', [AdminWorkshopController::class, 'store'])->name('workshops.store');
    Route::get('/workshops/{workshop}/edit', [AdminWorkshopController::class, 'edit'])->name('workshops.edit');
    Route::put('/workshops/{workshop}', [AdminWorkshopController::class, 'update'])->name('workshops.update');
    Route::delete('/workshops/{workshop}', [AdminWorkshopController::class, 'destroy'])->name('workshops.destroy');
});

// Test route
Route::get('/test', function () {
    return "The application is working!";
});
