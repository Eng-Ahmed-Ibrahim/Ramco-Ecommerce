<?php

use Illuminate\Support\Facades\Route;
Route::middleware(['guest_id'])->name('web.')->group(function () {
    Route::view('/', 'web.index')->name('index');
    Route::view('/about-us', 'web.about')->name('about');
    Route::view('/home-appliances', 'web.products.index')->name('products');
    Route::view('/home-appliances/show', 'web.products.show')->name('products.show');

    Route::view('/cart', 'web.cart.index')->name('cart');
    Route::view('/repair', 'web.repair.index')->name('repair');
    Route::view('/news', 'web.news.index')->name('news');
    Route::view('/news/article', 'web.news.show');
    Route::view('/contactus', 'web.contact.index')->name('contact');
    Route::view('/login', 'web.auth.login'); 
    Route::view('/register', 'web.auth.register')->name('register'); 

});