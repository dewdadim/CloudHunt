<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Models\Lesson;
use App\Models\Progress;
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
            // $lessons = Lesson::all();
            // return Inertia::render('Dashboard', ['lessons' => $lessons->load('modules')]);
            $user = Auth::user();

            // Fetch all lessons and their modules
            $lessons = Lesson::with('modules')->get();  // Fetch lessons with their modules

            // Fetch all progress for the user
            $progresses = Progress::where('user_id', $user->id)
                                ->get()
                                ->groupBy('lesson_id');  // Group progress by lesson_id

            // Combine lessons, modules, and progress into one structure
            $lessonsWithProgress = $lessons->map(function($lesson) use ($progresses, $user) {
                // Fetch the progress for this lesson
                $lessonProgress = $progresses->get($lesson->id) ?? collect();

                // Map over each module and inject progress (completed status)
                $modulesWithProgress = $lesson->modules->map(function($module) use ($lessonProgress) {
                    return [
                        'id' => $module->id,
                        'title' => $module->title,
                        'completed' => optional($lessonProgress->firstWhere('module_id', $module->id))->completed ?? false,  // Include progress if exists
                    ];
                });

                // Return the lesson structure with modules and progress
                return [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'uri' => $lesson->uri,
                    'modules' => $modulesWithProgress->toArray(),  // Nested modules with progress
                ];
            });

            // Pass the lessons array to the frontend
            return Inertia::render('Dashboard', [
                'lessons' => $lessonsWithProgress->toArray()  // Pass an array of lessons
            ]);
        })->name('dashboard');

        Route::get('/lessons', [LessonController::class, 'index'])->name('lessons');
        Route::get('/lessons/{lesson:uri}',  [LessonController::class, 'show'])->name('lessons.show');

        Route::get('/lessons/{lesson:uri}/{module:uri}',  [ModuleController::class, 'show'])->name('modules.show');
        Route::patch('/lessons/{lesson:uri}/{module:uri}',  [ModuleController::class, 'completeModule'])->name('modules.complete');

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
