<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Route;

// Admin Controller
Route::controller(AdminController::class)
    ->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::put('profile/update', [ProfileController::class,  'update'])->name('profileUpdate');
Route::post('profile/update/password', [ProfileController::class,  'password'])->name('passwordUpdate');

// Slider Controller 
Route::resource('slider', SliderController::class);

// Category Controller
Route::resource('category', CategoryController::class);
Route::post('/category/update-status', [CategoryController::class, 'updateStatus'])->name('category.update.status');

// Sub Category Controller
Route::resource('sub-category', SubCategoryController::class);
Route::post('/sub-category/update-status', [SubCategoryController::class, 'updateStatus'])->name('sub-category.update.status');

// Child Category Controller
Route::resource('child-category', ChildCategoryController::class);
Route::post('/child-category/update-status', [ChildCategoryController::class, 'updateStatus'])->name('child-category.update.status');
Route::get('categories/{slug}/sub-categories', [ChildCategoryController::class, 'subCategories'])->name('categories.sub-categories');
