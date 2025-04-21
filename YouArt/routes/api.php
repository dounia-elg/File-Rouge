<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Artist routes
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/artist/profile', [ArtistController::class, 'updateProfile'])->name('artist.profile.update');
});