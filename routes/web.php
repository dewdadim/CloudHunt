<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureUserIsOnboarded;


Route::middleware('guest')->group(function () {
    Route::inertia('/signup', 'Auth/SignUp')->name('signup');
    Route::inertia('/login', 'Auth/Login')->name('login');
    
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::middleware(EnsureUserIsOnboarded::class)->group(function () {
        Route::inertia('/', 'Home')->name('home');
    });
    Route::inertia('/onboard', 'Onboard')->name('onboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});