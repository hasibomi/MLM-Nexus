<?php

class ProfileController extends BaseController
{
	
	/**
	 * Upload profile picture
	 */
	public function upload()
	{
		$validator = Validator::make(Input::all(), ["propic" => "required|image|mimes:jpg,jpeg,png|max:6000"]);
		
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$user = User::find(Auth::id());
			
			if($user)
			{
				if($user->profile_picture)
				{
					File::delete("images/propic/" . $user->profile_picture);
				}
				
				$image 			= Input::file('propic');
				$name 			= $image->getClientOriginalName();
				/*$type 			= $image->getMimeType();
				$size 			= $image->getSize()/1000;*/
				$destination 	= 'images/propic/';

				$image->move($destination, $name);


				$user->profile_picture = $name;

				if($user->save())
				{
					return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Picture uploaded</p>');
				}

				return Redirect::back()->with("event", '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
			}
		}
	}
}
