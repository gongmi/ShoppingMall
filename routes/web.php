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
    Route::get('/', 'CategoryController@index');
    Route::get('category/show/{cate_id}', 'CategoryController@show');
    Route::get('product/show/{pro_id}', 'ProductController@show');
    Route::get('cart', 'CartController@index');

    Route::group(['middleware' => 'check.login'], function () {
        Route::get('order/{ids}', 'OrderController@commit');
        Route::get('order_list/{id?}', 'OrderController@index');
    });
});


Route::group(['prefix' => 'service/validate', 'namespace' => 'Service'], function () {
    Route::get('code', 'ValidateController@code');
    Route::post('sms', 'ValidateController@sms');
    Route::get('email', 'ValidateController@email');
});
Route::group(['prefix' => 'service', 'namespace' => 'Service'], function () {
    Route::post('login', 'MemberController@login');
    Route::post('register', 'MemberController@register');
    Route::post('upload/{type}', 'UploadController@uploadFile');

    Route::get('category/parent_id/{pid}', 'CategoryController@getSubCate');
    Route::get('cart/add/{id}', 'CartController@add');
    Route::get('cart/delete/{ids}', 'CartController@delete');
});

/***********************************后台相关***********************************/

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\IndexController@toLogin');
    Route::get('exit', 'Admin\IndexController@toExit');
    Route::post('service/login', 'Admin\IndexController@login');

    Route::group(['middleware' => 'check.admin.login'], function () {

        Route::group(['prefix' => 'service'], function () {
            Route::post('category/add', 'Admin\CategoryController@categoryAdd');
            Route::post('category/del', 'Admin\CategoryController@categoryDel');
            Route::post('category/edit', 'Admin\CategoryController@categoryEdit');

            Route::post('product/add', 'Admin\ProductController@productAdd');
            Route::post('product/del', 'Admin\ProductController@productDel');
            Route::post('product/edit', 'Admin\ProductController@productEdit');

            Route::post('member/edit', 'Admin\MemberController@memberEdit');

            Route::post('order/edit', 'Admin\OrderController@orderEdit');
        });

        Route::get('index', 'Admin\IndexController@toIndex');

        Route::get('category', 'Admin\CategoryController@toCategory');
        Route::get('category_add', 'Admin\CategoryController@toCategoryAdd');
        Route::get('category_edit', 'Admin\CategoryController@toCategoryEdit');

        Route::get('product', 'Admin\ProductController@toProduct');
        Route::get('product_info', 'Admin\ProductController@toProductInfo');
        Route::get('product_add', 'Admin\ProductController@toProductAdd');
        Route::get('product_edit', 'Admin\ProductController@toProductEdit');

        Route::get('member', 'Admin\MemberController@toMember');
        Route::get('member_edit', 'Admin\MemberController@toMemberEdit');

        Route::get('order', 'Admin\OrderController@toOrder');
        Route::get('order_edit', 'Admin\OrderController@toOrderEdit');
    });
});
