<?php

class ProfileController extends BaseController
{
	
	/**
	 * Upload profile picture
	 */
	public function upload()
	{
		if (Input::file('propic') != "") {
			$image 			= Input::file('propic');
			$name 			= $image->getClientOriginalName();
			$type 			= $image->getMimeType();
			$size 			= $image->getSize()/1000;
			$destination 	= public_path('images/propic/');
			
			if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png') {
				if ($size <= 5000) {
					$image->move($destination, $name);
					
					$user = User::find(Auth::id());
					$user->profile_picture = $name;
					
					$user->save();
					
					return Redirect::route('user-account-page')->with('event', '<p class="alert alert-success">Picture uploaded</p>');
				} else {
					return Redirect::route('user-account-page')->with('event', '<p class="alert alert-danger">Image cannot be more than 5 MB</p>');
				}
			} else {
				return Redirect::route('user-account-page')->with('event', '<p class="alert alert-danger">Invalid file</p>');
			}
		} else {
			return Redirect::route('user-account-page')->with('event', '<p class="alert alert-danger">Please insert an image</p>');
		}
	}
}
