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


Route::get('/user/index', 'UserController@index')->middleware('auth');
Route::get('create', 'UserController@create')->name('user.create');
Route::post('/store', 'UserController@store')->name('store');
Route::get('/status/{id}', 'UserController@status')->name('user.status');
Route::get('/delete/{id}', 'UserController@destroy')->name('user.delete');
Route::post('/update/', 'UserController@update')->name('user.update');
Route::prefix('/user')->group(function () {
    Route::get('/', ['uses' => 'UserController@show', 'as' => 'users.show']);
});


//Route::get('/', 'UserController@index')->name('default');
