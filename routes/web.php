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
Route::resource('/random', 'RandomController', ['only' => ['index']]);
Route::get('/browse', 'CardsController@index')->name('cards.index');
Route::get('/cards/{card}', 'CardsController@show')->name('cards.show');
Route::resource('/cards/{card}/likes', 'CardLikesController', ['only' => ['index', 'store']]);
Route::get('/market', 'OrdersController@index')->name('orders.index');
Route::get('/market/export', 'OrdersController@show')->name('orders.show');
Route::get('/trades', 'OrderMatchesController@index')->name('matches.index');
Route::get('/trades/export', 'OrderMatchesController@show')->name('matches.show');
Route::resource('/monitors', 'MonitorsController');
Route::resource('/artists', 'ArtistsController', ['only' => ['index', 'show']]);
Route::get('/artists/{artist}/table', 'ArtistsController@showTable')->name('artists.show.table');
Route::resource('/collectors', 'CollectorsController', ['only' => ['index', 'show']]);
Route::get('/locale/{locale}', 'LocaleController@show')->name('locale.show');
Route::get('/nightmode', 'NightModeController@show')->name('nightmode.show');
Route::get('/charts', 'PagesController@charts')->name('pages.charts');
Route::get('/rankings', 'PagesController@rankings')->name('pages.rankings');
Route::get('/disclaimer', 'PagesController@disclaimer')->name('pages.disclaimer');
Route::get('/investors', 'PagesController@investors')->name('pages.investors');
Route::get('/privacy', 'PagesController@privacy')->name('pages.privacy');
Route::get('/terms', 'PagesController@terms')->name('pages.terms');
Route::get('/cards', 'RedirectController@cardsIndex');
Route::get('/asset/{card}', 'RedirectController@cardsShow');
Route::get('/orders', 'RedirectController@ordersIndex');
Route::get('/dappradar', 'RedirectController@dappradar');
Route::get('/collections/{collection}', 'RedirectController@collectionsShow');
Auth::routes();
