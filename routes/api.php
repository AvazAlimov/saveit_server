<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/markets', 'ApiController@markets');
Route::get('/market&id={id}', 'ApiController@market');

Route::get('/categories', 'ApiController@categories');
Route::get('/category&id={id}', 'ApiController@category');

Route::get('/products', 'ApiController@products');
Route::get('/product&id={id}', 'ApiController@product');