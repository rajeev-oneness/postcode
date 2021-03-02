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

	Route::post('/ajax_product_details', 'BusinessController@ajaxProductDetails')->name('admin.product_details');


	Route::post('/edit_product', 'BusinessController@editProduct')->name('edit_product');;

	  Route::post('/product','BusinessController@addProduct')->name('admin.add_product');

	  Route::post('/update_product', 'BusinessController@updateProduct')->name('admin.update_product');

	  Route::post('/delete_products_details', 'BusinessController@deleteProductsDetails')->name('admin.delete_product');

	  Route::get('/services', 'BusinessController@Services')->name('admin.services');

	  Route::post('/add_services','BusinessController@addServices')->name('admin.add_services');

	Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});

 ?>