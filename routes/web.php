<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome.index');


Route::get('/orders','OrderController@index')->name('orders.index');
Route::get('/orders-admin','OrderController@admin')->name('orders.admin');

Route::get('/orders/search','OrderController@search')->name('orders.search');
Route::post('/orders/search-view','OrderController@searchView')->name('orders.search.view');


Route::get('/buy/{id}','OrderController@buy')->name('orders.buy');
Route::get('/orders/view/{id}','OrderController@view')->name('orders.view');//->middleware('auth');

Route::post('/orders/store','OrderController@store')->name('orders.store');

Route::get('/orders/payment/check-status/{id}','OrderController@checkPayment')->name('orders.checkPayment');
Route::get('/orders/payment/{id}','OrderController@payment')->name('orders.payment');




Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
