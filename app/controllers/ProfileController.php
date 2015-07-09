<?php

class ProfileController extends Controller {

	public function user($username){

		$user = User::where('username','=', $username);

		if($user->count()){
			$user = $user->first();
			return View::make('profile.user')->with('user', $user);
		}
		return App::abort(404);
	}

}