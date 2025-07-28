<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\Web\RepairController;
use App\Http\Controllers\Web\MessagesController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\UseGuidesController;

Route::middleware(['guest_id'])->name('web.')->group(function () {

    Route::controller(PagesController::class)->name('pages.')->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about-us', 'about')->name('about');
    });

    Route::controller(ProductsController::class)->name('products.')->group(function () {
        Route::get('/products/{category_slug}', 'index')->name('index');
        Route::get('/products/{category_slug}/{product_slug}', 'show')->name('show');
        Route::get('/subcategory-products', 'fetchBySubcategory')->name('fetch.by.subcategory');
    });


    Route::controller(AuthController::class)->name('auth.')->group(function () {
        Route::get('login', 'login_form')->name('login');
        Route::get('register', 'register_form')->name('register');
        Route::post("login",'login')->name("login.submit");
        Route::post("register",'register')->name("register.submit");
    });
    Route::controller(CartController::class)->name('cart.')->group(function () {
        Route::get('/cart', 'index')->name('index');
        Route::post('/add-to-cart', 'add_to_cart')->name('add_to_cart');
        Route::delete('/delete-item', 'delete_item')->name('delete_item');
    });
    Route::post('/creat-order', [OrderController::class, 'create_order'])->name('order.create');
    Route::post('/apply-discount', [CartController::class, 'applyDiscount']);

    Route::controller(RepairController::class)->prefix('repair/')->name('repair.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });
    Route::controller(UseGuidesController::class)->prefix('smart-use-guides/')->name('use_guides.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });

    Route::controller(MessagesController::class)->prefix('contact-us/')->name('messages.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');

    });
});

Route::get('/sss',function(){
    return "Test1"
    ;
});
Route::get('/sss-sss',function(){
    return "Testss"
    ;
});


