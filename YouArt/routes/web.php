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
use App\Http\Controllers\ArtLoverController;

// Home route
Route::get('/', function () {
    $featuredWorkshops = Workshop::orderBy('id', 'desc')
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
Route::post('/workshops/{workshop}/unlike', [WorkshopController::class, 'unlike'])->name('workshops.unlike');
Route::post('/workshops/{workshop}/toggle-like', [WorkshopController::class, 'toggleLikeAjax'])->name('workshops.toggleLikeAjax');

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
    // All artists page
    Route::get('/artists', [ArtistController::class, 'all'])->name('artists.all');
    // Public artist profile page
    Route::get('/artists/{id}', [ArtistController::class, 'profile'])->name('artist.profile');
    // Follow/unfollow artist
    Route::post('/artists/{id}/follow', [ArtistController::class, 'follow'])->name('artist.follow');
    Route::post('/artists/{id}/unfollow', [ArtistController::class, 'unfollow'])->name('artist.unfollow');
    
    // ArtLover space
    Route::get('/artlover/space', [ArtLoverController::class, 'space'])->name('artlover.space');
    Route::get('/artlover/edit', [ArtLoverController::class, 'edit'])->name('artlover.edit');
    Route::post('/artlover/update', [ArtLoverController::class, 'update'])->name('artlover.update');
    
    // Artwork 
    Route::get('/artworks/create', [ArtworkController::class, 'create'])->name('artworks.create');
    Route::post('/artworks/store', [ArtworkController::class, 'store'])->name('artworks.store');
    Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show');
    Route::get('/artworks/{artwork}/edit', [ArtworkController::class, 'edit'])->name('artworks.edit');
    Route::put('/artworks/{artwork}', [ArtworkController::class, 'update'])->name('artworks.update');
    Route::delete('/artworks/{artwork}', [ArtworkController::class, 'destroy'])->name('artworks.destroy');
    // All artworks page
    Route::get('/artworks', [ArtworkController::class, 'all'])->name('artworks.all');
    // Like/unlike routes
    Route::post('/artworks/{artwork}/like', [ArtworkController::class, 'like'])->name('artworks.like');
    Route::post('/artworks/{artwork}/unlike', [ArtworkController::class, 'unlike'])->name('artworks.unlike');
    Route::post('/artworks/{artwork}/toggle-like', [ArtworkController::class, 'toggleLikeAjax'])->name('artworks.toggleLikeAjax');
});

// Admin  
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    
    // User management 
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users/{user}/activate', [AdminController::class, 'activateUser'])->name('users.activate');
    Route::post('/users/{user}/suspend', [AdminController::class, 'suspendUser'])->name('users.suspend');
    Route::delete('/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('users.delete');
    
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
