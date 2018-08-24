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
Route::resource('xcpcards', 'CardsController', ['only' => ['index', 'show']]);
Route::resource('curators', 'CuratorsController', ['only' => ['index', 'show']]);
Route::resource('collectors', 'CollectorsController', ['only' => ['index', 'show']]);