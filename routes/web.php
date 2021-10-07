<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/register', 'AuthController@showRegister');
Route::post('/register', 'AuthController@register');
Route::get('/login', 'AuthController@showLogin');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

Route::get('/', 'PageController@home');
Route::get('/product/{slug}', 'PageController@productDetail');


Route::get('admin/login', 'Admin\AuthController@showLogin');
Route::post('admin/login', 'Admin\AuthController@postLogin');

Route::group(['prefix' => 'admin', 'namespace' => "Admin", 'middleware' => "AdminCanRoute"], function () {
    Route::get('/', 'PageController@home');

    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
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
