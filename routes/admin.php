<?php 

Route::get('login', function () {
	return view('portal.login');
})->name('adminlogin');

Route::post('/login_get', 'AdminController@loginGet')->name('admin.login');

Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/business_profiles', 'BusinessController@BusinessProfiles')->name('admin.business');

	Route::post('/add_business','BusinessController@addBusiness')->name('admin.add_business');

	Route::get('/products', 'BusinessController@Products')->name('admin.products');

	Route::get('/manage_products', function () {   
		return view('portal.manage_products');
	})->name('admin.manage_product');

	Route::post('/ajax_product_details', 'BusinessController@ajaxProductDetails');

	  Route::post('/product','BusinessController@addProduct')->name('admin.add_product');

	  Route::get('/services', 'BusinessController@Services')->name('admin.services');

	  Route::post('/add_services','BusinessController@addServices')->name('admin.add_services');

	Route::get('/logout', 'AdminController@logout');
});

 ?>