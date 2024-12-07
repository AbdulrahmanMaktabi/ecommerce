<?php

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;

// Admin Controller
Route::controller(AdminController::class)
    ->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
