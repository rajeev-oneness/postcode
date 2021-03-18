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
    return view('user.index');
})->name('user.welcome');

Route::get('/signup', 'UserController@Signup')->name('adminsignup');

Route::post('/add_userbusiness','UserController@addUserBusiness')->name('admin.add_userbusiness');

Route::get('/thankyou', function () {
    return view('user.thankyou');
})->name('user.thankyou');

/****************************************************Course Search*************************************/
// Route::get('/business_search/{id}', 'UserController@BusinessSearch');
Route::post('/search_main', 'UserController@search_main');

//---------------------------------------------------------------Admin Login-----------------------------------------------//

Route::get('/admin_login', 'AdminController@Login')->name('adminlogin');


Route::post('/login_get', 'AdminController@loginGet')->name('admin.login');


//---------------------------------------------------------------Admin Dashboard-----------------------------------------------//

Route::get('/admin','AdminController@dashboardView')->name('admin.dashboard')->middleware(['auth', 'admin']);


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