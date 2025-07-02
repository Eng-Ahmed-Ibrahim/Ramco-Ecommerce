<?php

use Illuminate\Support\Facades\Route;

Route::view('','web.index')->name('web.index');
Route::view('/about-us','web.about')->name('web.about');
Route::view('/home-appliances','web.products.index')->name('web.products');
Route::view('/home-appliances/show','web.products.show')->name('web.products.show');

Route::view('/cart','web.cart.index');
Route::view('/repair','web.repair.index');
Route::view('/news','web.news.index');
Route::view('/news/article','web.news.show');
Route::view('/contactus','web.contact.index');
Route::view('/login','web.auth.login'); 
Route::view('/register','web.auth.register'); 