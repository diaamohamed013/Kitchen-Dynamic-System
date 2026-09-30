<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Sections CRUD
    Route::resource('sections', SectionController::class)->except(['create', 'edit', 'show']);

    // Subcategories CRUD
    Route::resource('subcategories', SubcategoryController::class)->except(['create', 'edit', 'show']);

    // Products CRUD
    Route::resource('products', ProductController::class)->except(['create', 'edit', 'show']);

    // Orders & Dispatch
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/dispatch', [OrderController::class, 'dispatchToKitchen'])->name('orders.dispatch');
});
