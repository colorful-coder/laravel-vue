<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('product', 'ProductController@index');
Route::post('product', 'ProductController@store');
Route::get('product/{id}', 'ProductController@show');
Route::put('product/{id}', 'ProductController@update');
Route::delete('product/{id}', 'ProductController@destroy');

