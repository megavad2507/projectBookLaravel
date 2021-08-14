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
Route::get('/logout','Auth\LoginController@logout')->name('get-logout');

Route::group([
    'middleware' => 'auth',
    'namespace' => 'Admin',
    'prefix' => 'admin'
],function() {
    Route::get('/orders','OrderController@index')->name('home');
    Route::resource('categories','CategoryController');
    Route::resource('products','ProductController');
});


Route::get('/','MainController@index')->name('index');


Route::group([
    'prefix' => 'basket'
], function() {
    Route::get('/','BasketController@basket')->name('basket');
    Route::get('/checkout/','BasketController@checkout')->name('checkout');
    Route::post('/add/{id}','BasketController@basketAdd')->name('basketAdd');
    Route::post('/delete/{id}','BasketController@basketRemove')->name('basketRemove');
    Route::post('/checkout/','BasketController@confirmOrder')->name('confirmOrder');
});
Route::group([
    'prefix' => 'catalog'
], function() {
    Route::get('/categories/','MainController@categories')->name('categories');
    Route::get('/{category}/','MainController@category')->name('category');
    Route::get('/{category}/{product?}/','MainController@product')->name('product');
});


