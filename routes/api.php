<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UpdatePasswordController;
require __DIR__.'/auth.php';

Route::middleware('auth:api')->group(function () {
    Route::get('/user-profile', [UserController::class, 'show'])
        ->name('user.show');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/user-update', [UserController::class, 'update'])
        ->name('user.update');

    Route::patch('/user/change-password', [UserController::class, 'changePassword'])
        ->name('user.change-password');

});

Route::middleware(['auth:api'])->group(function () {
    Route::put('/user/password', UpdatePasswordController::class);
});
