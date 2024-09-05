<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsOnboarded;


Route::middleware('guest')->group(function () {
    Route::inertia('/signup', 'Auth/SignUp')->name('signup');
    Route::inertia('/login', 'Auth/Login')->name('login');
    
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/signup/github', [AuthController::class, 'github'])->name('auth.github');
    Route::get('/signup/github/redirect', [AuthController::class, 'githubRedirect'])->name('auth.github.redirect');

    Route::get('/signup/google', [AuthController::class, 'google'])->name('auth.google');
    Route::get('/signup/google/redirect', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
});

Route::middleware('auth')->group(function () {
    Route::middleware('onboarded')->group(function () {
        Route::inertia('/', 'Home')->name('home');
        Route::inertia('/courses', 'Courses')->name('courses');

    });
    Route::inertia('/onboard', 'Onboard')->name('onboard');
    Route::post('/onboard', [UserController::class, 'onboard']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});