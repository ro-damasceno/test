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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group ([
	'middleware' => 'auth',
	'namespace'  => 'Panel'
], function($route){

	/** @var Route $route */
	$route->get('/', 'HomeController@index')->name('panel-dashboard');
	$route->resource('/products', 'ProductController');
	$route->post('/products/fake-items', 'ProductController@fakeItems');
});
