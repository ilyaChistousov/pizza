<?php

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProductController::class)->group(function () {
       Route::post('/products', 'store')
           ->name('products.store');
       Route::put('/products/{product}', 'update')
           ->name('products.update');
       Route::delete('/products/{product}', 'destroy')
           ->name('products.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::post('/categories', 'store')
            ->name('categories.store');
        Route::put('/categories/{category}', 'update')
            ->name('categories.update');
        Route::delete('/categories/{category}', 'destroy')
            ->name('categories.destroy');
    });
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('categories.show');
