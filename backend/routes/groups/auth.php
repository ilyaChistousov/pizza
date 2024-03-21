<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/logout', 'logout')
        ->middleware('auth:sanctum')
        ->name('logout');

    Route::middleware('guest')->group(function () {
        Route::post('/register', 'register')
            ->name('register');

        Route::post('/login', 'login')
            ->name('login');
    });
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('/forgot-password', 'forgot')
            ->name('password.email');

        Route::post('/reset-password', 'reset')
            ->name('password.store');
    });
});
