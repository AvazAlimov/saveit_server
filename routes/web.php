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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('main');
})->name('/');

Route::get('/home', 'WebController@index')->name('home');

Route::get('/market/create', 'WebController@createMarket')->name('market.create');
Route::post('/market/create', 'WebController@createMarketSubmit')->name('market.create.submit');
Route::post('/market/delete/{id}', 'WebController@deleteMarket')->name('market.delete');

Route::get('/category/create', 'WebController@createCategory')->name('category.create');
Route::post('/category/create', 'WebController@createCategorySubmit')->name('category.create.submit');
Route::post('/category/delete/{id}', 'WebController@deleteCategory')->name('category.delete');

Route::get('/product/create', 'WebController@createProduct')->name('product.create');
Route::post('/product/create', 'WebController@createProductSubmit')->name('product.create.submit');
Route::post('/product/delete/{id}', 'WebController@deleteProduct')->name('product.delete');
