<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::inertia('/', 'Home')->name('home');
Route::inertia('/signup', 'Auth/SignUp')->name('signup');
Route::inertia('/login', 'Auth/Login')->name('login');

Route::post('/signup', [AuthController::class, 'signup']);
