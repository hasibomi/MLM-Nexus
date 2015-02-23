<?php

class ProfileController extends BaseController
{
	
	/**
	 * Upload profile picture
	 */
	public function upload()
	{
		$validator = Validator::make(Input::all(), ["propic" => "required|image|mimes:jpg,jpeg,png|max:6000"], ["required" => "Please insert an image"]);
		
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
					File::delete("assets/images/propic/" . $user->profile_picture);
				}
				
				$image 			= Input::file('propic');
				$name 			= $image->getClientOriginalName();
				/*$type 			= $image->getMimeType();
				$size 			= $image->getSize()/1000;*/
				$destination 	= 'assets/images/propic/';

				$image->move($destination, $name);


				$user->profile_picture = 'assets/images/propic/' . $name;

				if($user->save())
				{
					return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Picture uploaded</p>');
				}

				return Redirect::back()->with("event", '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
			}
		}
	}

    // Update profile
    public function update()
    {
        // Validate user's input
        $validator = Validator::make(Input::all(), ["present_address" => "required|min:10", "permanent_address" => "required|min:10", "current_password" => "required_with:password,password_confirmation", "password" => "required_with:password_confirmation,current_password", "password_confirmation" => "required_with:current_password,password|same:password"]);

        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator);
        }

        // if input passes validation
        $user = User::find(Auth::user()->id);

        // Check the user exists
        if($user->count() > 0)
        {
            $user->permanent_address = Input::get("permanent_address");
            $user->present_address = Input::get("present_address");

            // if user wants to change the password
            if(Input::has("password_confirmation"))
            {
                if(Hash::check(Input::get("current_password"), $user->password))
                {
                    $user->password = Hash::make(Input::get("password_confirmation"));
                }
                else
                {
                    return Redirect::back()
                        ->with("event", '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Wrong password</p>');
                }
            }

            // Save the information
            if($user->save())
            {
                return Redirect::back()
                    ->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Profile updated.</p>');
            }

            // if failed to save
            return Redirect::back()
                ->with("event", '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
        }

        // if not exists, show 404 page
        App::abort(404);
    }
}
