<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'view'], function () {
    Route::get('register', 'MemberController@register');
    Route::get('login', 'MemberController@login');
    Route::get('category', 'CategoryController@index');
    Route::get('category/show/{cate_id}', 'CategoryController@show');
    Route::get('product/show/{pro_id}', 'ProductController@show');
    Route::get('cart', 'CartController@index');
});


Route::group(['prefix' => 'service/validate', 'namespace' => 'Service'], function () {
    Route::get('code', 'ValidateController@code');
    Route::post('sms', 'ValidateController@sms');
    Route::get('email', 'ValidateController@email');
});
Route::group(['prefix' => 'service', 'namespace' => 'Service'], function () {
    Route::post('login', 'MemberController@login');
    Route::post('register', 'MemberController@register');

    Route::get('category/parent_id/{pid}', 'CategoryController@getSubCate');
    Route::get('cart/add/{id}', 'CartController@add');
    Route::get('cart/delete/{ids}', 'CartController@delete');
});

Route::group(['middleware' => 'check.login'], function () {
    Route::get('order/{ids}', 'view\OrderController@commit');
});