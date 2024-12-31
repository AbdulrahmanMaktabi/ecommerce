<?php

use App\Http\Controllers\Backend\VendorStoreProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use Illuminate\Support\Facades\Route;

// Vendor Controller
Route::controller(VendorController::class)
    ->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
Route::controller(VendorProfileController::class)
    ->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::put('profile/update', 'update')->name('update');
        Route::put('profile/update/password', 'password')->name('password.update');
    });
Route::resource('store-profile', VendorStoreProfileController::class);

// Product Controller
Route::resource('product', VendorProductController::class);
Route::get('/product/categories/{id}/sub-categories', [VendorProductController::class, 'subCategories'])->name('product.categories.sub-categories');
Route::get('/product/categories/sub-categories/{id}/child-categories', [VendorProductController::class, 'childCategories'])->name('product.sub-categories.child-categories');
Route::post('/product/status/update', [VendorProductController::class, 'updateState'])->name('product.update.status');
