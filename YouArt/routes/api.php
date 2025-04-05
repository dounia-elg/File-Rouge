<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [LoginController::class, 'login']);