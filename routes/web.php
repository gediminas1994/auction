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
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'items'], function () {
    Route::get('/create', ['as' => 'items.create', 'uses' => 'ItemsController@create']);
    Route::get('/show/{item}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);
});
