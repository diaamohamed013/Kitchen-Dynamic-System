<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\KitchenController;

// Customer Storefront
Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/product/{id}', [StoreController::class, 'showProduct'])->name('store.product');
Route::get('/checkout', [StoreController::class, 'checkoutPage'])->name('store.checkout.page');
Route::post('/checkout', [StoreController::class, 'checkout'])->name('store.checkout');
Route::get('/order-success/{order_number}', [StoreController::class, 'orderSuccess'])->name('store.order.success');
Route::get('/order-failed', [StoreController::class, 'orderFailed'])->name('store.order.failed');
Route::get('/track/{order_number}', [StoreController::class, 'trackOrder'])->name('store.track');

// Kitchen Display System (KDS)
Route::prefix('kitchen')->name('kitchen.')->group(function () {
    Route::get('/', [KitchenController::class, 'screen'])->name('screen');
    Route::get('/api/tickets', [KitchenController::class, 'apiTickets'])->name('api.tickets');
    Route::get('/api/statuses', [KitchenController::class, 'apiStatuses'])->name('api.statuses');
    Route::post('/api/tickets/{ticket}/status', [KitchenController::class, 'updateStatus'])->name('api.status');
});
