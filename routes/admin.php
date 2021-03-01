<?php 

Route::get('login', function () {
	return view('portal.login');
})->name('adminlogin');

Route::post('/login_get', 'AdminController@loginGet')->name('admin.login');

Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/business_profiles', 'BusinessController@BusinessProfiles');

	Route::post('/add_business','BusinessController@addBusiness');

	Route::get('/products', 'BusinessController@Products');

	  Route::post('/product','BusinessController@addProduct');

	  Route::get('/services', 'BusinessController@Services');

	  Route::post('/add_services','BusinessController@addServices');

	Route::get('/logout', 'AdminController@logout');
});

 ?>