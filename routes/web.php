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
        Route::get('/orders/{id}','OrderController@showOrder')->name('orders.show');
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
            Route::get('/orders/{id}','OrderController@showOrder')->name('orders.show');
        });
        Route::resource('categories','CategoryController');
        Route::resource('products','ProductController');
        Route::resource('products/{product}/skus','SkuController');
        Route::resource('properties',"PropertyController");
        Route::resource('properties/{property}/property_options',"PropertyOptionController");
    });
});




Route::get('/','MainController@index')->name('index');
Route::post('subscription/{product}',"MainController@subscribe")->name("subscribe");

Route::group([
    'prefix' => 'basket',
    'middleware' => 'auth'
], function() {
    Route::post('/add/{product}','BasketController@basketAdd')->name('basketAdd');
    Route::group([
        'middleware' => 'basket_not_empty'
    ], function() {
        Route::get('/','BasketController@basket')->name('basket');
        Route::get('/checkout/','BasketController@checkout')->name('checkout');
        Route::post('/delete/{product}','BasketController@basketRemove')->name('basketRemove');
        Route::post('/checkout/','BasketController@confirmOrder')->name('confirmOrder');
    });
});
Route::group([
    'prefix' => 'catalog'
], function() {
    Route::get('/categories/','MainController@categories')->name('categories');
    Route::get('/{category}/','MainController@category')->name('category');
    Route::get('/{category}/{product?}/','MainController@product')->name('product');
});


