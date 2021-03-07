<?php 



//--------------------------------------------------------------Business Profile Section-----------------------------------------------//


Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/business_profiles', 'BusinessController@BusinessProfiles')->name('admin.business');

	Route::post('/add_business','BusinessController@addBusiness')->name('admin.add_business');

	//------------------------------------------------------------- Manage Business Profile Section-----------------------------------------------//


	Route::get('/manage_businessprofiles', function () {   
		return view('portal.businessprofile.manage_businessprofiles');
	})->name('admin.manage_businessprofiles');

	Route::post('/business_profile_details', 'BusinessController@businessProfileDetails')->name('admin.business_profile_details');

	Route::post('/delete_businessprofiles', 'BusinessController@deleteBusinessProfiles')->name('admin.delete_businessprofiles');

	Route::post('/edit_businessprofile', 'BusinessController@editBusinessProfiles')->name('edit_businessprofile');

	Route::post('/update_businessprofiles', 'BusinessController@updateBusinessProfiles')->name('admin.update_businessprofiles');

//--------------------------------------------------------------Product Section-----------------------------------------------//


	Route::get('/products', 'ProductController@Products')->name('admin.products');

	Route::post('/product_details', 'ProductController@ajaxProductDetails')->name('admin.product_details');

	//-------------------------------------------------------------Manage Product Section-----------------------------------------------//

	Route::get('/manage_products', function () {   
		return view('portal.product.manage_products');
	})->name('admin.manage_product');

	Route::post('/edit_product', 'ProductController@editProduct')->name('edit_product');

	  Route::post('/product','ProductController@addProduct')->name('admin.add_product');

	  Route::post('/update_product', 'ProductController@updateProduct')->name('admin.update_product');

	  Route::post('/delete_products_details', 'ProductController@deleteProductsDetails')->name('admin.delete_product');

	  //--------------------------------------------------------------Services Section-----------------------------------------------//

	  Route::get('/services', 'ServiceController@Services')->name('admin.services');

	  Route::post('/add_services','ServiceController@addServices')->name('admin.add_services');

	  	  //------------------------------------------------------------- maange Services Section-----------------------------------------------//


	  Route::get('/manage_service','ServiceController@manageServiceView')->name('admin.manage_service');

	  Route::post('/edit_services', 'ServiceController@editServices')->name('edit_services');

	  Route::post('/update_services', 'ServiceController@updateServices')->name('admin.update_services');

	  Route::post('/delete_services', 'ServiceController@deleteServices')->name('delete_services');

//--------------------------------------------------------------Event Category Section-----------------------------------------------//


	  Route::get('/events_categories', 'EventcategoryController@eventsCategories')->name('events_categories');

	  Route::post('/add_eventcategories','EventcategoryController@addEventCategories')->name('admin.event_categories');

	  //--------------------------------------------------------------Manage Event Category Section-----------------------------------------------//

	  Route::get('/manage_eventcategories', function () {   
		return view('portal.eventcategory.manage_eventcategories');
	})->name('admin.manage_eventcategories');

	Route::post('/edit_eventcategories', 'EventcategoryController@editEventCategories')->name('edit_eventcategories');

	Route::post('/update_eventcategories', 'EventcategoryController@updateEventCategories')->name('admin.update_eventcategories');

	Route::post('/delete_eventcategories', 'EventcategoryController@deleteEventCategories')->name('admin.delete_eventcategories');

	Route::post('/event_category_details', 'EventcategoryController@eventCategoryDetails')->name('admin.event_category_details');

//--------------------------------------------------------------Business Category Section-----------------------------------------------//


	Route::get('/business_categories', 'BusinesscategoryController@businessCategories')->name('admin.business_categories');

	Route::post('/add_business_categories','BusinesscategoryController@addBusinessCategories')->name('admin.add_business_categories');

	//--------------------------------------------------------------Manage Business Category Section-----------------------------------------------//

	Route::get('/manage_businesscategories', function () {   
		return view('portal.businesscategory.manage_businesscategories');
	})->name('admin.manage_businesscategories');

	Route::post('/business_category_details', 'BusinesscategoryController@businessCategoryDetails')->name('admin.business_category_details');

	Route::post('/edit_businesscategories', 'BusinesscategoryController@editBusinessCategories')->name('edit_businesscategories');

	Route::post('/update_businesscategories', 'BusinesscategoryController@updateBusinessCategories')->name('admin.update_businesscategories');

	Route::post('/delete_businesscategories', 'BusinesscategoryController@deleteBusinessCategories')->name('admin.delete_businesscategories');

//--------------------------------------------------------------Event Section-----------------------------------------------//

	Route::get('/events', 'EventsController@Services')->name('admin.events');

	Route::post('/add_events','EventsController@addEvents')->name('admin.add_events');

	//--------------------------------------------------------------Manage Event Section-----------------------------------------------//

	Route::get('/manage_events','EventsController@manageEventsView')->name('admin.manage_events');

	Route::post('/edit_event', 'EventsController@editEvent')->name('edit_event');

	Route::post('/update_event', 'EventsController@updateEvent')->name('admin.update_event');

	Route::post('/delete_events', 'EventsController@deleteEvents')->name('delete_events');

//--------------------------------------------------------------Admin Logout Section-----------------------------------------------//
	
	  Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});
