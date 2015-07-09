<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for MYCOLLEGEADDA.COM
|
*/

// ROUTE FOR HOME STARTS HERE ------------------------------------------------------------------------------------------------

Route::get('/', array('uses' => 'HomeController@showWelcome', 'as' => 'home'));

// ROUTE FOR HOME ENDS HERE ------------------------------------------------------------------------------------------------


// ROUTE FOR GENERAL SITE INFO STARTS HERE ---------------------------------------------------------------------------------------------


Route::get('/sitemap', function()
{
	$file = public_path(). "/sitemap.xml";  // <- Replace with the path to your .xml file
	// check if the file exists
	if (file_exists($file)) {
    	// read the file into a string
    	$content = file_get_contents($file);
    	// create a Laravel Response using the content string, an http response code of 200(OK),
    	//  and an array of html headers including the pdf content type
    	return Response::make($content, 200, array('content-type'=>'application/xml'));
	}
});

Route::get('about-us',function(){
	return View::make('info.about_us');
});

Route::get('faq',function(){
	return View::make('info.faq');
});

Route::get('privacypolicy',function(){
	return View::make('info.privacyPolicy');
});

Route::get('listingpolicy',function(){
	return View::make('info.listingPolicy');
});

Route::get('termsofservice',function(){
	return View::make('info.termsOfService');
});

Route::get('careers',function(){
	return View::make('info.careers');
});

Route::get('team',function(){
	return View::make('info.team');
});

// ROUTE FOR GENERAL SITE INFO ENDS HERE -------------------------------------------------------------------------------------------


// ROUTES FOR DISCOUNT COUPON STARTS HERE ------------------------------------------------------------------------------------

Route::group(array('before' => 'auth'),function(){

	Route::get('/discount-coupon',array('uses' => 'UtilityController@getDiscountCoupon', 'as' => 'getDiscountCoupon'));

	Route::group(array('before' => 'csrf'),function(){

		Route::post('/discount-coupon',array('uses' => 'UtilityController@postFeedback', 'as' => 'postFeedback'));
	});
});
// ROUTES FOR DISCOUNT COUPON ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR FEEDBACK FORM STARTS HERE ------------------------------------------------------------------------------------

Route::get('/feedback',array('uses' => 'UtilityController@getFeedback', 'as' => 'getFeedback'));

Route::group(array('before' => 'csrf'),function(){

	Route::post('/feedback',array('uses' => 'UtilityController@postFeedback', 'as' => 'postFeedback'));
});

// ROUTES FOR FEEDBACK FORM ENDS HERE ------------------------------------------------------------------------------------

// ROUTES FOR ALERT FORM STARTS HERE ------------------------------------------------------------------------------------

Route::group(array('before' => 'csrf'),function(){

	Route::post('/create-alert',array('uses' => 'UtilityController@postAlert', 'as' => 'postAlert'));
});

// ROUTES FOR ALERT FORM ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR ACCOUNT AUTHENTICATION SYSTEM STARTS HERE ------------------------------------------------------------------------------------

Route::group(array('before' => 'auth'),function(){

	Route::get('/account/logout', array('as' => 'account-logout','uses' => 'AccountController@getLogout'));
	Route::get('/account/change-password', array('as' => 'account-change-password','uses' => 'AccountController@getChangePassword'));

	/**  VIEW AND MANAGE PROFILE **/
	Route::get('/account/profile',array('uses' => 'AccountController@viewProfile', 'as' => 'viewProfile'));
	Route::get('/account/manage-profile',array('uses' => 'AccountController@getManageProfile', 'as' => 'getManageProfile'));

	Route::group(array('before' => 'csrf'),function(){

		Route::post('/account/manage-profile',array('uses' => 'AccountController@postManageProfile', 'as' => 'postManageProfile'));
		Route::post('/account/change-password', array('as' => 'account-change-password-post','uses' => 'AccountController@postChangePassword'));
	});

});

Route::group(array('before' => 'guest'),function(){

	Route::group(array('before' => 'csrf'),function(){

		$url = Request::path();
		Route::post('/account/login', array('as' => 'account-login-post','uses' => 'AccountController@postLogin'));
		Route::post('/account/create', array('as' => 'account-create-post','uses' => 'AccountController@postCreate'));
		Route::post('/account/forgot-password', array('as' => 'account-forgot-password-post','uses' => 'AccountController@postForgotPassword'));

	});

	Route::get('/account/login', array('as' => 'account-login','uses' => 'AccountController@getLogin'));
	Route::get('/account/login/facebook', array('as' => 'account-login-facebook','uses' => 'AccountController@getLoginWithFacebook'));
	Route::get('/account/login/google', array('as' => 'account-login-google','uses' => 'AccountController@getLoginWithGoogle'));
	Route::get('/account/create', array('as' => 'account-create','uses' => 'AccountController@getCreate'));
	Route::get('/account/activate/{code}', array('as' => 'account-activate','uses' => 'AccountController@getActivate'));
	Route::get('/account/forgot-password', array('as' => 'account-forgot-password','uses' => 'AccountController@getForgotPassword'));
	Route::get('/account/recover/{code}', array('as' => 'account-recover','uses' => 'AccountController@getRecover'));

});

// ROUTES FOR ACCOUNT AUTHENTICATION SYSTEM ENDS HERE ------------------------------------------------------------------------------------


// ROUTE FOR USER PROFILE STARTS HERE ------------------------------------------------------------------------------------------------

Route::get('/user/{username}', array('as' => 'profile-user','uses' => 'ProfileController@user'));

// ROUTE FOR USER PROFILE ENDS HERE ------------------------------------------------------------------------------------------------


// ROUTES FOR SEND MESSAGE STARTS HERE ------------------------------------------------------------------------------------

Route::group(array('before' => 'auth'), function()
{
	
	Route::get('/sendMessage',array('uses' => 'UtilityController@getSendMessage', 'as' => 'getSendMessage'));
	
	Route::group(array('before' => 'csrf'), function(){

		Route::post('/sendMessage',array('uses' => 'UtilityController@postSendMessage', 'as' => 'postSendMessage'));	
		});

});

// ROUTES FOR SEND MESSAGE ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR WISHLIST STARTS HERE -------------------------------------------------------------------------------------

Route::get('/wishlist/{id}', array('as' => 'postWishlist','uses' => 'UtilityController@postWishlist'));
Route::get('/wishlist', array('as' => 'getWishlist','uses' => 'UtilityController@getWishlist'));

// ROUTES FOR WISHLIST ENDS HERE -------------------------------------------------------------------------------------


// ROUTES TO GET COLLEGE LIST STARTS HERE --------------------------------------------------------------------------------------------

Route::post('/api/college', array('uses' => 'ApiController@getCollegeList', 'as' => 'getCollegeList'));
Route::get('/api/college', array('uses' => 'ApiController@getCollegeList', 'as' => 'getCollegeList'));


// ROUTES TO GET COLLEGE LIST ENDS HERE --------------------------------------------------------------------------------------------

// ROUTES FOR DONATE STARTS HERE ------------------------------------------------------------------------------------
Route::group(array('before' => 'auth'), function()
{
	Route::get('/donate-books',array('uses' => 'UtilityController@getDonateBooks', 'as' => 'getDonateBooks'));

	Route::group(array('before' => 'csrf'), function(){

		Route::post('/donate-books',array('uses' => 'UtilityController@postDonateBooks', 'as' => 'postDonateBooks'));
		});
});

// ROUTES TO DONATE ENDS HERE --------------------------------------------------------------------------------------------


/** !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! **/

// ROUTES FOR SELL STARTS HERE ------------------------------------------------------------------------------------

Route::get('/sell',array('uses' => 'UtilityController@getSell', 'as' => 'getSell'));
Route::group(array('before' => 'auth'), function()
{
	Route::get('/sell/books',array('uses' => 'BooksController@getSellBooks', 'as' => 'getSellBooks'));
	Route::get('/sell/notes',array('uses' => 'NotesController@getSellNotes', 'as' => 'getSellNotes'));
	Route::get('/sell/flatmates',array('uses' => 'FlatmatesController@getSellFlatmates', 'as' => 'getSellFlatmates'));
	Route::get('/sell/electronics',array('uses' => 'ElectronicsController@getSellElectronics', 'as' => 'getSellElectronics'));
	Route::get('/sell/car-pool',array('uses' => 'CarPoolController@getSellCarPool', 'as' => 'getSellCarPool'));
	
	Route::group(array('before' => 'csrf'), function(){

		Route::post('/sell',array('uses' => 'BooksController@postSell', 'as' => 'postSell'));
		Route::post('/sell/electronics',array('uses' => 'ElectronicsController@postSellElectronics', 'as' => 'postSellElectronics'));
		Route::post('/sell/notes',array('uses' => 'NotesController@postSellNotes', 'as' => 'postSellNotes'));
		Route::post('/sell/flatmates',array('uses' => 'FlatmatesController@postSellFlatmates', 'as' => 'postSellFlatmates'));
		Route::post('/sell/carpool',array('uses' => 'CarPoolController@postSellCarPool', 'as' => 'postSellCarPool'));	
		});

});

// ROUTES FOR SELL ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR BOOKS BROWSE AND SEARCH STARTS HERE ------------------------------------------------------------------------------------

Route::get('/ajax/booksSearch',array('uses' => 'BooksController@getBooksSearchResultAJAX', 'as' => 'getBooksSearchResultAJAX'));
Route::get('/books',array('uses' => 'BooksController@getBooksSearchQueryResult', 'as' => 'getBooksSearchQueryResult'));
Route::get('/books/{key}/{value}',array('uses' => 'BooksController@getBooksKeywordSearchResult', 'as' => 'getBooksKeywordSearchResult'));
Route::get('/ajax/books',array('uses' => 'BooksController@ajaxPaginateBooks', 'as' => 'ajaxPaginateBooks'));
Route::get('/books/{id}',array('uses' => 'BooksController@getBooksDetails', 'as' => 'getBooksDetails'));

Route::group(array('before' => 'auth'), function()
{
	
	Route::get('/deleteBook/{id}/{user_id}',array('uses' => 'BooksController@getDeleteBook', 'as' => 'getDeleteBook'));

});

// ROUTES FOR BOOKS BROWSE AND SEARCH ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR ELECTRONICS BROWSE AND SEARCH STARTS HERE ------------------------------------------------------------------------------------

Route::get('/ajax/electronicsSearch',array('uses' => 'ElectronicsController@getElectronicsSearchResultAJAX', 'as' => 'getElectronicsSearchResultAJAX'));
Route::get('/electronics',array('uses' => 'ElectronicsController@getElectronicsSearchQueryResult', 'as' => 'getElectronicsSearchQueryResult'));
Route::get('/electronics/{key}/{value}',array('uses' => 'ElectronicsController@getElectronicsKeywordSearchResult', 'as' => 'getElectronicsKeywordSearchResult'));
Route::get('/ajax/electronics',array('uses' => 'ElectronicsController@ajaxPaginateElectronics', 'as' => 'ajaxPaginateElectronics'));
Route::get('/electronics/{id}',array('uses' => 'ElectronicsController@getElectronicsDetails', 'as' => 'getElectronicsDetails'));

Route::group(array('before' => 'auth'), function()
{
	
	Route::get('/deleteBook/{id}/{user_id}',array('uses' => 'ElectronicsController@getDeleteBook', 'as' => 'getDeleteBook'));

});

// ROUTES FOR ELECTRONICS BROWSE AND SEARCH ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR CARPOOL BROWSE AND SEARCH STARTS HERE ------------------------------------------------------------------------------------

Route::get('/ajax/carpoolSearch',array('uses' => 'CarPoolController@getCarPoolSearchResultAJAX', 'as' => 'getCarPoolSearchResultAJAX'));
Route::get('/carpool',array('uses' => 'CarPoolController@getCarPoolSearchQueryResult', 'as' => 'getCarPoolSearchQueryResult'));
Route::get('/carpool/{key}/{value}',array('uses' => 'CarPoolController@getCarPoolKeywordSearchResult', 'as' => 'getCarPoolKeywordSearchResult'));
Route::get('/ajax/carpool',array('uses' => 'CarPoolController@ajaxPaginateCarPool', 'as' => 'ajaxPaginateCarPool'));
Route::get('/carpool/{id}',array('uses' => 'CarPoolController@getCarPoolDetails', 'as' => 'getCarPoolDetails'));

Route::group(array('before' => 'auth'), function()
{
	
	Route::get('/deleteBook/{id}/{user_id}',array('uses' => 'CarPoolController@getDeleteBook', 'as' => 'getDeleteBook'));
});

// ROUTES FOR CARPOOL BROWSE AND SEARCH ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR FLATMATE BROWSE AND SEARCH STARTS HERE ------------------------------------------------------------------------------------

Route::get('/ajax/flatmatesSearch',array('uses' => 'FlatmatesController@getFlatmatesSearchResultAJAX', 'as' => 'getFlatmatesSearchResultAJAX'));
Route::get('/flatmates',array('uses' => 'FlatmatesController@getFlatmatesSearchQueryResult', 'as' => 'getFlatmatesSearchQueryResult'));
Route::get('/flatmates/{key}/{value}',array('uses' => 'FlatmatesController@getFlatmatesKeywordSearchResult', 'as' => 'getFlatmatesKeywordSearchResult'));
Route::get('/ajax/flatmates',array('uses' => 'FlatmatesController@ajaxPaginateFlatmates', 'as' => 'ajaxPaginateFlatmates'));
Route::get('/flatmates/{id}',array('uses' => 'FlatmatesController@getFlatmatesDetails', 'as' => 'getFlatmatesDetails'));

Route::group(array('before' => 'auth'), function()
{
	
	Route::get('/deleteBook/{id}/{user_id}',array('uses' => 'FlatmatesController@getDeleteBook', 'as' => 'getDeleteBook'));
});

// ROUTES FOR FLATMATE BROWSE AND SEARCH ENDS HERE ------------------------------------------------------------------------------------


// ROUTES FOR NOTES BROWSE AND SEARCH STARTS HERE ------------------------------------------------------------------------------------

Route::get('/ajax/notesSearch',array('uses' => 'NotesController@getNotesSearchResultAJAX', 'as' => 'getNotesSearchResultAJAX'));
Route::get('/notes',array('uses' => 'NotesController@getNotesSearchQueryResult', 'as' => 'getNotesSearchQueryResult'));
Route::get('/notes/{key}/{value}',array('uses' => 'NotesController@getNotesKeywordSearchResult', 'as' => 'getNotesKeywordSearchResult'));
Route::get('/ajax/notes',array('uses' => 'NotesController@ajaxPaginateNotes', 'as' => 'ajaxPaginateNotes'));
Route::get('/notes/{id}',array('uses' => 'NotesController@getNotesDetails', 'as' => 'getNotesDetails'));

Route::group(array('before' => 'auth'), function()
{
	
	Route::get('/deleteBook/{id}/{user_id}',array('uses' => 'NotesController@getDeleteBook', 'as' => 'getDeleteBook'));
});

// ROUTES FOR NOTES BROWSE AND SEARCH ENDS HERE ------------------------------------------------------------------------------------


Route::get('/college', array('uses' => 'UtilityController@getCollege', 'as' => 'getCollege'));