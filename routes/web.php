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

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'], function (){
    Route::group(['prefix' => 'users'], function () {
        //user CRUD as admin
        Route::get('/', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);
        Route::get('/{user}', ['as' => 'admin.users.show', 'uses' => 'UsersController@show']);
        Route::get('/{user}/edit', ['as' => 'admin.users.edit', 'uses' => 'UsersController@edit']);
        Route::patch('/{user}', ['as' => 'admin.users.update', 'uses' => 'UsersController@update']);
        Route::delete('/{user}', ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);

        //block and unblock users as admin
        Route::patch('/{user}', ['as' => 'admin.users.block', 'uses' => 'UsersController@block']);
        Route::patch('/{user}', ['as' => 'admin.users.unblock', 'uses' => 'UsersController@unblock']);
    });
});

Route::group(['prefix' => 'user', 'namespace' => 'user', 'middleware' => 'auth'], function () {
    //user info
    Route::get('/{user}', ['as' => 'user.show', 'uses' => 'UsersController@show']);
    Route::get('/{user}/edit', ['as' => 'user.edit', 'uses' => 'UsersController@show']);
    Route::patch('/{user}', ['as' => 'user.update', 'uses' => 'UsersController@update']);

    //user bank Accounts
    Route::get('/{user}/bankAccounts', ['as' => 'user.bankAccounts', 'uses' => 'BankAccountsController@index']);
    Route::post('/{user}/bankAccounts', ['as' => 'user.bankAccounts.store', 'uses' => 'BankAccountsController@store']);
    Route::get('/{user}/bankAccounts/{bankRecord}/edit', ['as' => 'user.bankAccounts.edit', 'uses' => 'BankAccountsController@edit']);
    Route::patch('/{user}/bankAccounts/{bankRecord}', ['as' => 'user.bankAccounts.update', 'uses' => 'BankAccountsController@update']);
    Route::delete('/{user}/bankAccounts/{bankRecord}', ['as' => 'user.bankAccounts.destroy', 'uses' => 'BankAccountsController@destroy']);

    //user items
    Route::get('/{user}/items', ['as' => 'user.items', 'uses' => 'ItemController@index']);
    Route::get('/{user}/items/create', ['as' => 'user.items.create', 'uses' => 'ItemController@create']);
    Route::post('/{user}/items', ['as' => 'user.items.store', 'uses' => 'ItemController@store']);
    Route::get('/{user}/items/{item}', ['as' => 'user.items.show', 'uses' => 'ItemController@show']);
    Route::get('/{user}/items/{item}/edit', ['as' => 'user.items.edit', 'uses' => 'ItemController@edit']);
    Route::patch('/{user}/items/{item}', ['as' => 'user.items.update', 'uses' => 'ItemController@update']);
    Route::delete('/{user}/items/{item}', ['as' => 'user.items.destroy', 'uses' => 'ItemController@destroy']);
});
















/*Route::get('/vueTest', function () {
    return view('vueTest');
});

Route::get('/vueJson', function () {

    $arr = [
        [
            'id' => 1,
            'name' => 'Test'
        ],
        [
            'id' => 2,
            'name' => 'Test 2'
        ],
        [
            'id' => 3,
            'name' => 'Test 3'
        ]
    ];

    return response()->json($arr);
});

Route::post('/vueJson', function (\Illuminate\Http\Request $request) {

    $arr = [
            'id' => 999,
            'name' => $request->input('name')
        ];

    return response()->json($arr);
});*/