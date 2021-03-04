<?php 





Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/business_profiles', 'BusinessController@BusinessProfiles')->name('admin.business');

	Route::post('/add_business','BusinessController@addBusiness')->name('admin.add_business');

	Route::get('/manage_businessprofiles', function () {   
		return view('portal.manage_businessprofiles');
	})->name('admin.manage_businessprofiles');

	Route::post('/business_category_details', 'BusinessController@businessCategoryDetails')->name('admin.business_category_details');

	Route::post('/edit_businessprofile', 'BusinessController@editBusinessProfiles')->name('edit_businessprofile');

	Route::post('/update_businessprofiles', 'BusinessController@updateBusinessProfiles')->name('admin.update_businessprofiles');



	Route::get('/products', 'BusinessController@Products')->name('admin.products');

	Route::get('/manage_products', function () {   
		return view('portal.manage_products');
	})->name('admin.manage_product');

	Route::post('/business_profile_details', 'BusinessController@businessProfileDetails')->name('admin.business_profile_details');

	Route::post('/delete_businessprofiles', 'BusinessController@deleteBusinessProfiles')->name('admin.delete_businessprofiles');

	Route::post('/product_details', 'BusinessController@ajaxProductDetails')->name('admin.product_details');

	Route::post('/edit_product', 'BusinessController@editProduct')->name('edit_product');

	  Route::post('/product','BusinessController@addProduct')->name('admin.add_product');

	  Route::post('/update_product', 'BusinessController@updateProduct')->name('admin.update_product');

	  Route::post('/delete_products_details', 'BusinessController@deleteProductsDetails')->name('admin.delete_product');

	  Route::get('/services', 'BusinessController@Services')->name('admin.services');

	  Route::post('/add_services','BusinessController@addServices')->name('admin.add_services');

	  Route::get('/events_categories', 'BusinessController@eventsCategories')->name('events_categories');

	  Route::post('/add_eventcategories','BusinessController@addEventCategories')->name('admin.event_categories');

	  Route::get('/manage_eventcategories', function () {   
		return view('portal.manage_eventcategories');
	})->name('admin.manage_eventcategories');

	Route::post('/edit_eventcategories', 'BusinessController@editEventCategories')->name('edit_eventcategories');

	Route::post('/update_eventcategories', 'BusinessController@updateEventCategories')->name('admin.update_eventcategories');

	Route::post('/delete_eventcategories', 'BusinessController@deleteEventCategories')->name('admin.delete_eventcategories');

	Route::post('/event_category_details', 'BusinessController@eventCategoryDetails')->name('admin.event_category_details');

	Route::get('/business_categories', 'BusinessController@businessCategories')->name('admin.business_categories');

	Route::post('/add_business_categories','BusinessController@addBusinessCategories')->name('admin.add_business_categories');

	Route::get('/manage_businesscategories', function () {   
		return view('portal.manage_businesscategories');
	})->name('admin.manage_businesscategories');

	Route::post('/business_category_details', 'BusinessController@businessCategoryDetails')->name('admin.business_category_details');

	Route::post('/edit_businesscategories', 'BusinessController@editBusinessCategories')->name('edit_businesscategories');

	Route::post('/update_businesscategories', 'BusinessController@updateBusinessCategories')->name('admin.update_businesscategories');

	Route::post('/delete_businesscategories', 'BusinessController@deleteBusinessCategories')->name('admin.delete_businesscategories');

	
	  Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});

 ?>
