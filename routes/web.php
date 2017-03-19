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

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function (){
	Route::get('/users/{user}', ['uses' => 'UsersController@show']);
	Route::get('/users/{user}/edit', ['uses' => 'UsersController@show']);
	Route::patch('/users/{user}', ['uses' => 'UsersController@update']);
	Route::delete('/users/{user}', ['uses' => 'UsersController@delete']);
});
