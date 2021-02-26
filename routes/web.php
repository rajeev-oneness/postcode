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

Route::group(['middleware' => 'auth'],function(){
	Route::group(['prefix'=>'admin','middleware' => 'admin'],function(){
		require 'admin.php';
	});

	Route::group(['prefix'=>'user','middleware' => 'user'],function(){
		Route::get('dashboard',function(){
			return 'You are on User Dahboard';
		});
	});
});
