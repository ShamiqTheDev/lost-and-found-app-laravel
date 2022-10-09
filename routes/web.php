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

// Route::get('check_login/{login_code}',["as" => "check_login","uses" => "CheckLoginController@check_login"] );




Route::get('/clear-cache', function() {

	Artisan::call('config:cache');
    //Artisan::call('route:cache');
	Artisan::call('view:clear');
	Artisan::call('cache:clear');
	return "Cache is cleared";
});


//Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('howitworks', function () {
	return view('lostandfound.howitworks');})->name('howitworks');

Route::get('contact-us', function () {
	return view('lostandfound.contact');})->name('contact-us');

Route::get('about-us', function () {
	return view('lostandfound.about');})->name('about-us');

Route::get('privacy-policy', function () {
	return view('lostandfound.privacy');})->name('privacy-policy');

Route::get('terms-and-conditions', function () {
	return view('lostandfound.terms');})->name('terms-and-conditions');

Route::get('faqs', function () {
	return view('lostandfound.faqs');})->name('faqs');

Route::post('send-feedback', 'HomeController@send_feedback')->name('send-feedback');
Route::get('listings', 'HomeController@get_posts')->name('listings');

Route::get('post/{id}/{title?}', 'HomeController@get_single_post')->name('single_post');

Route::get('get-countries',"HomeController@get_countries")->name('get-countries');
Route::get('get-states',"HomeController@get_states")->name('get-states');
Route::get('get-admin-states/{country_id}',"AdminController@get_states")->name('get-admin-states');
Route::get('get-cities',"HomeController@get_cities")->name('get-cities');

Route::get('set-country-code',"HomeController@set_country_code")->name('set-country-code');

Route::get('get-categories',"HomeController@get_categories")->name('get-categories');
Route::get('get-subcategories',"HomeController@get_subcategories")->name('get-subcategories');


Route::get('get-filters-fields/{cat_id}/{sub_cat_id?}',"HomeController@get_filters_fields")->name('get_filters_fields');
Route::get('get-brands',"HomeController@get_brands")->name('get-brands');





//Social Login Routes//
Route::get('/auth/redirect/{provider}', 'UserController@redirectfb');
Route::get('/callback/facebook', 'UserController@callbackfb');



Route::get('google', function () {
	return view('googleAuth');
});

Route::get('auth/google', 'UserController@redirectToGoogle');
Route::get('auth/google/callback', 'UserController@handleGoogleCallback');



Route::get('/auth/redirect/{provider}', 'UserController@redirecttw');
Route::get('/callback/twitter', 'UserController@callbacktw');
//Social Login Routes//

Route::get('verify-email/{verification_token}',"UserController@verify_email")->name('verify_email');

Route::group(['middleware' => ['userAuthenticated']], function () {

	Route::get('forgot-password', function () {
	return view('lostandfound.resetpassword');})->name('forgot-password');

	Route::get('logout-user',"UserController@logout")->name('logout-user');
	Route::post('register', 'UserController@register')->name('register');
	
	Route::post('login-user',["uses"=>"UserController@login_submit", 'as'=>'login-user']);

	Route::post('reset-password', 'UserController@reset_password')->name('reset_password');
	Route::get('verify-forget-email/{reset_password_token}',"UserController@verify_forget_email")->name('verify_forget_email');

	Route::post('change-password', 'UserController@change_password')->name('change_password');

});


Route::get('get-fields/{cat_id}/{sub_cat_id?}/',"UserController@get_fields")->name('get_fields');



Route::group(['middleware' => ['authenticateUser']], function () {


	Route::get('user_dashboard',"UserController@user_dashboard")->name('user_dashboard');
	Route::get('logout-user',"UserController@logout")->name('logout-user');
	Route::get('user-dashboard/{ads_type?}',"UserController@user_dashboard")->name('user_dashboard');
	Route::get('edit-user-profile',["uses"=>"UserController@edit_user_profile", 'as'=>'edit-user-profile']);
	Route::post('update-detail',"UserController@update_user_detail")->name('update-detail');
	Route::post('update-user-password',"UserController@update_user_password")->name('update-user-password');
	Route::post('update-notification',"UserController@update_notification")->name('update-notification');
	
	Route::get('post-form',"UserController@post_form")->name('post-form');


	Route::post('submit-post',"UserController@submit_post")->name('submit-post');
	Route::post('update-submit-post',"UserController@update_submit_post")->name('update-submit-post');

	Route::get('change-post-status/{id}/{status}',"UserController@change_post_status")->name('change_post_status');
	Route::get('edit-post-detail/{id}',"UserController@edit_post_detail")->name('edit_post_detail');
	Route::get('delete-post-detail/{id}/{status}',"UserController@delete_post_detail")->name('delete_post_detail');

	Route::get('get-dashboard-posts/{status}',"UserController@get_dashboard_posts")->name('get-dashboard-posts');

	Route::get('get-brand-models',"UserController@get_brand_models")->name('get-brand-models');

	Route::get('like-unlike-posts/{post_id}/{type}',"UserController@like_unlike_posts")->name('like-unlike-posts');

	Route::get('remember-list',"UserController@remember_list")->name('remember_list');

	Route::post('send-message',"MessageController@send_message")->name('send_message');
	Route::get('messages',"MessageController@message")->name('messages');
	Route::get('get-user-msgs/{user_id}/{post_id}',"MessageController@get_user_msgs")->name('get-user-msgs');

	Route::post('send-message',"MessageController@send_message")->name('send_message');

	Route::get('resend-verification/{id}',"UserController@resend_verification")->name('resend-verification');
	
});








Route::group(['middleware' => ['adminAuthenticated']], function () {

	Route::get('admin', 'AdminController@login')->name('admin');
	Route::post('login-submit',"AdminController@login_submit")->name('login_submit');

});


Route::group(['middleware' => ['authenticateAdmin']], function () {

	Route::get('generate-sitemap', 'SiteMapController@generate_sitemap')->name('generate-sitemap');

	Route::get('logout',"AdminController@logout")->name('logout');
	Route::get('dashboard',"AdminController@dashboard")->name('dashboard');
	Route::get('create-user',"AdminController@create_user")->name('create_user');
	Route::post('create-user-submit',"AdminController@create_user_submit")->name('create_user_submit');
	Route::get('get-users',"AdminController@get_users")->name('get_users');

	Route::get('view-user-detail/{id}',"AdminController@view_user_detail")->name('view_user_detail');
	Route::get('delete-user-detail/{id}',"AdminController@delete_user_detail")->name('delete_user_detail');
	Route::get('edit-user-detail/{id}',"AdminController@edit_user_detail")->name('edit_user_detail');
	Route::post('profile-image-upload', 'AdminController@profile_image_upload')->name('profile_image_upload');
	Route::post('update-user-detail/{id}',"AdminController@update_user_detail")->name('update_user_detail');

	Route::get('get-posts/{status}',"AdminController@get_posts")->name('get-posts');

	Route::get('ad-edit-post-detail/{id}',"AdminController@edit_post_detail")->name('ad_edit_post_detail');
	Route::get('ad-view-post-detail/{id}',"AdminController@view_post_detail")->name('ad_view_post_detail');
	Route::get('ad-delete-post-detail/{id}',"AdminController@delete_post_detail")->name('ad_delete_post_detail');
	Route::post('ad-update-submit-post',"AdminController@update_submit_post")->name('ad-update-submit-post');


	Route::get('update-post-status/{id}',"AdminController@update_post_status")->name('update_post_status');
	Route::get('reject-post-status/{id}',"AdminController@reject_post_status")->name('reject_post_status');

	// Route::post('delete-image',"AdminController@delete_image")->name('delete-image');
	Route::post('image-upload', 'AdminController@image_upload')->name('image_upload');

	Route::get('ad-get-brand-models',"AdminController@get_brand_models")->name('ad-get-brand-models');
	Route::get('ad-get-fields/{cat_id}/{sub_cat_id?}/',"UserController@get_fields")->name('ad_get_fields');


	Route::get('user-profile',"AdminController@user_profile")->name('user-profile');
	Route::post('user-profile-submit',"AdminController@user_profile_submit")->name('user-profile-submit');

});