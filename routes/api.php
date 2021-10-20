<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', 'Api\AuthApi@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'api_access'], function () {
    Route::get('/order-list', 'Api\OrderApi@showOrderlist');
});
