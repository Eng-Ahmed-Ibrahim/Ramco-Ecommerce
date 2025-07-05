<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;

    Route::view('/', 'admin.app');
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

