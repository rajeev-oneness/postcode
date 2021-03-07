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


Route::get('/welcome', function () {
    return view('welcome');
})->name('user.welcome');

//---------------------------------------------------------------Admin Login-----------------------------------------------//

Route::get('/', 'AdminController@Login')->name('adminlogin');


Route::post('/login_get', 'AdminController@loginGet')->name('admin.login');

//---------------------------------------------------------------Admin Dashboard-----------------------------------------------//


Route::get('/admin', function () {
    return view('portal.dashboard');
})->name('admin.dashboard')->middleware(['auth', 'admin']);

Route::prefix('admin')->group(function () {
    require 'admin.php';
});
Auth::routes();

//--------------------------------------------------------------User View-----------------------------------------------//


Route::get('/home', function () {
    return view('user.index');
})->name('user.dashboard')->middleware(['auth', 'user']);;

Route::prefix('user')->group(function () {
    require 'user.php';
});

//--------------------------------------------------------------User Contact-----------------------------------------------//

Route::post('/user_contacts','UserController@userContacts')->name('user.user_contacts');

//--------------------------------------------------------------User Testimonial-----------------------------------------------//

Route::post('/user_estimonialss','UserController@userTestimonialss')->name('user.user_estimonialss');