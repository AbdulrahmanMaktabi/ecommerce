<?php

use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemsController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProduct;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FlashSaleItemsController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\ShippingRulesController;
use App\Models\ChildCategory;
use App\Models\ProductImageGallery;
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

// Brand Controller
Route::resource('brand', BrandController::class);
Route::post('/brand/update-status', [BrandController::class, 'updateStatus'])->name('brand.update.status');

// Vendor Profile
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::resource('profile', AdminVendorController::class);
});

// Product Controller
Route::resource('product', ProductController::class);
Route::post('/product/update-status', [ProductController::class, 'updateStatus'])->name('product.update.status');
Route::get('/product/categories/{id}/sub-categories', [ProductController::class, 'subCategories'])->name('product.categories.sub-categories');
Route::get('/product/categories/sub-categories/{id}/child-categories', [ProductController::class, 'childCategories'])->name('product.sub-categories.child-categories');
// Product Image Gallery
Route::prefix('products')->name('product.')->group(function () {
    Route::resource('image-gallery', ProductImageGalleryController::class);
});
// Product Variant
Route::prefix('products')->name('product.')->group(function () {
    Route::resource('variant', ProductVariantController::class);
});
Route::post('/product/variant/update-status', [ProductVariantController::class, 'updateStatus'])->name('product.variant.update.status');
// Product Variant Items
Route::prefix('variant')->name('variant.items.')->group(function () {
    Route::get('items/product/{product_id}/variant/{variant_id}', [ProductVariantItemsController::class, 'index'])->name('index');
    Route::get('create/items/variant/{variant_id}', [ProductVariantItemsController::class, 'create'])->name('create');
    Route::post('store/items/variant/', [ProductVariantItemsController::class, 'store'])->name('store');
    Route::get('edit/items/variant/{variant_id}/item/{variant_item_id}', [ProductVariantItemsController::class, 'edit'])->name('edit');
    Route::put('update/items/variant/{variant_id}/item/{variant_item_id}', [ProductVariantItemsController::class, 'update'])->name('update');
    Route::delete('delete/items/variant/{variant_id}/item/{variant_item_id}', [ProductVariantItemsController::class, 'destroy'])->name('delete');

    Route::post('/product/variant/item/update-status', [ProductVariantItemsController::class, 'updateStatus'])->name('update.status');
});

// Seller Product Controller
Route::prefix('products/seller')
    ->name('product.seller.')
    ->group(function () {
        Route::get('/', [SellerProduct::class, 'index'])->name('index');
        Route::get('pending', [SellerProduct::class, 'pending'])->name('pending');
        Route::post('pending/approve/update', [SellerProduct::class, 'updateApprove'])->name('updateApprove');
    });

// Flash Sale Controller
Route::prefix('flash-sale')
    ->name('flashSale.')
    ->group(function () {
        Route::get('/', [FlashSaleController::class, 'index'])->name('index');
        Route::get('create', [FlashSaleController::class, 'create'])->name('create');
        Route::post('store', [FlashSaleController::class, 'store'])->name('store');
        Route::get('edit/{flashSaleID}', [FlashSaleController::class, 'edit'])->name('edit');
        Route::put('update/{flashSaleID}', [FlashSaleController::class, 'update'])->name('update');
        Route::post('updateStatus', [FlashSaleController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('delete/{flashSaleID}', [FlashSaleController::class, 'destroy'])->name('destroy');
    });

Route::prefix('flash-sale/items')
    ->name('flashSale.items.')
    ->group(function () {
        Route::get('/{flashSaleID}', [FlashSaleItemsController::class, 'index'])->name('index');
        Route::get('create/{flashSaleID}', [FlashSaleItemsController::class, 'create'])->name('create');
        Route::post('store/{flashSaleID}', [FlashSaleItemsController::class, 'store'])->name('store');
        // Route::get('edit', [FlashSaleItemsController::class, 'edit'])->name('edit');
        // Route::put('update', [FlashSaleItemsController::class, 'update'])->name('update');
        Route::delete('delete/{flashSaleItemID}', [FlashSaleItemsController::class, 'destroy'])->name('destroy');
        Route::get('product/categories/child-categories/{childCategoryId}/products', [FlashSaleItemsController::class, 'getProductsByChildCategory']);
    });

// General Settings Controller
Route::prefix('settings')
    ->name('settings.')
    ->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('update', [SettingsController::class, 'update'])->name('update');
    });

// Coupons Controller
Route::prefix('coupon')
    ->name('coupon.')
    ->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('create', [CouponController::class, 'create'])->name('create');
        Route::post('store', [CouponController::class, 'store'])->name('store');
        Route::get('edit/{couponID}', [CouponController::class, 'edit'])->name('edit');
        Route::put('update/{couponID}', [CouponController::class, 'update'])->name('update');
        Route::delete('delete/{couponID}', [CouponController::class, 'destroy'])->name('delete');
        Route::post('update-status', [CouponController::class, 'updateStatus'])->name('updateStatus');
    });

// Shipping Rules Controller
Route::prefix('shipping-rule')
    ->name('shippingRule.')
    ->group(function () {
        Route::get('/', [ShippingRulesController::class, 'index'])->name('index');
        Route::get('create', [ShippingRulesController::class, 'create'])->name('create');
        Route::post('store', [ShippingRulesController::class, 'store'])->name('store');
        Route::get('edit/{shippingRuleID}', [ShippingRulesController::class, 'edit'])->name('edit');
        Route::put('update/{shippingRuleID}', [ShippingRulesController::class, 'update'])->name('update');
        Route::delete('delete/{shippingRuleID}', [ShippingRulesController::class, 'destroy'])->name('delete');
        Route::post('update-status', [ShippingRulesController::class, 'updateStatus'])->name('updateStatus');
    });
