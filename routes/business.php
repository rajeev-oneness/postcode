<?php

Route::group(['middleware' => ['auth', 'business']], function () {
    //--------------------------------------------------------------Product Section-----------------------------------------------//


	Route::get('/product', 'ProductController@Products')->name('business-admin.product');
	Route::post('/add_products', 'ProductController@addProducts')->name('business-admin.add_products');

	//-------------------------------------------------------------Manage Product Section-----------------------------------------------//

	Route::get('/manage_products','ProductController@manageProducts')->name('business-admin.manage_products');
	Route::get('/edit_product/{id}', 'ProductController@editProduct')->name('edit_product');
	Route::post('/product','ProductController@addProduct')->name('business-admin.add_product');
	Route::post('/update_products', 'ProductController@updateProduct')->name('business-admin.update_products');
	Route::get('/delete_products_details/{id}', 'ProductController@deleteProductsDetails')->name('business-admin.delete_product');

    //--------------------------------------------------------------Services Section-----------------------------------------------//

	Route::get('/services', 'ServiceController@Services')->name('business-admin.services');
	Route::post('/add_services','ServiceController@addServices')->name('business-admin.add_services');

    //------------------------------------------------------------- maange Services Section-----------------------------------------------//

    Route::get('/manage_service','ServiceController@manageServiceView')->name('business-admin.manage_service');
	Route::get('/edit_services/{id}', 'ServiceController@editServices')->name('edit_services');
	Route::post('/update_services', 'ServiceController@updateServices')->name('business-admin.update_services');
	Route::post('/delete_services', 'ServiceController@deleteServices')->name('delete_services');

    //--------------------------------------------------------------Event Category Section-----------------------------------------------//

	Route::get('/events_categories', 'EventcategoryController@eventsCategories')->name('business.admin.events_categories');
	Route::post('/add_eventcategories','EventcategoryController@addEventCategories')->name('business-admin.event_categories');

	//--------------------------------------------------------------Manage Event Category Section-----------------------------------------------//

	Route::get('/manage_eventcategories','EventcategoryController@manageEventCategories')->name('business-admin.manage_eventcategories');
	Route::get('/edit_eventcategories/{id}', 'EventcategoryController@editEventCategories')->name('edit_eventcategories');
	Route::post('/update_eventcategories', 'EventcategoryController@updateEventCategories')->name('business-admin.update_eventcategories');
	Route::post('/delete_eventcategories', 'EventcategoryController@deleteEventCategories')->name('business-admin.delete_eventcategories');
	// Route::post('/event_category_details', 'EventcategoryController@eventCategoryDetails')->name('business-admin.event_category_details');


    //--------------------------------------------------------------Event Section-----------------------------------------------//

	Route::get('/events', 'EventsController@Events')->name('business-admin.events');
	Route::post('/add_events','EventsController@addEvents')->name('business-admin.add_events');

	//--------------------------------------------------------------Manage Event Section-----------------------------------------------//

	Route::get('/manage_events','EventsController@manageEventsView')->name('business-admin.manage_events');
	Route::get('/edit_event/{id}', 'EventsController@editEvent')->name('edit_event');
	Route::post('/update_event', 'EventsController@updateEvent')->name('business-admin.update_event');
	Route::post('/delete_events', 'EventsController@deleteEvents')->name('delete_events');


    //--------------------------------------------------------------Offers Section-----------------------------------------------//

	Route::get('/offers', 'OfferController@OfferView')->name('business-admin.offers');
	Route::post('/add_offers','OfferController@addOffers')->name('business-admin.add_offers');
	Route::post('/ckeditor_upload', 'CKEditorController@ckeditor_upload')->name('ckeditor.upload');


    //--------------------------------------------------------------Manage Offers Section-----------------------------------------------//

	Route::get('/manage_offers','OfferController@manageOffers')->name('business-admin.manage_offers');
	Route::get('/edit_offer/{id}', 'OfferController@editOffer')->name('edit_offer');
	Route::post('/update_offers', 'OfferController@updateOffers')->name('business-admin.update_offers');
	Route::post('/delete_offers', 'OfferController@deleteOffers')->name('delete_offers');

});