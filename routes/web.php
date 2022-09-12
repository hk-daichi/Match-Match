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
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'UserController@index');
    Route::get('/my_profile/{user}', 'UserController@my_profile');
    Route::get('/my_profile/{user}/profile_edit', 'UserController@profile_edit');
    Route::put('/my_profile/{user}', 'UserController@update');
    Route::get('/profile/{user}', 'UserController@profile');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');