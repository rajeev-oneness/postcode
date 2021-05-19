<?php 

//---------------------------------Business Profile Section-------------------------------//

Route::group(['middleware' => ['auth', 'admin', 'moderatorPermissions']], function () {
	
	//----------------------------------Moderator---------------------//
	Route::group(['prefix' => 'moderator'],function(){
		Route::get('manage','Moderator\ModeratorController@manage')->name('admin.moderator.manage');
		Route::get('create','Moderator\ModeratorController@create')->name('admin.moderator.create');
		Route::post('store','Moderator\ModeratorController@store')->name('admin.moderator.store');
		Route::get('/{id}/edit','Moderator\ModeratorController@edit')->name('admin.moderator.edit');
		Route::post('update','Moderator\ModeratorController@update')->name('admin.moderator.update');
		Route::get('delete/{id}','Moderator\ModeratorController@delete')->name('admin.moderator.delete');
		Route::get('permissions/{userId}','Moderator\ModeratorController@managePermissions')->name('admin.moderator.manage.permission');
		Route::post('grant-permissions','Moderator\ModeratorController@grantManagePermissions')->name('admin.moderator.grant.permission');
	});
	
	//----------------------------------Business Category Section---------------------//
	Route::group(['prefix' => 'business_categories'],function () {
		Route::get('/create', 'BusinesscategoryController@businessCategories')->name('admin.business_categories.create');
		Route::post('/store','BusinesscategoryController@addBusinessCategories')->name('admin.add_business_categories');
		Route::get('/manage', 'BusinesscategoryController@businessCategoryDetails')->name('admin.manage_businesscategories');
		Route::get('/edit/{id}', 'BusinesscategoryController@editBusinessCategories')->name('edit_businesscategories');
		Route::post('/update', 'BusinesscategoryController@updateBusinessCategories')->name('admin.update_businesscategories');
		Route::get('/delete/{id}', 'BusinesscategoryController@deleteBusinessCategories')->name('admin.delete_businesscategories');
	});
	
	
	//---------------------------- Manage Business Profile Section--------------------//
	Route::group(['prefix' => 'business'],function () {
		Route::get('/business_profiles/create', 'BusinessController@BusinessProfiles')->name('admin.business');
		Route::post('/businessprofile/store','BusinessController@addBusinessProfile')->name('admin.add_businessprofile');
		Route::get('/businessprofiles/manage', 'BusinessController@businessProfileDetails')->name('admin.manage_businessprofiles');
		Route::get('/businessprofiles/delete/{id}', 'BusinessController@deleteBusinessProfiles')->name('admin.delete_businessprofiles');
		Route::get('/businessprofile/edit/{id}', 'BusinessController@editBusinessProfiles')->name('admin.edit_businessprofile');
		Route::post('/businessprofiles/update', 'BusinessController@updateBusinessProfiles')->name('admin.update_businessprofiles');
		//business csv upload
		Route::view('/craete/business-csv', 'portal.businessprofile.csv-business-upload')->name('admin.business.upload');
		Route::post('/store/business-csv', 'Upload\UploadController@businessUpload')->name('admin.business.store.csv');
	});

	
	//------------------------------customer section----------------------------------//
	Route::group(['prefix' => 'customer'],function () {
		Route::get('/manage', 'CustomerController@index')->name('admin.customers');
		Route::get('/customers/create', 'CustomerController@add')->name('admin.customers.add');
		Route::post('/customers/store', 'CustomerController@store')->name('admin.customers.store');
		Route::get('/customers/edit/{id}', 'CustomerController@edit')->name('admin.customers.edit');
		Route::post('/customers/update', 'CustomerController@update')->name('admin.customers.update');
		Route::get('/customers/delete/{id}', 'CustomerController@delete')->name('admin.customers.delete');
	});

	//------------------------------------faq section--------------------------------//
	Route::group(['prefix' => 'faq'],function () {
		Route::get('/manage', 'FaqController@manage')->name('admin.faq');
		Route::get('/faqs/create', 'FaqController@add')->name('admin.faq.add');
		Route::post('/faqs/store', 'FaqController@store')->name('admin.faq.store');
		Route::get('/faqs/edit/{id}', 'FaqController@edit')->name('admin.faq.edit');
		Route::post('/faqs/update', 'FaqController@update')->name('admin.faq.update');
		Route::get('/faqs/delete/{id}', 'FaqController@delete')->name('admin.faq.delete');
	});

	//------------------------------Product Category Section------------------------------//
	Route::group(['prefix' => 'product_categories'],function () {
		Route::get('/manage', 'ProductCategoryController@manageCategory')->name('product.category');
		Route::get('/product-category/cretae', 'ProductCategoryController@createCategory')->name('product.category.add');
		Route::post('/product-category/store', 'ProductCategoryController@storeCategory')->name('product.category.store');
		Route::get('/product-category/edit/{id}', 'ProductCategoryController@editCategory')->name('product.category.edit');
		Route::post('/product-category/update', 'ProductCategoryController@updateCategory')->name('product.category.update');
		Route::get('/product-category/delete/{id}', 'ProductCategoryController@deleteCategory')->name('product.category.delete');
	});

	//----------------------------Product Sub-Category Section-----------------------------//
	Route::group(['prefix' => 'product_subcategories'],function () {
		Route::get('/manage', 'ProductSubcategoryController@manageSubcategory')->name('product.subcategory');
		Route::get('/product-subcategory/create', 'ProductSubcategoryController@createSubcategory')->name('product.subcategory.add');
		Route::post('/product-subcategory/store', 'ProductSubcategoryController@storeSubcategory')->name('product.subcategory.store');
		Route::get('/product-subcategory/edit/{id}', 'ProductSubcategoryController@editSubcategory')->name('product.subcategory.edit');
		Route::post('/product-subcategory/update', 'ProductSubcategoryController@updateSubcategory')->name('product.subcategory.update');
		Route::get('/product-subcategory/delete/{id}', 'ProductSubcategoryController@deleteSubcategory')->name('product.subcategory.delete');
	});

	//------------------------------------Product Section--------------------------------------//
	Route::group(['prefix' => 'product'],function () {
		Route::get('/create', 'ProductController@Products')->name('admin.product');
		Route::post('/store', 'ProductController@addProducts')->name('admin.add_products');
		Route::get('/manage','ProductController@manageProducts')->name('admin.manage_products');
		Route::get('/edit/{id}', 'ProductController@editProduct')->name('edit_products');
		Route::post('/update', 'ProductController@updateProduct')->name('admin.update_products');
		Route::get('/delete/{id}', 'ProductController@deleteProductsDetails')->name('admin.delete_product');	
	});

	//---------------------------------------ServicesSection----------------------------------//
	Route::group(['prefix' => 'services'],function () {
		Route::get('/create', 'ServiceController@Services')->name('admin.services');
		Route::post('/store','ServiceController@addServices')->name('admin.add_services');
		Route::get('/manage','ServiceController@manageServiceView')->name('admin.manage_service');
		Route::get('/edit/{id}', 'ServiceController@editServices')->name('admin.edit_services');
		Route::post('/update', 'ServiceController@updateServices')->name('admin.update_services');
		Route::get('/delete/{id}', 'ServiceController@deleteServices')->name('admin.delete_services');
	});

	//-------------------------------------community-----------------------------------------//
	Route::group(['prefix' => 'community'],function(){
		Route::get('manage','CommunityController@manageCommunity')->name('admin.community.manage');
		Route::get('create','CommunityController@createCommunity')->name('admin.community.create');
		Route::post('store','CommunityController@storeCommunity')->name('admin.community.store');
		Route::get('/{id}/edit','CommunityController@editCommunity')->name('admin.community.edit');
		Route::post('/{id}/update','CommunityController@updateCommunity')->name('admin.community.update');
		Route::get('delete/{id}','CommunityController@deleteCommunity')->name('admin.community.delete');
		//community csv upload
		Route::view('/create/community-csv', 'portal.community.csv-community-upload')->name('admin.community.upload');
		Route::post('/store/community-csv', 'Upload\UploadController@communityUpload')->name('admin.community.store.csv');
	});

	//-----------------------------Event Category Section----------------------------------//
	Route::group(['prefix' => 'event_categories'],function(){
		Route::get('/create', 'EventcategoryController@eventsCategories')->name('admin.events_categories');
		Route::post('/store','EventcategoryController@addEventCategories')->name('admin.event_categories');
		Route::get('/manage','EventcategoryController@manageEventCategories')->name('admin.manage_eventcategories');
		Route::get('/edit/{id}', 'EventcategoryController@editEventCategories')->name('admin.edit_eventcategories');
		Route::post('/update', 'EventcategoryController@updateEventCategories')->name('admin.update_eventcategories');
		Route::get('/delete/{id}', 'EventcategoryController@deleteEventCategories')->name('admin.delete_eventcategories');
		// Route::post('/event_category_details', 'EventcategoryController@eventCategoryDetails')->name('admin.event_category_details');
	});
	
	//-----------------------------------Event Section--------------------------------------//
	Route::group(['prefix' => 'event'],function(){
		Route::get('/create', 'EventsController@Events')->name('admin.events');
		Route::post('/add','EventsController@addEvents')->name('admin.add_events');
		Route::get('/manage','EventsController@manageEventsView')->name('admin.manage_events');
		Route::get('/edit/{id}', 'EventsController@editEvent')->name('admin.edit_event');
		Route::post('/update', 'EventsController@updateEvent')->name('admin.update_event');
		Route::post('/delete', 'EventsController@deleteEvents')->name('admin.delete_events');
	});
	
	//---------------------------------Offers Section-------------------------------//
	Route::group(['prefix' => 'offer'],function(){
		Route::get('/create', 'OfferController@OfferView')->name('admin.offers');
		Route::post('/store','OfferController@addOffers')->name('admin.add_offers');
		Route::post('/ckeditor_upload/store', 'CKEditorController@ckeditor_upload')->name('ckeditor.upload');
		Route::get('/manage','OfferController@manageOffers')->name('admin.manage_offers');
		Route::get('/edit/{id}', 'OfferController@editOffer')->name('admin.edit_offer');
		Route::post('/update', 'OfferController@updateOffers')->name('admin.update_offers');
		Route::post('/delete', 'OfferController@deleteOffers')->name('admin.delete_offers');
	});

	//---------------------------Add State Section--------------------------------//
	Route::get('/states', 'StateController@statesView')->name('admin.states');

	Route::post('/add_states','StateController@addStates')->name('admin.add_states');

	Route::get('/manage_state','StateController@manageStateView')->name('admin.manage_state');

	Route::get('/edit_states/{id}', 'StateController@editStates')->name('edit_states');

	Route::post('/update_states', 'StateController@updateStates')->name('admin.update_states');

	Route::post('/delete_states', 'StateController@deleteStates')->name('delete_states');

	//----------------------------Add PostCode Section--------------------------//
	// Route::get('/postcode', 'PostalController@postcodeView')->name('admin.postcode');

	// Route::post('/add_states','PostalController@addStates')->name('admin.add_states');

	//------------------Manage PostCode Section-----------------//

	// Route::get('/manage_postcode','PostalController@managePostcodeView')->name('admin.manage_postcode');

	//----------------------Admin Logout Section---------------------------//
	Route::get('change_password', 'AdminController@changePassword')->name('admin.change_password');	

	Route::post('update_password', 'AdminController@updatePassword')->name('admin.update_password');

	//------------------------------------Address Section-----------------------------//
	Route::get('manage-address', 'ContactController@manageAddress')->name('admin.manage.address');	

	Route::post('update-address', 'ContactController@updateAddress')->name('admin.update.address');

	//--------------------------------About us Section-----------------------------//
	Route::get('manage-about-us', 'AboutUsController@manageAbout')->name('admin.manage.about-us');	

	Route::post('update-about-us', 'AboutUsController@updateAbout')->name('admin.update.about-us');

	//-------------------------------------newsletter section-------------------------------//
	// Route::get('/nesletter-list', 'NewsletterController@manage')->name('admin.newsletter');
	// Route::get('/newsletter-delete', 'NewsletterController@delete')->name('admin.newsletter.delete');
});
