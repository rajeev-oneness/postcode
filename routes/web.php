<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.index');
})->name('user.welcome');

Route::get('/signup', 'UserController@Signup')->name('adminsignup');

Route::get('/signup-google-my-business', 'UserController@Signup')->name('GMBsignup');

Route::post('/add_userbusiness','UserController@addUserBusiness')->name('admin.add_userbusiness');

Route::get('/thankyou', function () {
    return view('user.thankyou');
})->name('user.thankyou');

Route::post('/subscribe-newsletter','NewsletterController@subscribeNewsletter')->name('newsletter');

/****************************************************Course Search*************************************/
// Route::get('/business_search/{id}', 'UserController@BusinessSearch');
Route::post('/search_main', 'UserController@search_main');

//---------------------------------------------------------------Admin Login-----------------------------------------------//

Route::get('/main-login', 'AdminController@Login')->name('adminlogin');


Route::post('/login_get', 'AdminController@loginGet')->name('admin.login');

Route::get('/logout', 'AdminController@logout')->name('admin.logout');
//---------------------------------------------------------------Admin Dashboard-----------------------------------------------//

Route::get('/admin','AdminController@dashboardView')->name('admin.dashboard')->middleware(['auth', 'admin']);


Route::prefix('admin')->group(function () {
    require 'admin.php';
});
Auth::routes();



//--------------------------------------------------------------User View-----------------------------------------------//


Route::get('/home', function () {
    return view('user.index');
})->name('user.dashboard')->middleware(['auth', 'user']);

Route::prefix('user')->group(function () {
    require 'user.php';
});

//---------------------------------------------------------------Business Admin Dashboard-----------------------------------------------//

Route::get('/business-admin','BusinessController@dashboardView')->name('business.dashboard')->middleware(['auth', 'business']);


Route::prefix('business-admin')->group(function () {
    require 'business.php';
});

//--------------------------------------------------------------User Contact-----------------------------------------------//

Route::post('/user_contacts','UserController@userContacts')->name('user.user_contacts');

//--------------------------------------------------------------User Testimonial-----------------------------------------------//

Route::post('/user_estimonialss','UserController@userTestimonialss')->name('user.user_estimonialss');



Route::group(['prefix'=> 'business' ,'middleware' => ['auth']], function () {

    Route::get('/add','BusinessController@index')->name('business.add');
	Route::post('/store','BusinessController@addBusinessProfile')->name('business.store');

	//------------------------------------------------------------- Manage Business Profile Section-----------------------------------------------//


	Route::get('/manage', 'BusinessController@manage')->name('business.manage');

	// Route::post('/business_profile_details', 'BusinessController@businessProfileDetails')->name('admin.business_profile_details');

	Route::post('/delete', 'BusinessController@delete')->name('business.delete');

	Route::get('/edit/{id}', 'BusinessController@edit')->name('business.edit');

	Route::post('/update', 'BusinessController@updateBusinessProfiles')->name('business.update');

});

//------------------front-----------------//
//---------------homepage and directory--------------//

Route::get('/homepage', 'FrontController@homepage')->name('default.homepage');

Route::get('/directory', 'FrontController@directory')->name('directory');
Route::post('/get-business-by-State', 'FrontController@getBusinessByState')->name('getBusinessByState');

//menu bar(events)
Route::get('/events', 'FrontController@event')->name('events');
Route::get('/deals', 'FrontController@deal')->name('deals');
Route::get('/marketplace', 'FrontController@marketplace')->name('marketplace');
Route::post('/getmarketplace', 'FrontController@getmarketplace')->name('getmarketplace');

Route::post('/get-events-deals', 'FrontController@eventDealAjax')->name('event.deal.ajax');

//details
Route::get('/details', 'FrontController@details')->name('details');

Route::group(['middleware' => ['auth','user']], function(){
    Route::get('/rating-add/{id}', 'RatingController@index')->name('rating.add');
    Route::post('/rating-store', 'RatingController@store')->name('rating.store');
});

//contact us
Route::get('/contact-us', 'ContactController@index')->name('contact-us');
Route::post('/send-contact-us', 'ContactController@store')->name('send.contact-us');

//about us
Route::get('/about-us', 'AboutUsController@index')->name('about-us');

//faq
Route::get('/faq', 'FaqController@index')->name('faq');

//product purchaase
Route::group(['middleware' => ['auth']], function () {
    Route::get('/buy-now/product/{productId}', 'FrontController@buyNow')->name('book_now.product');
    Route::get('item/product/payment/{productId}','FrontController@successfullPayment')->name('item.product.payment');
});
// Stripe Payment Route
Route::post('stripe/payment/form_submit','StripePaymentController@stripePostForm_Submit')->name('stripe.payment.form_submit');
Route::get('payment/successfull/thankyou/{stripeTransactionId}','StripePaymentController@thankyouStripePayment')->name('payment.successfull.thankyou');


// SOCIALITE SIGN-IN
Route::get('/sign-in/{socialite}','AdminController@socialiteLogin')->name('socialite.login');
Route::get('/sign-in/{socialite}/redirect','AdminController@socialiteLoginRedirect')->name('socialite.login.redirect');

Route::post('/fetch-product-subcategory', 'ProductController@fetchSubcategory')->name('fetch-product-subcategory');


Route::get('view-community','CommunityController@showCommunity')->name('community.show');
Route::get('view-community-category/{id}','CommunityController@showCatgoryWiseCommunity')->name('community.category.show');
Route::get('post-details/{id}','CommunityController@showDetailCommunity')->name('community.post.detail');
Route::get('community-groups','CommunityGroupController@showAllGroups')->name('community.all.groups');
Route::get('community-group-details/{id}','CommunityGroupController@showDetailCommunityGroup')->name('community.group.detail');


Route::group(['middleware' => 'auth'], function () {
        Route::get('my-posts','CommunityController@showMyPosts')->name('community.my.post');
        Route::get('add-posts','CommunityController@createCommunity')->name('community.add.post');
        Route::post('store-post','CommunityController@storeCommunity')->name('community.store.post');
        Route::get('/{id}/edit-post','CommunityController@editCommunity')->name('community.edit.post');
        Route::post('/{id}/update-post','CommunityController@updateCommunity')->name('community.update.post');
        Route::get('delete-post/{id}','CommunityController@deleteCommunity')->name('community.delete.post');
        Route::post('/add-comment','CommunityController@addComment')->name('community.add.comment');
        Route::get('/delete-comment/{id}','CommunityController@deleteComment')->name('community.delete.comment');
        Route::get('/edit-comment/{commentId}/{communityId}','CommunityController@editComment')->name('community.edit.comment');
        Route::post('/update-comment','CommunityController@updateComment')->name('community.update.comment');
        Route::post('/add-like','CommunityController@addLike')->name('community.add.like');
        Route::post('/remove-like','CommunityController@removeLike')->name('community.remove.like');

        Route::get('/download-csv/{format}', 'Upload\UploadController@downloadCSV')->name('download.csv');
        Route::get('/download-event-category', 'Upload\UploadController@downloadEventCategoryCSV')->name('download.event.category.csv');
        Route::get('/download-business-category', 'Upload\UploadController@downloadBusinessCategoryCSV')->name('download.business.category.csv');
        Route::get('/download-community-category', 'Upload\UploadController@downloadCommunityCategoryCSV')->name('download.community.category.csv');
        //community group routes
        Route::get('my-groups','CommunityGroupController@showMyGroups')->name('community.my.groups');
        Route::get('add-groups','CommunityGroupController@createCommunityGroups')->name('community.add.groups');
        Route::post('store-groups','CommunityGroupController@storeCommunityGroups')->name('community.store.group');
        Route::get('/{id}/edit-groups','CommunityGroupController@editCommunityGroups')->name('community.edit.group');
        Route::post('/{id}/update-groups','CommunityGroupController@updateCommunityGroups')->name('community.update.group');
        Route::get('delete-groups/{id}','CommunityGroupController@deleteCommunityGroups')->name('community.delete.group');
        Route::post('/add-discussion','CommunityGroupController@addDiscussion')->name('community.add.discussion');
        Route::get('/delete-discussion/{id}','CommunityGroupController@deleteDiscussion')->name('community.delete.discussion');
        Route::get('/edit-discussion/{discussionId}/{groupId}','CommunityGroupController@editDiscussion')->name('community.edit.discussion');
        Route::post('/update-discussion','CommunityGroupController@updateDiscussion')->name('community.update.discussion');
});


