<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsOnboarded;
use App\Models\Course;
use App\Models\Lesson;
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
            $lessons = Lesson::all();
            return Inertia::render('Dashboard', ['lessons' => $lessons]);
        })->name('dashboard');

        Route::get('/lessons', [CourseController::class, 'index'])->name('lessons');

        Route::get('/lessons/{lesson:uri}',  [LessonController::class, 'show'])->name('lessons.show');

        // Route::get('/courses/{course:uri}',  [CourseController::class, 'show'])->name('courses.show');s

        // Route::get('/courses/{course:uri}/{chapter:uri}', [ChapterController::class, 'show'])->name('chapters.show');

        // Route::get('/courses/{course:uri}/{chapter:uri}/{module:uri}', [ModuleController::class, 'show'])->name('modules.show');


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
