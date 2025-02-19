<?php

use App\Http\Controllers\Courses\CourseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses.index');

});