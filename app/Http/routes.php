<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');

Route::get('/', 'FrontController@index');
Route::get('article/{id}', 'FrontController@show'); //show($id)
Route::get('user/{id}', 'FrontController@showUser');
Route::get('user', 'FrontController@user');
Route::get('category/{id}', 'FrontController@showCategory');


Route::group(['middleware' => ['web']], function () {
    Route::any('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('post', 'PostController');
        Route::get('changeStatus/{id}', 'PostController@changeStatus');
    });
});
