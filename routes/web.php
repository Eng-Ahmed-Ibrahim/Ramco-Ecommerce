<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\Web\ProductsController;

Route::middleware(['guest_id'])->name('web.')->group(function () {

    Route::controller(PagesController::class)->name('pages.')->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about-us', 'about')->name('about');
    });

    Route::controller(ProductsController::class)->name('products.')->group(function () {
        Route::get('/products/{category_slug}', 'index')->name('index');
        Route::get('/products/{category_slug}/{product_slug}', 'show')->name('show');
    });

    Route::view('/repair', 'web.repair.index')->name('repair');
    Route::view('/news', 'web.news.index')->name('news');
    Route::view('/news/article', 'web.news.show');
    Route::view('/contactus', 'web.contact.index')->name('contact');
    Route::controller(AuthController::class)->name('auth.')->group(function () {
        Route::get('login', 'login')->name('login');
        Route::get('register', 'register')->name('register');
    });
    Route::controller(CartController::class)->name('cart.')->group(function () {
        Route::get('/cart', 'index')->name('index');
        Route::post('/add-to-cart', 'add_to_cart')->name('add_to_cart');
        Route::delete('/delete-item', 'delete_item')->name('delete_item');
    });
    
});
