<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsOnboarded;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::inertia('/', 'Home')->name('home');

    Route::inertia('/signup', 'Auth/SignUp')->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/signup/github', [AuthController::class, 'github'])->name('auth.github');
    Route::get('/signup/github/redirect', [AuthController::class, 'githubRedirect'])->name('auth.github.redirect');

    Route::get('/signup/google', [AuthController::class, 'google'])->name('auth.google');
    Route::get('/signup/google/redirect', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
});

Route::middleware('auth')->group(function () {
    Route::middleware('onboarded')->group(function () {

        Route::get('/dashboard', function () {
            $courses = Course::all();
            return Inertia::render('Dashboard', ['courses' => $courses]);
        })->name('dashboard');

        Route::get('/courses', [CourseController::class, 'index'])->name('courses');
        Route::get('/courses/{course:uri}', [CourseController::class, 'show'])->name('courses.show');

        Route::inertia('/courses/{course:uri}/1', 'Course/Module')->name('module');

    });

    Route::inertia('/onboard', 'Onboard', ['data' => function(){
        $user = Auth::id();
        $user = User::findOrFail($user);

        return $user;
    }])->name('onboard');

    Route::post('/onboard', [UserController::class, 'onboard']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// public routes
Route::get('/{user:username}', [UserController::class, 'show'])->name('users.show');
