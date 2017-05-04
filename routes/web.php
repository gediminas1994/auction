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
/*Route::pattern('item', '[0-9]+');
Route::pattern('user', '[0-9]+');*/

Route::get('/', ['as' => 'welcome', 'uses' => 'WelcomeController@index']);

Auth::routes();

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'rating'], function (){
    Route::post('/submit/{user}', ['as' => 'rating.submit', 'uses' => 'RatingController@submitRating']);
});

Route::get('/{type}', ['as' => 'items.showItemsByType', 'uses' => 'ItemController@showItemsByType']);

Route::group(['prefix' => 'search'], function () {
    Route::get('/search', ['as' => 'search.keyword', 'uses' => 'SearchController@keyword']);
    Route::get('/{category}', ['as' => 'search.category', 'uses' => 'SearchController@category']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'], function (){
    Route::group(['prefix' => 'users'], function () {
        //user CRUD as admin
        Route::get('/', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);
        Route::get('/{user}', ['as' => 'admin.users.show', 'uses' => 'UsersController@show']);
        Route::get('/{user}/edit', ['as' => 'admin.users.edit', 'uses' => 'UsersController@edit']);
        Route::patch('/{user}', ['as' => 'admin.users.update', 'uses' => 'UsersController@update']);
        Route::delete('/{user}', ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);
        //block and unblock users as admin
        Route::post('/{user}', ['as' => 'admin.users.block_unblock', 'uses' => 'UsersController@block_unblock']);
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('/', ['as' => 'admin.items.index', 'uses' => 'ItemController@index']);
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
});

Route::group(['prefix' => 'items'], function () {
    Route::get('/items', ['as' => 'items.index', 'uses' => 'ItemController@index']);
    Route::get('/create', ['as' => 'items.create', 'uses' => 'ItemController@create']);
    Route::post('/items', ['as' => 'items.store', 'uses' => 'ItemController@store']);
    //show favorites
    Route::get('/favorites', ['as' => 'items.showFavorites', 'uses' => 'ItemController@showFavorites']);

    Route::get('/{item}', ['as' => 'items.show', 'uses' => 'ItemController@show']);
    Route::get('/{item}/edit', ['as' => 'items.edit', 'uses' => 'ItemController@edit']);
    Route::patch('/{item}', ['as' => 'items.update', 'uses' => 'ItemController@update']);
    Route::delete('/{item}', ['as' => 'items.destroy', 'uses' => 'ItemController@destroy']);

    //users listed items
    Route::get('/user/{user}', ['as' => 'user.listedItems', 'uses' => 'ItemController@listedItems']);

    //add favorite items
    Route::post('/favorites/{item}', ['as' => 'items.addToFavorites', 'uses' => 'ItemController@addToFavorites']);
});

Route::post('/bids/submitBid', ['as' => 'bids.submit', 'uses' => 'BidController@submit']);



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