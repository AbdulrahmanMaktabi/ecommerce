<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CheckOutController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\CartController;
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

// Frontend Routes
Route::name('frontend.')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flashSale');
        // Route with slug
        Route::get('product/{slug}', [ProductController::class, 'index'])->name('product');
        // Redirect when no slug is provided
        Route::get('product', function () {
            return redirect()->route('frontend.home');
        });
        // 
        Route::post('/get-variant-price', [ProductController::class, 'getVariantPrice'])->name('product.getVariantPrice');


        Route::name('cart.')
            ->group(function () {
                // Cart Page
                Route::get('cart', [CartController::class, 'cart'])->name('index');
                // Add to cart
                Route::post('cart/add', [CartController::class, 'addToCart'])->name('add');
                // Delete All Items in Cart
                Route::get('car/destroy', [CartController::class, 'destroy'])->name('destroy');
                // Delete Specific item in cart
                Route::get('cart/delete/{rowId}', [CartController::class, 'delete'])->name('delete');
                // Update qty item in cart
                Route::post('cart/update/qty', [CartController::class, 'updateQty'])->name('updateQty');
                // Get total price after update qty
                Route::post('cart/sub-total', [CartController::class, 'subTotal'])->name('subTotal');
                // Calculate Total Amount
                Route::post('cart/total', [CartController::class, 'calculateTotal'])->name('calculateTotal');
                // Coupon
                Route::post('cart/coupon', [CartController::class, 'coupon'])->name('coupon');
                // Caclculate Applied Coupon
                Route::post('cart/coupon/apply', [CartController::class, 'calculateCouponDiscount'])->name('calculateCouponDiscount');
            });
    });

// Frontend Dashboard Routes
Route::prefix('dashboard')
    ->group(function () {
        // Address Controller
        Route::prefix('address')
            ->name('address.')
            ->group(function () {
                Route::get('/', [UserAddressController::class, 'index'])->name('index');
                Route::get('create', [UserAddressController::class, 'create'])->name('create');
                Route::post('sotre', [UserAddressController::class, 'store'])->name('store');
                Route::get('get-cities', [UserAddressController::class, 'getCities'])->name('get-cities');
                Route::get('eidt/{addressID}', [UserAddressController::class, 'edit'])->name('edit');
                Route::put('update/{addressID}', [UserAddressController::class, 'update'])->name('update');
                Route::delete('destroy/{addressID}', [UserAddressController::class, 'destroy'])->name('destroy');
            });
    });

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout Routes
    Route::name('checkout.')
        ->prefix('checkout')
        ->group(function () {
            Route::get('/', [CheckOutController::class, 'index'])->name('index');
            Route::post('address/create', [CheckOutController::class, 'address'])->name('address');
            Route::post('checkout', [CheckOutController::class, 'checkout'])->name('checkout');
        });

    // Payment Routs
    Route::name('payment.')
        ->prefix('payment')
        ->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
        });
});

require __DIR__ . '/auth.php';

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login')->middleware('guest');
