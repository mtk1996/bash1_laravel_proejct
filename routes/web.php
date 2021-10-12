<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/register', 'AuthController@showRegister');
Route::post('/register', 'AuthController@register');
Route::get('/login', 'AuthController@showLogin')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

Route::get('/', 'PageController@home');
Route::get('/product/{slug}', 'PageController@productDetail')->name('product.detail');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', 'CartController@showCart');
    Route::get('add-cart', 'CartController@addToCart');
    Route::post('update-cart', 'CartController@updateCart');
    Route::get('/order', 'OrderController@makeOrder');
    Route::get('/order-list', 'OrderController@orderList');

    Route::post('/create-review', 'PageController@makeReview');
});




Route::get('admin/login', 'Admin\AuthController@showLogin');
Route::post('admin/login', 'Admin\AuthController@postLogin');

Route::group(['prefix' => 'admin', 'namespace' => "Admin", 'middleware' => "AdminCanRoute"], function () {
    Route::get('/', 'PageController@home');

    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');

    Route::get('/order', 'OrderController@index');
    Route::get('/change-order', 'OrderController@change');
});


Route::get('/no-authorize', function () {
    return 'no-authorize';
});


Route::get('/user/auth', function () {
    auth()->attempt(['email' => "userone@a.com", 'password' => 'password']);
    return auth()->user();
});

Route::get('/admin/auth', function () {
    auth()->attempt(['email' => "admin@a.com", 'password' => 'password']);
    return auth()->user();
});



Route::get('/test', function () {
    return Category::withCount('product')->get();
});
