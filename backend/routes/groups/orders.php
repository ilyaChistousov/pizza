<?php


use App\Http\Controllers\Order\OrderController;

Route::controller(OrderController::class)->prefix('orders')->group(function () {
    Route::post('', 'store')
        ->name('orders.stores');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('', 'index')
            ->name('orders.index');
        Route::put('{order}', 'updateStatus')
            ->name('orders.update.status');
        Route::delete('{order}', 'destroy')
            ->name('orders.destroy');
    });
});
