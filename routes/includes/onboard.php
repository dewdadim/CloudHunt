<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'onboard'], function () {
    Route::get('/', [RegisterController::class, 'onboard'])->name('onboard.index');
    Route::post('/', [RegisterController::class, 'onboardStore']);
    Route::get('/complete', [RegisterController::class, 'onboardComplete'])->name('onboard.complete');
});