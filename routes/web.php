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
    Route::put('/my_profile/{user}', 'UserController@update');
    Route::get('/my_profile/{user}', 'UserController@my_profile');
    Route::get('/my_profile/{user}/profile_edit', 'UserController@profile_edit');
    Route::get('/profile/{user}', 'UserController@profile');
    Route::post('/profile/{user}', 'MatchingController@matching_request');
    Route::delete('/profile/{user}', 'MatchingController@matching_delete');
    Route::get('/matching_list', 'MatchingController@matching_list');
    Route::delete('/matching_list', 'MatchingController@matching_delete');
    Route::post('/matching_list', 'MatchingController@matching_request');
    Route::get('/chat/{user}', 'ChatController@index');
    Route::post('/chat/{user}', 'ChatController@chat_post_method');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');