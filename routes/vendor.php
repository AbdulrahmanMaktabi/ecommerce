<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use Illuminate\Support\Facades\Route;

// Vendor Controller
Route::controller(VendorController::class)
    ->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
Route::controller(VendorProfileController::class)
    ->prefix('dashboard')
    ->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::put('profile/update', 'update')->name('update');
        Route::put('profile/update/password', 'password')->name('password.update');
    });
