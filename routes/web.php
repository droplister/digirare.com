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

Route::get('/', 'HomeController@index')->name('home.index');
Route::resource('random', 'RandomController', ['only' => ['index']]);
Route::resource('cards', 'CardsController', ['only' => ['index', 'show']]);
Route::resource('cards/{card}/likes', 'CardLikesController', ['only' => ['index', 'store']]);
Route::resource('cards/{card}/trades', 'CardTradesController', ['only' => ['index'], 'names' => ['index' => 'cards.trades.index']]);
Route::resource('cards/{card}/collectors', 'CardCollectorsController', ['only' => ['index'], 'names' => ['index' => 'cards.collectors.index']]);
Route::resource('orders', 'OrdersController', ['only' => ['index']]);
Route::resource('artists', 'ArtistsController', ['only' => ['index', 'show']]);
Route::get('artists/{artist}/table', 'ArtistsController@showTable')->name('artists.show.table');
Route::resource('collectors', 'CollectorsController', ['only' => ['index', 'show']]);
Route::resource('collectors/{collector}/trades', 'CollectorTradesController', ['only' => ['index'], 'names' => ['index' => 'collectors.trades.index']]);
Route::resource('collections', 'CollectionsController', ['only' => ['index', 'show']]);
Auth::routes();