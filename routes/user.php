<?php 


Route::group(['middleware' => ['auth', 'user']], function () {

    Route::get('/user-portal', 'UserController@userPortal')->name('user.portal');
	
});

 ?>
