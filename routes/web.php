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

View::addExtension('html', 'php');

Route::get('/','Site\HomeController@index')->name('home');

Route::get('/admin', function() {
	return Redirect::to("admin/login");
});

Route::get('/login', function() {
	return Redirect::to("admin/login");
});

//*************Start Gift_Dashboard******************//
Route::get('/gift-dashboard', 'Site\GiftDashboardController@index')->middleware('auth');
Route::get('/gifted', 'Site\GiftDashboardController@gifted');
Route::post('/gift-dashboard/delete', 'Site\GiftDashboardController@deleteGift')->name('delete-gift');;
Route::get('/event', 'Site\EventController@create')->name('event');


//*************End Gift_Dashboard******************//


//************* Start Parent Child Info******************//

Route::post('/create-page','Site\AccountController@createPage')->middleware('auth');

//Depricated ======================================================
Route::get('/parent-child-info','Site\ParentChildController@index')->name('info')->middleware('auth');
Route::get('/date-location', function() {return Redirect::to("/parent-child-info");})->name('info');
Route::get('/page-link', function() {return Redirect::to("/parent-child-info");})->name('info');
Route::get('/congrats', function() {return Redirect::to("/parent-child-info");})->name('info');
Route::post('/parent-child-info/store', 'Site\ParentChildController@storeInfo');
//Depricated ======================================================

Route::group(['middleware' => 'guest'], function () {	
	Route::auth();
	Route::post('/user/register', 'Site\UserController@create');
});


Route::get('logout', 'Auth\SiteLoginController@logout');


Route::post('/signup','Site\HomeController@signup');
Route::post('/signin','Site\HomeController@signin');
Route::post('/reset','Site\HomeController@passwordReset');

Route::get('/account', 'Site\AccountController@index')->name('account');
Route::get('/password-reset', 'Site\AccountController@index')->name('account');
Route::post('/account/store-info', 'Site\AccountController@storeAccountInfo');
Route::post('/account/alerts', 'Site\AccountController@storeAlerts');
Route::post('/account/privacy', 'Site\AccountController@storePrivacy');
Route::post('/account/password', 'Site\AccountController@storePassword');
Route::post('/account/host-child', 'Site\AccountController@storeHostChild');
Route::post('/account/location', 'Site\AccountController@storeLocation');
Route::post('/account/gift-link', 'Site\AccountController@storeLink');
Route::get('/account/test', 'Site\AccountController@test');
//************* End Parent Child Info******************//


//**************Start Gift_Page***************//

Route::get('/gift/{child_name}', 'Site\GiftController@index')->name('gift')->middleware('auth');
Route::post('/update-gift-page', 'Site\GiftController@updateGiftPage')->middleware('auth');
Route::post('/background-image', 'Site\GiftController@saveBackgroundImages')->middleware('auth');
Route::post('/profile-image', 'Site\GiftController@saveProfileImage')->middleware('auth');
Route::post('/remove-image', 'Site\GiftController@removeProfileImage')->middleware('auth');
Route::post('/update-child-zipcode', 'Site\GiftController@updateChildZipcode');
Route::post('/giftDetails', 'Site\GiftController@giftDetails');
Route::post('/giftSort', 'Site\GiftController@giftSort');
Route::post('/addPrice','Site\GiftController@addPrice');
Route::post('/editGift','Site\GiftController@editGift');
Route::post('/make-live','Site\GiftController@makeLive');
Route::post('/make-private','Site\GiftController@makePrivate');

//**************end Gift_Page***************//

//**************Start Shop_Page***************//

Route::get('/shop/{slug}', 'Site\ShopController@index')->name('shop');
Route::get('/shop/{slug}/{category}', 'Site\ShopController@indexCategory');
Route::post('/favorite','Site\ShopController@favorite');
Route::post('/favorited','Site\ShopController@favorited');
Route::post('/addGift','Site\ShopController@addGift')->middleware('auth');
Route::post('/removeGift','Site\ShopController@removeGift');
Route::post('/category','Site\ShopController@category');
Route::post('/customDetails','Site\ShopController@getInfo');
Route::post('/addCustomGift','Site\ShopController@addCustomGift');
Route::get('/test', 'Site\ShopController@test');

//**************end Shop_Page***************//

//**************Start Checkout_Page***************//

Route::get('/checkout', 'Site\CheckoutController@index')->name('checkout');
Route::post('/checkout/remove-gift','Site\CheckoutController@remove');
Route::post('/checkout/place-order','Site\CheckoutController@order');
Route::get('/checkout-success','Site\CheckoutController@checkoutsuccess');

//**************end Checkout_Page***************//


//**************Start Redeem_Page***************//

Route::get('/redeem-gifts', 'Site\RedeemController@index')->name('redeem')->middleware('auth');
Route::get('/redeem-success','Site\RedeemController@success');

//**************end Redeem_Page***************//

//**************Start Search_Page***************//

Route::get('/search', 'Site\SearchController@index')->name('search');
Route::get('/search/{lastName}', 'Site\SearchController@index');
Route::post('/search/pages', 'Site\SearchController@search');
Route::get('/search/test', 'Site\SearchController@test');


//**************End Search_Page***************//

//**************Start Report_Page***************//

Route::get('/gift-report/{slug}', 'Site\ReportController@index')->name('report');


//**************End Report_Page***************//

//**************Start LiveGift_Page***************//

//Route::get('/gift-live', 'Site\LiveGiftController@index')->name('livegift');
Route::get('/gift-page/{slug}', 'Site\LiveGiftController@index')->name('livegift');
Route::post('/gift-live/message','Site\LiveGiftController@sendMessage');
Route::post('/gift-live/cart','Site\LiveGiftController@cart');
Route::get('/gift-live/test','Site\LiveGiftController@test');

//**************End LiveGift_Page***************//

//**************Start Social Login***************//

Route::get ( '/auth/{provider}', 'SocialAuthController@redirect' );
Route::get ( '/auth/{provider}/callback', 'SocialAuthController@callback' );

//**************End Social Login***************//

//**************Start Password Reset***************//

Route::get('autologin/{token}', ['as' => 'autologin', 'uses' => '\Watson\Autologin\AutologinController@autologin']);

//**************End Password Reset***************//

//About Us
	Route::get('/about-us', 'Site\UserController@getaboutUs');
	
	//Contact Us
	Route::get('/contact-us', 'Site\UserController@getcontactUs');
	
	//Terms & Condition
	Route::get('/terms-condition', 'Site\UserController@getTermsCondition');
	
	//Privacy Policy
	Route::get('/privacy-policy', 'Site\UserController@getPrivacyPolicy');
	
	//Faq
	Route::get('/faq', 'Site\UserController@getFAQ');
	
	//Need help
	Route::get('/need-help', 'Site\UserController@NeedHelp');
	
	//How fynches workds
	Route::get('/how-fynches-work', 'Site\UserController@getHowFynchesWorks');
	
	Route::group(array('prefix' => 'admin', 'middlewareGroups' => 'auth', 'after' => 'auth'), function() {
	
	Route::auth();
	Route::get('/', function() {
		return Redirect::to("admin/login");
	});
	
	Route::resource('dashboard', 'Admin\DashboardController');

	//Betasignup
	Route::post('/user/getBetaData', 'Admin\UserController@getBetaData');
	Route::get('betaSignup', 'Admin\UserController@getbetaSignupData');
	Route::get('delete_betaUser/{id}', 'Admin\UserController@delete_betaUser'); 
	Route::get('delete_multiple_betaUser/{id}', 'Admin\UserController@multiple_row_delete');
	Route::get('export_csv', 'Admin\UserController@export');

	//User
	Route::post('/user/getData', 'Admin\UserController@getData');
	Route::get('/user/delete/{id}', 'Admin\UserController@destroy');
	Route::get('delete_multiple_User/{id}', 'Admin\UserController@multiple_user_row_delete');
	
	//Admins
	Route::get('/user/admin_index', 'Admin\UserController@admin_index');
	Route::get('/user/admin_create', 'Admin\UserController@admin_create');
	Route::post('/user/create_admin', 'Admin\UserController@create_admin');
	Route::get('/user/list_admins', 'Admin\UserController@list_admins');
	
	
	Route::get('/user/edit_admin/{id}', 'Admin\UserController@edit_admin');
	Route::get('/user/show_admin_info/{id}', 'Admin\UserController@show_admin_info');
	Route::post('/user/update_admin', 'Admin\UserController@update_admin');
	Route::resource('user', 'Admin\UserController');
	
	//Email template
	Route::get('/emailtemplates/getData', 'Admin\EmailTemplatesController@getData');
	Route::resource('emailtemplates', 'Admin\EmailTemplatesController');
	Route::get('/emailtemplates/delete/{id}', 'Admin\EmailTemplatesController@destroy'); 
	Route::get('delete_multiple_EmailTemplates/{id}', 'Admin\EmailTemplatesController@multiple_emailTemplate_row_delete');

	//Change password
	Route::get('/changepassword', 'Admin\ChangepasswordController@index');
	Route::post('/changepassword/update', 'Admin\ChangepasswordController@update');


	Route::get('/changepassword/password/{id}/{type}', 'Admin\ChangepasswordController@password');
	Route::post('/changepassword/update-password', 'Admin\ChangepasswordController@updatePassword');

	//Event
	Route::get('/event/delete_event_img/{id}', 'Admin\EventController@delete_event_img');
	Route::get('/event/validate-publish-url', 'Admin\EventController@validatePublishUrl');
	Route::post('multiple_img_upload', 'Admin\EventController@multiple_img_upload');
	Route::put('multiple_img_upload', 'Admin\EventController@multiple_img_upload');
	
	//Route::post('delete_event_img', 'Admin\EventController@delete_event_img'); 
	Route::post('/event/getData', 'Admin\EventController@getData');
	Route::get('/event/delete/{id}', 'Admin\EventController@destroy'); 
	Route::get('delete_multiple_Event/{id}', 'Admin\EventController@multiple_row_delete');
	
	Route::resource('event', 'Admin\EventController');
	
	
	
	
	//Experience
	Route::get('/experience/getData/{id}', 'Admin\ExperienceController@getData');
	Route::get('/experience/delete/{id}', 'Admin\ExperienceController@destroy'); 
	Route::resource('experience', 'Admin\ExperienceController');
	
	Route::get('/event/experience/{id}', 'Admin\ExperienceController@index');
	Route::get('/experience/create/{id}', 'Admin\ExperienceController@create');
	Route::get('event/experience/delete_multiple_Experience/{id}', 'Admin\ExperienceController@multiple_row_delete');


	//Cms
	Route::get('/cms/getData', 'Admin\CmsController@getData');
	Route::get('/cms/delete/{id}', 'Admin\CmsController@destroy'); 
	Route::get('delete_multiple_Cms/{id}', 'Admin\CmsController@multiple_row_delete');
	Route::resource('cms', 'Admin\CmsController');
	
	//Testimonial
	Route::get('/testimonial/getData', 'Admin\TestimonialController@getData');
	Route::resource('testimonial', 'Admin\TestimonialController');
	Route::get('/testimonial/delete/{id}', 'Admin\TestimonialController@destroy'); 
	Route::get('delete_multiple_Testimonial/{id}', 'Admin\TestimonialController@multiple_row_delete');
	
	// Static Block
	Route::get('/staticblock/getData', 'Admin\StaticBlockController@getData');
	Route::resource('staticblock', 'Admin\StaticBlockController');
	Route::get('/staticblock/delete/{id}', 'Admin\StaticBlockController@destroy'); 
	Route::get('delete_multiple_StatickBlock/{id}', 'Admin\StaticBlockController@multiple_row_delete');
	
	
	//country
	Route::post('/country/getData', 'Admin\CountryController@getData');
	Route::get('/country/delete/{id}', 'Admin\CountryController@destroy'); 
	Route::get('delete_multiple_Country/{id}', 'Admin\CountryController@multiple_row_delete');
	Route::resource('country', 'Admin\CountryController');
	
	//state
	Route::post('/state/getData', 'Admin\StateController@getData');
	Route::get('/state/delete/{id}', 'Admin\StateController@destroy'); 
	Route::get('delete_multiple_State/{id}', 'Admin\StateController@multiple_row_delete');
	Route::resource('state', 'Admin\StateController');
	
	//Global Setting
	
	Route::post('/globalsetting/update', 'Admin\GlobalSettingController@update');
	Route::resource('globalsetting', 'Admin\GlobalSettingController');
	
	//Payment Listing
	Route::get('/payment/getData', 'Admin\PaymentController@getData');
	Route::resource('payment', 'Admin\PaymentController');
		
});
