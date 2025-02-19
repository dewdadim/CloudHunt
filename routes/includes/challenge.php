<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Challenges\ChallengeController;

Route::group(['prefix' => 'challenges'], function () {
    Route::get('/', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/{challenge:uri}', [ChallengeController::class, 'index'])->name('challenges.show');
});