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
Route::resource('/monitors', 'MonitorsController');
// Cards
Route::get('/browse', 'CardsController@index')->name('cards.index');
Route::get('/cards/{card}', 'CardsController@show')->name('cards.show');
// Likes
Route::resource('/cards/{card}/likes', 'CardLikesController', ['only' => ['index', 'store']]);
// Claim
Route::get('/cards/{card}/claim', 'CardClaimsController@show')->name('claims.show');
Route::post('/cards/{card}/claim', 'CardClaimsController@store')->name('claims.store');
// Orders
// Route::get('/market', 'OrdersController@index')->name('orders.index');
// Route::get('/market/export', 'OrdersController@show')->name('orders.show');
Route::view('/market', 'welcome')->name('orders.index');
Route::view('/market/export', 'welcome')->name('orders.show');
// Order Matches
// Route::get('/trades', 'OrderMatchesController@index')->name('matches.index');
// Route::get('/trades/export', 'OrderMatchesController@show')->name('matches.show');
Route::view('/trades', 'welcome')->name('matches.index');
Route::view('/trades/export', 'welcome')->name('matches.show');
// Artists
Route::resource('/artists', 'ArtistsController', ['only' => ['index', 'show']]);
// Collectors
// Route::resource('/collectors', 'CollectorsController', ['only' => ['index', 'show']]);
Route::view('/collectors', 'welcome');
// Pages
// Route::get('/charts', 'PagesController@charts')->name('pages.charts');
// Route::get('/rankings', 'PagesController@rankings')->name('pages.rankings');
Route::view('/charts', 'welcome')->name('pages.charts');
Route::view('/rankings', 'welcome')->name('pages.rankings');
Route::get('/disclaimer', 'PagesController@disclaimer')->name('pages.disclaimer');
Route::get('/investors', 'PagesController@investors')->name('pages.investors');
Route::get('/privacy', 'PagesController@privacy')->name('pages.privacy');
Route::get('/terms', 'PagesController@terms')->name('pages.terms');
// Random
Route::resource('/random', 'RandomController', ['only' => ['index']]);
// Redirects
Route::get('/cards', 'RedirectController@cardsIndex');
Route::get('/asset/{card}', 'RedirectController@cardsShow');
Route::get('/orders', 'RedirectController@ordersIndex');
Route::get('/dappradar', 'RedirectController@dappradar');
Route::get('/collections', 'RedirectController@collectionsIndex');
Route::get('/collections/{collection}', 'RedirectController@collectionsShow');
// Session
Route::get('/locale/{locale}', 'LocaleController@show')->name('locale.show');
Route::get('/nightmode', 'NightModeController@show')->name('nightmode.show');
// Auth
Auth::routes();