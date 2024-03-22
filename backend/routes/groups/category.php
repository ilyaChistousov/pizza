<?php

use App\Http\Controllers\Product\CategoryController;

Route::controller(CategoryController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/categories', 'store')
            ->name('categories.stores');
        Route::put('/categories/{category}', 'update')
            ->name('categories.update');
        Route::delete('/categories/{category}', 'destroy')
            ->name('categories.destroy');
    });

    Route::get('/categories', 'index')
        ->name('categories.index');
    Route::get('/categories/{category}', 'show')
        ->name('categories.show');
});
