<?php 


Route::group(['middleware' => ['auth', 'user']], function () {

    Route::post('/user_ratings','UserController@userRatings')->name('user.user_ratings');

    // Route::get('/index', function () {
    //     return view('user.index');
    // })->name('user.index');

    // Route::get('/logout', 'AdminController@logout')->name('admin.logout');
   
	
});

 ?>
