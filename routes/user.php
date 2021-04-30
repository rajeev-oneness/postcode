<?php 

Route::group(['middleware' => ['auth', 'user']], function () {
    
    //--------------------------------------------------------------Product Section-----------------------------------------------//


	Route::get('/product', 'ProductController@Products')->name('user.marketplace.product');
	Route::post('/add_products', 'ProductController@addProducts')->name('user.marketplace.add_products');

	//-------------------------------------------------------------Manage Product Section-----------------------------------------------//

	Route::get('/manage_products','ProductController@manageProducts')->name('user.marketplace.manage_products');
	Route::get('/user_edit_product/{id}', 'ProductController@editProduct')->name('user.marketplace.edit_product');
	Route::post('/product','ProductController@addProduct')->name('user.marketplace.add_product');
	Route::post('/update_products', 'ProductController@updateProduct')->name('user.marketplace.update_products');
	Route::get('/delete_products_details/{id}', 'ProductController@deleteProductsDetails')->name('user.marketplace.delete_product');

    // event booking
    Route::get('/book-event/{id}', 'BookingController@index')->name('user.event.book');
    Route::post('/complete-booking', 'BookingController@bookingComplete')->name('complete.booking');

    // user portal routes
    Route::get('/newsfeed', 'UserportalController@newsfeed')->name('user.newsfeed');
    
    //rating section
    Route::get('/rating', 'UserportalController@rating')->name('user.rating');
    Route::get('/edit-rating/{id}','UserportalController@editRating')->name('user.rating.edit');
    Route::post('/update-rating','UserportalController@updateRating')->name('user.rating.update');
    //end rating section

    Route::get('/deal', 'UserportalController@deal')->name('user.deal');
    Route::get('/settings', 'UserportalController@settings')->name('user.settings');
    Route::post('/update-privacy', 'UserportalController@updatePrivacy')->name('update.privacy');
    Route::get('/edit-user', 'UserportalController@editProfile')->name('user.edit');
    Route::post('/update-profile', 'UserportalController@updateProfile')->name('user.update');
    Route::get('/my-calender', 'UserportalController@myCalender')->name('user.calender');
    Route::post('/get-businesses', 'UserportalController@getBusiness')->name('get.businesses');    
    Route::post('/send-message', 'UserportalController@sendMessage')->name('user.send.message');    
    Route::get('/message-portal', 'UserportalController@messagePortal')->name('user.message.portal');

    // Buy Product
    // Route::get('/Buy-now/{id}', 'ProductController@index')->name('user.product.buy-now');
    // Route::post('/complete-booking', 'BookingController@bookingComplete')->name('complete.booking');
    
});

 ?>
