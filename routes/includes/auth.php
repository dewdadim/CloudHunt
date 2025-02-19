<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::any('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => ['guest'], 'prefix' => 'auth'], function () {

    //register
    Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
    Route::post('/signup', [RegisterController::class, 'signup']);

    //login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    //social auth
    Route::get('/signup/github', [SocialAuthController::class, 'github'])->name('auth.github');
    Route::get('/signup/github/redirect', [SocialAuthController::class, 'githubRedirect'])->name('auth.github.redirect');
    Route::get('/signup/google', [SocialAuthController::class, 'google'])->name('auth.google');
    Route::get('/signup/google/redirect', [SocialAuthController::class, 'googleRedirect'])->name('auth.google.redirect');
});