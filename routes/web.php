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

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth.shopify'])->name('home');
Route::get('orders','shopify@orders');
Route::get('index','shopify@index');
Route::get('edit/{id}','shopify@edit');
Route::post('delete/{id}','shopify@delete');
Route::post('update','shopify@update');
Route::post('back/{id}','shopify@update');