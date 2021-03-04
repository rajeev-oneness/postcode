<?php 





Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/business_profiles', 'BusinessController@BusinessProfiles')->name('admin.business');

	Route::post('/add_business','BusinessController@addBusiness')->name('admin.add_business');

	Route::get('/products', 'BusinessController@Products')->name('admin.products');

	Route::get('/manage_products', function () {   
		return view('portal.manage_products');
	})->name('admin.manage_product');

	Route::post('/ajax_product_details', 'BusinessController@ajaxProductDetails')->name('admin.product_details');


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


	
	  Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});

 ?>
