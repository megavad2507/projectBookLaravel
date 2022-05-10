<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('index.index');
//});

Auth::routes();

Route::get('locale/{locale}','MainController@changeLocale')->name('locale');
Route::get('currency{currency}','MainController@changeCurrency')->name('currency');

Route::get('reset','ResetController@reset')->name('resetProject');

Route::middleware(['auth'])->group(function() {
    Route::get('/logout','Auth\LoginController@logout')->name('get-logout');
    Route::group([
        'prefix' => 'person',
        'namespace' => 'Person',
        'as' => 'person.'
    ], function() {
        Route::get('/orders','OrderController@index')->name('orders.index');
        Route::get('/orders/{order}','OrderController@showOrder')->name('orders.show');
    });

    Route::group([
        'middleware' => 'auth',
        'namespace' => 'Admin',
        'prefix' => 'admin'
    ],function() {
        Route::group([
            'middleware' => 'is_admin'
        ],function() {
            Route::get('/orders','OrderController@index')->name('home');
            Route::get('/orders/{order}','OrderController@showOrder')->name('orders.show');
        });
        Route::resource('categories','CategoryController');
        Route::resource('products','ProductController');
        Route::resource('products/{product}/skus','SkuController');
        Route::resource('properties',"PropertyController");
        Route::resource('properties/{property}/property_options',"PropertyOptionController");
        Route::resource('coupons','CouponController');
        Route::resource('merchants','MerchantController');
        Route::resource('banners','BannerController');
        Route::get('merchants/{merchant}/update_token','MerchantController@updateToken')->name('merchants.update_token');
    });
});




Route::get('/','MainController@index')->name('index');
Route::post('subscription/{sku}',"MainController@subscribe")->name("subscribe");
Route::get('/basket/modal/unauthorized','BasketController@basketUnauthorizedModal')->name('basketUnauthorized');
Route::group([
    'prefix' => 'basket',
    'middleware' => 'auth'
], function() {
    Route::get('/modal/get-sku','BasketController@searchSku');
    Route::post('/add/{sku}','BasketController@basketAdd')->name('basketAdd');
    Route::get('/modal/{productId}','BasketController@basketAddModal')->name('basketAddModal');
    Route::group([
        'middleware' => 'basket_not_empty'
    ], function() {
        Route::get('/','BasketController@basket')->name('basket');
        Route::get('/checkout/','BasketController@checkout')->name('checkout');
        Route::post('/delete/{sku}','BasketController@basketRemove')->name('basketRemove');
        Route::post('/checkout/','BasketController@confirmOrder')->name('confirmOrder');
        Route::post('/coupon','BasketController@setCoupon')->name('setCoupon');
        Route::post('/coupon/delete/{coupon}','BasketController@deleteCoupon')->name('deleteCoupon');
    });
});
Route::group([
    'prefix' => 'catalog'
], function() {
    Route::get('/categories/','MainController@categories')->name('categories');
    Route::get('/{category}/','MainController@category')->name('category');
    Route::get('/{category}/{product}/{sku}','MainController@sku')->name('sku');
    Route::get('/{category}/{product}/','MainController@product')->name('product');
});

Route::get('/search/','MainController@search')->name('search');


