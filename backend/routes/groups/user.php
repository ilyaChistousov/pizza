<?php

use App\Http\Controllers\User\UserController;

Route::controller(UserController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/users', 'index')
        ->name('users.index');
    Route::get('/users/{user}', 'show')
        ->name('users.show');
    Route::put('/users/{user}', 'update')
        ->name('users.update');
    Route::delete('/users/{user}', 'destroy')
        ->name('users.destroy');
});
