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


Route::prefix('api')->group(function () {
    Route::get('oauth-link', 'AccountController@getFacebookApiUrl');
    Route::get('attemp', 'AccountController@attemp');
});

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@dashboard');

    Route::get('/post', 'AdminController@post');
    Route::get('/post/{id}', 'AdminController@delPost');

    Route::get('/share', 'AdminController@share');
    Route::get('/share/{id}', 'AdminController@delShare');
    //
    Route::post('/post', 'AdminController@savePost');
    Route::post('/share', 'AdminController@saveShare');
});