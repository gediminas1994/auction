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

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'], function (){
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);
        Route::get('/{user}', ['as' => 'admin.users.show', 'uses' => 'UsersController@show']);
        Route::get('/{user}/edit', ['as' => 'admin.users.edit', 'uses' => 'UsersController@show']);
        Route::patch('/{user}', ['as' => 'admin.users.update', 'uses' => 'UsersController@update']);
        Route::delete('/{user}', ['as' => 'admin.users.delete', 'uses' => 'UsersController@delete']);
    });
});

Route::group(['prefix' => 'user', 'namespace' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/{user}', ['as' => 'user.show', 'uses' => 'UsersController@show']);
    Route::get('/{user}/edit', ['as' => 'user.edit', 'uses' => 'UsersController@show']);
    Route::patch('/{user}', ['as' => 'user.update', 'uses' => 'UsersController@update']);
    Route::delete('/{user}', ['as' => 'user.delete', 'uses' => 'UsersController@delete']);
});