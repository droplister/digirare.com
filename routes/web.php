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
Route::resource('/cards/{card}/collectors', 'CardCollectorsController', ['only' => ['index'], 'names' => ['index' => 'cards.collectors.index']]);
Route::get('/market', 'OrdersController@index')->name('orders.index');
Route::get('/trades', 'OrderMatchesController@index')->name('matches.index');
Route::resource('/monitors', 'MonitorsController');
Route::resource('/artists', 'ArtistsController', ['only' => ['index', 'show']]);
Route::get('/artists/{artist}/table', 'ArtistsController@showTable')->name('artists.show.table');
Route::resource('/collectors', 'CollectorsController', ['only' => ['index', 'show']]);
Route::get('/locale/{locale}', 'LocaleController@show')->name('locale.show');
Route::get('/nightmode', 'NightModeController@show')->name('nightmode.show');
Route::get('/charts', 'PagesController@charts')->name('pages.charts');
Route::get('/dappradar', 'PagesController@dappradar')->name('pages.dappradar');
Route::get('/disclaimer', 'PagesController@disclaimer')->name('pages.disclaimer');
Route::get('/investors', 'PagesController@investors')->name('pages.investors');
Route::get('/privacy', 'PagesController@privacy')->name('pages.privacy');
Route::get('/terms', 'PagesController@terms')->name('pages.terms');
Route::get('/cards', 'RedirectController@cardsIndex');
Route::get('/asset/{card}', 'RedirectController@cardsShow');
Route::get('/orders', 'RedirectController@ordersIndex');
Route::get('/collections/{collection}', 'RedirectController@collectionsShow');
Auth::routes();
