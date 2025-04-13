<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Artist routes
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/artist/profile', [ArtistController::class, 'updateProfile']);
});