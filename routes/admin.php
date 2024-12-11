<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

// Admin Controller
Route::controller(AdminController::class)
    ->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::put('profile/update', [ProfileController::class,  'update'])->name('profileUpdate');
Route::post('profile/update/password', [ProfileController::class,  'password'])->name('passwordUpdate');

Route::resource('slider', SliderController::class);
