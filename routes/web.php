<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', function (){
    return to_route('login');
})->name('home')->middleware('guest');

//user auth
require base_path('routes/includes/auth.php');

//setting
require base_path('routes/includes/setting.php');

Route::middleware(['auth', 'ensure-user-onboarded'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //challenge
    require base_path('routes/includes/challenge.php');

    //course
    require base_path('routes/includes/course.php');

    //onboard
    require base_path('routes/includes/onboard.php');

    // Route::get('/lessons', [LessonController::class, 'index'])->name('lessons');
    // Route::get('/lessons/{lesson:uri}',  [LessonController::class, 'show'])->name('lessons.show');

    // Route::get('/lessons/{lesson:uri}/{module:uri}',  [ModuleController::class, 'show'])->name('modules.show');
    // Route::patch('/lessons/{lesson:uri}/{module:uri}/completed',  [ModuleController::class, 'completeModule'])->name('modules.complete');
    // Route::get('/lessons/{lesson:uri}/{module:uri}/completed', function($lesson) {
    //     return redirect()->route('lessons.show', [
    //         'lesson' => $lesson
    //     ]);
    // });

    Route::group(['prefix' => 'settings', 'as' => 'settings'], function () {
        Route::get('/', function () {
            return to_route('settings.profile');
        });
        Route::inertia('/profile', 'Setting/Profile')->name('.profile');
    });

});

// public routes
Route::get('/{user:username}', [UserController::class, 'show'])->name('users.show');
