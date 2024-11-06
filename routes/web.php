<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Route::get('/', function (){
        return to_route('login');
    })->name('home');

    Route::inertia('/signup', 'Auth/SignUp')->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/signup/github', [AuthController::class, 'github'])->name('auth.github');
    Route::get('/signup/github/redirect', [AuthController::class, 'githubRedirect'])->name('auth.github.redirect');

    Route::get('/signup/google', [AuthController::class, 'google'])->name('auth.google');
    Route::get('/signup/google/redirect', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
});

Route::middleware(['auth', 'onboarded'])->group(function () {

    Route::inertia('/onboard', 'Onboard', ['data' => function(){
        $user = Auth::id();
        $user = User::findOrFail($user);
        return $user;
    }])->name('onboard');
    Route::post('/onboard', [UserController::class, 'onboard']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons');
    Route::get('/lessons/{lesson:uri}',  [LessonController::class, 'show'])->name('lessons.show');

    Route::get('/lessons/{lesson:uri}/{module:uri}',  [ModuleController::class, 'show'])->name('modules.show');
    Route::patch('/lessons/{lesson:uri}/{module:uri}',  [ModuleController::class, 'completeModule'])->name('modules.complete');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// public routes
Route::get('/{user:username}', [UserController::class, 'show'])->name('users.show');
