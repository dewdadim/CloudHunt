<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::middleware('guest')->group(function () {
    Route::inertia('/signup', 'Auth/SignUp')->name('signup');
    Route::inertia('/login', 'Auth/Login')->name('login');
    
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::inertia('/', 'Home')->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});