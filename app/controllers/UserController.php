<?php

class UserController extends BaseController {

	// gets the view for the register page
	public function getCreate()
	{
		return View::make('user.register');

	}

	// gets the view for the login page
	public function getLogin()
	{
		return View::make('user.login');

	}

	// gets the view for the register page
	public function postCreate()
	{
		$validate = Validator::make(Input::all(), array(
			'email' => 'required|unique:users|min:4',
			'pass1' => 'required|min:6',
			'pass2' => 'required|same:pass1',
		));

		if($validate ->fails())
		{
			return Redirect::route('getCreate')->withErrors($validate)->withInput();
		}
		else
		{
			$user = new User();
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('pass1'));

			if($user->save())
			{
				return Redirect::route('getCreate')->with('success','You registered succesfully. You can login.');
			}
			else
			{
				return Redirect::route('getCreate')->with('fail','An error ocurred.');
			}
		}

	}

	// gets the view for the login page
	public function postLogin()
	{
		$validate = Validator::make(Input::all(), array(
			'email' => 'required',
			'pass1' => 'required'
		));

		if($validate->fails())
		{
			return Redirect::route('getLogin')->withErrors($validate)->withInput();
		}
		else
		{
			$remember=(Input::has('remember')) ? true : false;
			$auth = Auth::attempt(array(
					'email' => Input::get('email'),
					'password' => Input::get('pass1')
				),$remember);
			if($auth)
			{
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('getLogin')->with('fail','You entered the wrong login credentials.');
			}
		}

	}

	public function getLogOut() {

    Auth::logout();
    return Redirect::route('getLogin');

	}


	public function viewProfile(){
		return View::make('user.profile');
	}

}   