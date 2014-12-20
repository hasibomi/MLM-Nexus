<?php

class AdminLogin extends BaseController {
	/**
	 * Admin home page
	 */
	public function home()
	{
		$query = Cart::where('status', '0')->take(10)->orderBy("created_at", "DESC");
		
		return View::make('Dashboard.Index', ['query' => $query]);
	}
	
	/**
	 * Account page
	 */
	public function account()
	{
		if (Auth::check()) {
			$admin = User::where('id', '=', Auth::id())->get();
			
			return View::make('admin.account', array(
													'admin'	=> $admin
											   )
							 );
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger">You are not loged in!</p>');
		}
	}
	
	/**
	 * Change password page
	 */
	public function changePasswordPage()
	{
		if (Auth::check()) {
			$admin = User::where('id', '=', Auth::id());

			return View::make('admin.password',
								array(
									'admin'		=> $admin
							 ));
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Change password
	 */
	public function changePassword($id)
	{
		if (Auth::check()) {
			$admin = User::where('id', '=', $id);
			
			if ($admin->count() == 1) {
			return View::make('admin.change_password',
								array(
									'admin'		=> $admin
							 ));
			} else {
				echo "Not found";
			}
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Admin login page
	 */
	public function login_page()
	{
		return View::make('admin.login');
	}
	
	/**
	 * Admin login
	 */
	public function login()
	{
		$email 		= Input::get('email');
		$password 	= Input::get('password');
		
		$validator = Validator::make(Input::all(), array(
			'email' 		=> 'required|email',
			'password' 		=> 'required'
		));
		
		if ($validator->fails()) {
			return Redirect::route('admin-login')
							->withErrors($validator)
							->withInput();
		} else {
			$auth = Auth::attempt(array(
				'email'		=> $email,
				'password'	=> $password,
				'active'	=> 1,
				'type'		=> 'admin'
			));
			
			if ($auth) {
				return Redirect::route('admin-home');
			} else {
				return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Wrong email or password</p>');
			}
		}
	}

	/**
	 * Admin logout
	 */
	public function logout()
	{
		if (Auth::check()){
			Auth::logout();
			return Redirect::route('admin-login');
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
}
