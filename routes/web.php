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

Route::get('/home', 'HomeController@index')->name('home');
/*Route::get('/', 'UserController@index');
Route::get('/user', 'UserController@index');
Route::get('user/{id}', 'UserController@index')->name('user');
Route::get('create', 'UserController@create')->name('user.create');
Route::post('/store', 'UserController@store')->name('store');
Route::get('/status/{id}', 'UserController@status')->name('user.status');
Route::get('/delete/{id}', 'UserController@destroy')->name('user.delete');
Route::post('/update/', 'UserController@update')->name('user.update');
Route::prefix('/user')->group(function () {
    Route::get('/', ['uses' => 'UserController@show', 'as' => 'users.show']);
});*/

Route::get('user/{id}', 'UserController@index')->name('user');
Route::get('user/index', 'UserController@index')->middleware('auth');
Route::get('user/create', 'UserController@create')->name('user.create');
Route::post('user/store', 'UserController@store')->name('store');
Route::get('user/status/{id}', 'UserController@status')->name('user.status');
Route::get('user/delete/{id}', 'UserController@destroy')->name('user.delete');
Route::post('user/update/', 'UserController@update')->name('user.update');
Route::prefix('/user')->group(function () {
    Route::get('/', ['uses' => 'UserController@show', 'as' => 'users.show']);
});
Route::get('/user/index', 'UserController@index')->name('default');

//Route::get('/', 'UserController@index')->name('default');

Route::prefix('country')->group(function () {
    Route::get('/', 'Country\CountryController@index')->name('country');
    Route::get('table', 'Country\CountryController@table')->name('country.table');
    Route::get('create', 'Country\CountryController@create')->name('country.create');
    Route::post('store', 'Country\CountryController@store')->name('country.store');
    Route::get('status/{id}', 'Country\CountryController@status')->name('country.status');
    Route::get('edit/{id}', 'Country\CountryController@edit')->name('country.edit');
    Route::post('update', 'Country\CountryController@update')->name('country.update');
    Route::get('delete/{id}', 'Country\CountryController@destroy')->name('country.delete');
    Route::post('search', 'Country\CountryController@search')->name('country.search');
});

Route::prefix('state')->middleware('auth')->group(function () {
    Route::get('/', 'State\StateController@index')->name('state');
    Route::get('table', 'State\StateController@table')->name('state.table');
    Route::get('create', 'State\StateController@create')->name('state.create');
    Route::post('store', 'State\StateController@store')->name('state.store');
    Route::get('status/{id}', 'State\StateController@status')->name('state.status');
    Route::get('edit/{id}', 'State\StateController@edit')->name('state.edit');
    Route::post('update', 'State\StateController@update')->name('state.update');
    Route::get('delete/{id}', 'State\StateController@destroy')->name('state.delete');
    Route::post('search', 'State\StateController@search')->name('state.search');
});

Route::prefix('city')->middleware('auth')->group(function () {
    Route::get('/', 'City\CityController@index')->name('city');
    Route::get('table', 'City\CityController@table')->name('city.table');
    Route::get('create', 'City\CityController@create')->name('city.create');
    Route::post('store', 'City\CityController@store')->name('city.store');
    Route::get('status/{id}', 'City\CityController@status')->name('city.status');
    Route::get('edit/{id}', 'City\CityController@edit')->name('city.edit');
    Route::post('update', 'City\CityController@update')->name('city.update');
    Route::get('delete/{id}', 'City\CityController@destroy')->name('city.delete');
});
