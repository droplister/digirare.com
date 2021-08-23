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

Route::get('/search', 'Api\SearchController@index')->name('search.index');
Route::get('/metrics/count', 'Api\MetricsController@showCount')->name('metrics.count');
Route::get('/wallet/{address}', 'Api\WalletController@show')->name('wallet.show');
Route::get('/widget/{asset}', 'Api\WidgetController@show')->name('widget.show');
