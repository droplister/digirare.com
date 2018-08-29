<?php

use Illuminate\Http\Request;

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

Route::resource('/cards/{card}/likes', 'Api\CardLikesController', ['only' => ['index', 'store']]);
Route::get('/cards/{card}/order-history', 'Api\CardChartsController@orderHistory')->name('api.cards.order-history');