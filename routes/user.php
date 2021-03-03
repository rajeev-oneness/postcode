<?php 


Route::group(['middleware' => ['auth', 'user']], function () {

	
    // Route::get('/index', function () {
    //     return view('user.index');
    // })->name('user.index');
    Route::get('/logout', 'AdminController@logout')->name('user.logout');
	
});

 ?>
