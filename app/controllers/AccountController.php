<?php

/*
*	Author: Vedansh Agrawal
*	Description: Authentication and Profile Management Controller
*/

class AccountController extends BaseController {

/* -----------------------------------------------------LOGIN STARTS---------------------------------------------------------- */

	public function getLogin(){

		return View::make('account.login');

	}


	public function postLogin(){

		$validate = Validator::make(Input::all(), array(
			'email' => 'required|email',
			'password' => 'required',
		));

		if($validate->fails())
		{
			return Redirect::route('account-login')->withErrors($validate)->withInput();
		}
		else
		{
			$remember = (Input::has('remember')? true: false);

			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			),$remember);

			if($auth){
				return Redirect::intended('/');
			}
			else{
				return Redirect::route('account-login')->with('fail','Email/Password wrong, or account not activated.');
			}
		}

		return Redirect::route('account-login')->with('fail','There was a problem signing you in.');

	}

/* -----------------------------------------------------LOGIN ENDS---------------------------------------------------------- */

/* -----------------------------------------------------LOGOUT STARTS---------------------------------------------------------- */

	public function getLogout(){
		Auth::logout();
		return Redirect::route('home');

	}

/* -----------------------------------------------------LOGOUT ENDS---------------------------------------------------------- */

/* -----------------------------------------------------CHANGE PASSWORD STARTS----------------------------------------------- */
	
	public function getChangePassword(){

		return View::make('account.password');

	}



	public function postChangePassword(){

		$validate = Validator::make(Input::all(), array(
			'old_password' => 'required',
			'password' => 'required|min:6',
			'password_again' => 'required|same:password',
		));

		if($validate ->fails())
		{
			return Redirect::route('account-change-password')->withErrors($validate)->withInput();
		}
		else{

			$user = User::find(Auth::user()->id);

			$old_password = Input::get('old_password');
			$password = Input::get('password');

			if(Hash::check($old_password, $user->getAuthPassword())) {
				$user->password = Hash::make($password);

				if($user->save()){

					return Redirect::route('home')->with('success','Your password has been changed.');

				}
			}else{
					return Redirect::route('account-change-password')->with('fail','Your old password is incorrect.');
				}

		}

		return Redirect::route('account-change-password')->with('fail','Your password could not be changed.');

	}

/* -----------------------------------------------------CHANGE PASSWORD ENDS----------------------------------------------- */


/* -----------------------------------------------------FORGOT PASSWORD STARTS----------------------------------------------- */

	public function getForgotPassword(){

		return View::make('account.forgot');

	}



	public function postForgotPassword(){

		$validate = Validator::make(Input::all(), array(
			'email' => 'required|email',
		));

		if($validate ->fails())
		{
			return Redirect::route('account-forgot-password')->withErrors($validate)->withInput();
		}
		else{

			$user = User::where('email', '=', Input::get('email'));

			if($user->count()){
				$user = $user->first();

				//Generate a new code and password

				$code = str_random(60);
				$password = str_random(10);

				$user->code = $code;
				$user->password_temp = Hash::make($password);

				if($user->save()){

					Mail::send('emails.auth.forgot', array('link' => URL::route('account-recover', $code), 'username' => $user->username, 'password'=> $password), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Your new password');
				});

					return Redirect::route('home')->with('success','We have sent you a new password by email.');

				}


			}

		}

		return Redirect::route('account-forgot-password')->with('fail','Could not request new password.');

	}



	public function getRecover($code){

		$user = User::where('code', '=', $code)->where('password_temp','!=', '');

		if($user->count()){
			    $user = $user->first();

			    // Update user to active state
			    $user->password = $user->password_temp;
			    $user->password_temp = '';
			    $user->code = '';

			    if($user->save()){
			    	return Redirect::route('home')->with('success','Your account has been recovered and you can sign in with your new password.');
			    }
			}
			return Redirect::route('home')->with('fail','We could not recover your account. Try again later.');

	}

/* -----------------------------------------------------FORGOT PASSWORD ENDS----------------------------------------------- */


/* -----------------------------------------------------CREATE ACCOUNT STARTS----------------------------------------------- */

	public function getCreate(){

		return View::make('account.create');

	}


	public function postCreate(){

		$validate = Validator::make(Input::all(), array(
			'email' => 'required|max:50|email|unique:users|min:4',
			'username' => 'required|min:3|max:20',
			'password' => 'required|min:6',
			'password_again' => 'required|same:password',
		));

		if($validate ->fails())
		{
			return Redirect::route('account-create')->withErrors($validate)->withInput();
		}
		else
		{
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Hash::make(Input::get('password')); 
			// Activation Code

			$code = str_random(60);

			$user = User::create(array(
					'email' => $email,
					'user_id' => $email,
					'username' => $username,
					'password' => $password,
					'code' => $code,
					'active' => 0,

				));
			if($user)
			{

				// create profile
				$user_id = User::where('email', '=', $email)->pluck('id');	
				$profile = Profile::create(array(
					'user_id' => $user_id,
					'active' => 0,
				));

				//  Send email
				if($profile){
					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Activate your account');
				});
				return Redirect::route('home')->with('success','Your account has been created! We have sent you an email to activate your account.');
				}
				else{
					return Redirect::route('account-create')->with('fail','An error ocurred.');
				}
				
			}
			else
			{
				return Redirect::route('account-create')->with('fail','An error ocurred.');
			}
		}

	}

/* -----------------------------------------------------CREATE ACCOUNT ENDS----------------------------------------------- */


/* -----------------------------------------------------VERIFY EMAIL/ACTIVATE STARTS-------------------------------------- */
	public function getActivate($code){

		$user = User::where('code', '=', $code)->where('active','=', 0);

		if($user->count()){
			    $user = $user->first();

			    // Update user to active state
			    $user->active = 1;
			    $user->code = '';

			    if($user->save()){
			    	return Redirect::route('home')->with('success','Activated! You can now sign in.');
			    }
			}
			return Redirect::route('home')->with('fail','We could not activate your account. Try again later.');

		}


/* -----------------------------------------------------VERIFY EMAIL/ACTIVATE ENDS-------------------------------------- */

/* -----------------------------------------------------VIEW PROFILE STARTS------------------------------------------------ */

	public function viewProfile(){
		if(Auth::user()){
			$id = Auth::user()->id;
			$profile = Profile::where('user_id', '=', $id)->first();
			$books_posted = Sell::where('user_id', '=', $id)->get();
			$notes_posted = SellNotes::where('user_id', '=', $id)->get();
			$electronics_posted = SellElectronics::where('user_id', '=', $id)->get();
			$carpool_posted = SellCarPool::where('user_id', '=', $id)->get();
			$flatmates_posted = SellFlatmates::where('user_id', '=', $id)->get();
			return View::make('account.profile')->with('profile',$profile)->with('books_posted',$books_posted)
																		->with('notes_posted',$notes_posted)
																		->with('electronics_posted',$electronics_posted)
																		->with('carpool_posted',$carpool_posted)
																		->with('flatmates_posted',$flatmates_posted);
		}
		else{
			return View::make('account.profile');
		}
	}

/* -----------------------------------------------------VIEW PROFILE ENDS--------------------------------------------------- */

/* -----------------------------------------------------MANAGE PROFILE STARTS----------------------------------------------- */

	public function getManageProfile(){
		$profile = Profile::where('user_id', '=', Auth::user()->id)->first();
		$college_id = College::get();
		$city = Cities::get();
		return View::make('account.manageprofile')->with('profiles', $profile)->with('college_id', $college_id)->with('city', $city);
	}



	public function postManageProfile(){
		$validate = Validator::make(Input::all(), array(
			'college_id' => 'required',
			'city' => 'required',
			'contact' => 'required|min:10',
			'user_type' => 'required',
		));

		if($validate ->fails())
		{
			return Redirect::route('getManageProfile')->withErrors($validate)->withInput();
		}
		else
		{
			$college_id = Input::get('college_id');
			$city = Input::get('city');
			$contact = Input::get('contact');
			$user_type = Input::get('user_type');
			$user_id = Auth::user()->id;

			
			$profile = Profile::where('user_id', '=', Auth::user()->id)->first();
			$profile->college_id = $college_id;
			$profile->city = $city;
			$profile->contact = $contact;
			$profile->user_type = $user_type;
			$profile->active = 1;
			$profile->save();
			if($profile)
			{
				return Redirect::route('home')->with('success','Your account has been updated!');
			}
			else
			{
				return Redirect::route('account-create')->with('fail','An error ocurred.');
			}
		}
	}

/* -----------------------------------------------------MANAGE PROFILE ENDS----------------------------------------------- */




/* -----------------------------------------------------FACEBOOK AUTHENTICATION STARTS------------------------------------ */

	public function getLoginWithFacebook() {

    // get data from input
    $code = Input::get( 'code' );

    // get fb service
    $fb = OAuth::consumer( 'Facebook' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from facebook, get the token
        $token = $fb->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $fb->request( '/me' ), true );

        $check_user_exist = User::where('user_id', $result['id'])->orWhere('email', $result['email'])->pluck('id');
        if(!$check_user_exist){
	        $user_id = $result['id'];
	        $email = $result['email'];
			$username = $result['name'];
			$photo = "http://graph.facebook.com/".$result['id']."/picture";
			// Activation Code

			$code = str_random(60);

			$user = User::create(array(
					'user_id' => $user_id,
					'email' => $email,
					'username' => $username,
					'photo' => $photo,
					'code' => $code,
					'active' => 0,

				));
			if($user)
			{	
				// create profile
				$user_id = User::where('email', '=', $email)->pluck('id');	
				$profile = Profile::create(array(
					'user_id' => $user_id,
					'active' => 0,
				));

				//  Send email
				if($profile){
					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Verify your email');
				});


					$auth = Auth::login($user);

					if($auth){
						return Redirect::intended('/');
					}
					else{
						return Redirect::route('account-login')->with('fail','Email/Password wrong, or account not activated.');
					}	
				}
				else{
					return Redirect::route('account-create')->with('fail','An error ocurred.');
				}
			}
			else
			{
				return Redirect::route('account-create')->with('fail','An error ocurred.');
			}
		}
		else{
			$id = User::where('user_id', $result['id'])->orWhere('email', $result['email'])->pluck('id');
			$auth = Auth::loginUsingId($id);
			if($auth){
					return Redirect::intended('/');
				}
				else{
					return Redirect::route('account-login')->with('fail','Email/Password wrong, or account not activated.');
				}

		}

    }
    // if not ask for permission first
    else {
        // get fb authorization
        $url = $fb->getAuthorizationUri();

        // return to facebook login url
         return Redirect::to( (string)$url );
    }

}

/* -----------------------------------------------------FACEBOOK AUTHENTICATION ENDS------------------------------------ */


/* -----------------------------------------------------GOOGLE AUTHENTICATION STARTS------------------------------------ */
public function getLoginWithGoogle() {

    // get data from input
    $code = Input::get( 'code' );

    // get google service
    $googleService = OAuth::consumer( 'Google' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

        $check_user_exist = User::where('user_id', $result['id'])->orWhere('email', $result['email'])->pluck('id');
        if(!$check_user_exist){
	        $user_id = $result['id'];
	        $email = $result['email'];
			$username = $result['name'];
			$photo = "https://plus.google.com/s2/photos/profile/".$result['id']."?sz=100";
			// Activation Code

			$code = str_random(60);

			$user = User::create(array(
					'user_id' => $user_id,
					'email' => $email,
					'username' => $username,
					'photo' => $photo,
					'code' => $code,
					'active' => 0,

				));
			if($user)
			{	
				// create profile
				$user_id = User::where('email', '=', $email)->pluck('id');	
				$profile = Profile::create(array(
					'user_id' => $user_id,
					'active' => 0,
				));

				//  Send email
				if($profile){
					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Verify your email');
				});


					$auth = Auth::login($user);

					if($auth){
						return Redirect::intended('/');
					}
					else{
						return Redirect::route('account-login')->with('fail','Email/Password wrong, or account not activated.');
					}	
				}
				else{
					return Redirect::route('account-create')->with('fail','An error ocurred.');
				}
			}
			else
			{
				return Redirect::route('account-create')->with('fail','An error ocurred.');
			}
		}
		else{
			$id = User::where('user_id', $result['id'])->orWhere('email', $result['email'])->pluck('id');
			$auth = Auth::loginUsingId($id);
			if($auth){
					return Redirect::intended('/');
				}
				else{
					return Redirect::route('account-login')->with('fail','Email/Password wrong, or account not activated.');
				}

		}

    }
    // if not ask for permission first
    else {
        // get googleService authorization
        $url = $googleService->getAuthorizationUri();

        // return to google login url
        return Redirect::to( (string)$url );
    }
}

/* -----------------------------------------------------GOOGLE AUTHENTICATION ENDS------------------------------------ */


}