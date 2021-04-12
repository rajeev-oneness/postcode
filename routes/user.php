<?php 


Route::group(['middleware' => ['auth', 'user']], function () {

    Route::get('/newsfeed', 'UserportalController@newsfeed')->name('user.newsfeed');
    Route::get('/rating', 'UserportalController@rating')->name('user.rating');
    Route::get('/deal', 'UserportalController@deal')->name('user.deal');
	
});

 ?>
