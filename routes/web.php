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
		return redirect('/earner');
	});


	Route::prefix('api')->group(function () {
		Route::get('oauth-link', 'AccountController@getFacebookApiUrl');
		Route::post('attemp', 'AccountController@attemp');
		Route::get('check-mission', 'PostController@checkMission')->middleware('check.auth');
		Route::get('get-post', 'PostController@getRandomPost');
		Route::get('get-comment', 'PostController@getRandomComment');
		Route::get('get-comment2', 'PostController@getRandomComment2');
	});

	Route::get('earner', 'AccountController@earner')->middleware('check.auth');
	Route::get('login', 'AccountController@login');
	Route::get('logout', 'AccountController@logout');

	Route::prefix('adm')->middleware('check.auth')->group(function () {
		Route::get('/', 'AdminController@dashboard');

		Route::get('/post', 'AdminController@post');
		Route::get('/post/{id}', 'AdminController@delPost');

		Route::get('/comment', 'AdminController@comment');
		Route::get('/comment/{id}', 'AdminController@delComment');
		//
		Route::post('/post', 'AdminController@savePost');
		Route::post('/comment', 'AdminController@saveComment');

        Route::get('/comment-fr', 'AdminController@commentFr');
        Route::get('/comment-fr/{id}', 'AdminController@delCommentFr');
        Route::post('/comment-fr', 'AdminController@saveCommentFr');
	});

	Route::post('log', 'LogController@store')->middleware('check.auth');