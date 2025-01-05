<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('frontend.flashSale');

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'verified'])
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

Route::prefix('user/dashboard')
    ->name('user.')
    ->middleware(['auth', 'verified'])
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::put('profile/update', 'update')->name('update');
        Route::put('profile/update/password', 'password')->name('password.update');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login')->middleware('guest');
