<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\RepairController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change_password');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('categories', CategoriesController::class)->except(['create', 'edit', 'show']);
Route::resource('sub_category', SubCategoriesController::class)->except(['create', 'edit', 'show']);

Route::resource('products', ProductsController::class)->names('products');
Route::post('/products/sort', [ProductsController::class, 'sort'])->name('products.sort');
Route::post('/products/toggle-flag', [ProductsController::class, 'toggleFlag'])->name('products.toggleFlag');
Route::post('/products/set-home-banner', [ProductsController::class, 'setHomeBanner'])->name('products.setHomeBanner');
Route::resource('coupons', CouponController::class);

Route::prefix('/orders')->controller(OrdersController::class)
    ->name('orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
        Route::post('/{order}/update-status', 'updateStatus')->name('updateStatus');
        Route::delete('/{order}', 'destroy')->name('destroy');
        Route::post('/update-status', 'updateStatus')->name('updateStatus');
    });

Route::resource('repair',RepairController::class);
Route::resource('messages',MessagesController::class);