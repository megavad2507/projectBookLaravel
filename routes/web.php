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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,

]);
Route::get('/','MainController@index')->name('index');
Route::get('/basket/','BasketController@basket')->name('basket');
Route::get('/basket/checkout/','BasketController@checkout')->name('checkout');


Route::post('/basket/add/{id}','BasketController@basketAdd')->name('basketAdd');
Route::post('/basket/delete/{id}','BasketController@basketRemove')->name('basketRemove');
Route::post('/basket/checkout/','BasketController@confirmOrder')->name('confirmOrder');
Route::get('/catalog/categories/','MainController@categories')->name('categories');
Route::get('/catalog/{category}/','MainController@category')->name('category');
Route::get('/catalog/{category}/{product?}/','MainController@product')->name('product');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
