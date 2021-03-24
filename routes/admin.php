<?php 



//--------------------------------------------------------------Business Profile Section-----------------------------------------------//


Route::group(['middleware' => ['auth', 'admin']], function () {

	Route::get('/business_profiles', 'BusinessController@BusinessProfiles')->name('admin.business');

	Route::post('/add_businessprofile','BusinessController@addBusinessProfile')->name('admin.add_businessprofile');

	//------------------------------------------------------------- Manage Business Profile Section-----------------------------------------------//


	Route::get('/manage_businessprofiles', function () {   
		return view('portal.businessprofile.manage_businessprofiles');
	})->name('admin.manage_businessprofiles');

	Route::post('/business_profile_details', 'BusinessController@businessProfileDetails')->name('admin.business_profile_details');

	Route::post('/delete_businessprofiles', 'BusinessController@deleteBusinessProfiles')->name('admin.delete_businessprofiles');

	Route::post('/edit_businessprofile', 'BusinessController@editBusinessProfiles')->name('edit_businessprofile');

	Route::post('/update_businessprofiles', 'BusinessController@updateBusinessProfiles')->name('admin.update_businessprofiles');

//--------------------------------------------------------------Product Section-----------------------------------------------//


	Route::get('/product', 'ProductController@Products')->name('admin.product');

	Route::post('/add_products', 'ProductController@addProducts')->name('admin.add_products');

	//-------------------------------------------------------------Manage Product Section-----------------------------------------------//

	Route::get('/manage_products','ProductController@manageProducts')->name('admin.manage_products');

	Route::get('/edit_product/{id}', 'ProductController@editProduct')->name('edit_product');

	  Route::post('/product','ProductController@addProduct')->name('admin.add_product');

	  Route::post('/update_products', 'ProductController@updateProduct')->name('admin.update_products');

	  Route::get('/delete_products_details/{id}', 'ProductController@deleteProductsDetails')->name('admin.delete_product');

	  //--------------------------------------------------------------Services Section-----------------------------------------------//

	  Route::get('/services', 'ServiceController@Services')->name('admin.services');

	  Route::post('/add_services','ServiceController@addServices')->name('admin.add_services');

	  	  //------------------------------------------------------------- maange Services Section-----------------------------------------------//


	  Route::get('/manage_service','ServiceController@manageServiceView')->name('admin.manage_service');

	  Route::get('/edit_services/{id}', 'ServiceController@editServices')->name('edit_services');

	  Route::post('/update_services', 'ServiceController@updateServices')->name('admin.update_services');

	  Route::post('/delete_services', 'ServiceController@deleteServices')->name('delete_services');

//--------------------------------------------------------------Event Category Section-----------------------------------------------//


	  Route::get('/events_categories', 'EventcategoryController@eventsCategories')->name('events_categories');

	  Route::post('/add_eventcategories','EventcategoryController@addEventCategories')->name('admin.event_categories');

	  //--------------------------------------------------------------Manage Event Category Section-----------------------------------------------//

	  Route::get('/manage_eventcategories','EventcategoryController@manageEventCategories')->name('admin.manage_eventcategories');


	Route::get('/edit_eventcategories/{id}', 'EventcategoryController@editEventCategories')->name('edit_eventcategories');

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

	Route::get('/events', 'EventsController@Events')->name('admin.events');

	Route::post('/add_events','EventsController@addEvents')->name('admin.add_events');

	//--------------------------------------------------------------Manage Event Section-----------------------------------------------//

	Route::get('/manage_events','EventsController@manageEventsView')->name('admin.manage_events');

	Route::get('/edit_event/{id}', 'EventsController@editEvent')->name('edit_event');

	Route::post('/update_event', 'EventsController@updateEvent')->name('admin.update_event');

	Route::post('/delete_events', 'EventsController@deleteEvents')->name('delete_events');

//--------------------------------------------------------------Offers Section-----------------------------------------------//

	Route::get('/offers', 'OfferController@OfferView')->name('admin.offers');

	Route::post('/add_offers','OfferController@addOffers')->name('admin.add_offers');

	Route::post('/ckeditor_upload', 'CKEditorController@ckeditor_upload')->name('ckeditor.upload');


//--------------------------------------------------------------Manage Offers Section-----------------------------------------------//

	Route::get('/manage_offers','OfferController@manageOffers')->name('admin.manage_offers');

	Route::get('/edit_offer/{id}', 'OfferController@editOffer')->name('edit_offer');

	Route::post('/update_offers', 'OfferController@updateOffers')->name('admin.update_offers');

	Route::post('/delete_offers', 'OfferController@deleteOffers')->name('delete_offers');

//--------------------------------------------------------------Add State Section-----------------------------------------------//
Route::get('/states', 'StateController@statesView')->name('admin.states');

Route::post('/add_states','StateController@addStates')->name('admin.add_states');

//--------------------------------------------------------------Manage State Section-----------------------------------------------//

Route::get('/manage_state','StateController@manageStateView')->name('admin.manage_state');

Route::get('/edit_states/{id}', 'StateController@editStates')->name('edit_states');

Route::post('/update_states', 'StateController@updateStates')->name('admin.update_states');

Route::post('/delete_states', 'StateController@deleteStates')->name('delete_states');

// //--------------------------------------------------------------Add PostCode Section-----------------------------------------------//
// Route::get('/postcode', 'PostalController@postcodeView')->name('admin.postcode');

// Route::post('/add_states','PostalController@addStates')->name('admin.add_states');

// //--------------------------------------------------------------Manage PostCode Section-----------------------------------------------//

// Route::get('/manage_postcode','PostalController@managePostcodeView')->name('admin.manage_postcode');


//--------------------------------------------------------------Admin Logout Section-----------------------------------------------//
Route::get('change_password', 'AdminController@changePassword')->name('admin.change_password');	

Route::post('update_password', 'AdminController@updatePassword')->name('admin.update_password');



});
