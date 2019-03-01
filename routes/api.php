<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function(){
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');

	Route::group(['middleware' => 'auth.api.users'], function(){
		Route::get('details', 'AuthController@details');
		Route::post('logout', 'AuthController@logout');
		Route::resource('products', 'ProductController');
		Route::post('products/make-fake-items', 'ProductController@makeFakeItems');
	});
});


