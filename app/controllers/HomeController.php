<?php

class HomeController extends BaseController {

	public function home()
	{
        $catagory   = Catagory::all();
        $subcatagory = Subcatagory::all();

        $product    = Product::orderBy('created_at', 'desc')->paginate(9);

        // Check if any users have got any amount by their referals
        if(Auth::user())
        {
	        $amount = Amount::where("user_id", Auth::user()->id)->where('status', 0);

	        if($amount->count() > 0)
	        {
	        	$amount->update(['status'=>1]);

	        	// Check the user's referal is an admin or not
				$my_referal = User::find(Auth::user()->referal_id);

				if(Auth::user()->referal_id != 0)
				{
					if($my_referal->type == 'admin')
					{
						$distributed_amount = 600;
					}
					else
					{
						$distributed_amount = 300;
					}

		        	Amount::create(['user_id'=>Auth::user()->referal_id, 'amount'=>$distributed_amount]);
	        	}
	        }
        }

		return View::make('Main.Home.Index', array('catagories'=>$catagory, 'subcatagories' => $subcatagory, 'products'=>$product));
	}

    // View products page
	public function products()
	{
		$catagory   = Catagory::all();

        $product    = Product::orderBy('created_at', 'desc')->paginate(12);

		return View::make('Products.Shop', array('catagories'=>$catagory, 'products'=>$product));
	}

    // Individual product view page
    public function productView($slug)
    {
        $query = Product::where('slug', $slug);
        $catagory = Catagory::all();
        $subcatagory = Subcatagory::all();

        if($query->count() > 0)
        {
        	return View::make('Products.ProductView', ['product'=>$query->get(), 'catagories' => $catagory, 'subcatagories' => $subcatagory]);
        }

        App::abort(404);
    }

    public function productsByCatagory($id)
    {
        $query = Product::where('catagory_id', '=', $id)->paginate(12);
        $catagory   = Catagory::all();

        $subcatagory = Subcatagory::all();

        return View::make('Products.ProductsByCatagory', ['catagories'=>$catagory, 'products'=>$query, 'subcatagories' => $subcatagory]);
    }

    // Products by sub category productsBySubCatagory
    public function productsBySubCatagory($id)
    {
        $query = Product::where('subcatagory_id', '=', $id)->paginate(12);
        $catagory   = Catagory::all();

        $subcatagory = Subcatagory::all();

        return View::make('Products.ProductsByCatagory', ['catagories'=>$catagory, 'products'=>$query, 'subcatagories' => $subcatagory]);
    }
	
	public function checkOut()
	{
		return View::make('checkout');
	}
	
	public function cart()
	{
		return View::make('cart');
	}
	
	public function contactUs()
	{
		return View::make('Main.Contact')
			->with('contact', ContactInfo::where('status', '=', 1)->get())
			->with('facebooks', ContactInfo::select('facebook')->where('status', '=', 1)->get())
			->with('twitters', ContactInfo::select('twitter')->where('status', '=', 1)->get())
			->with('googles', ContactInfo::select('google')->where('status', '=', 1)->get());
	}
	
	public function login()
	{
		return View::make('Main.Login');
	}
	
	// Submit contact form
	public function submit()
	{
		$validator = Validator::make(Input::all(),
			[
				"name" => "required | min:3",
				"email" => "required | email",
				"subject" => "required | min:5",
				"message" => "required | min:20"
			]	
		);
		
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$name = Input::get("name");
		$email = Input::get("email");
		$subject = Input::get("subject");
		$text = Input::get("message");
		
		Mail::send("email.Contact", ["text" => $text], function($message) use($name, $email, $subject, $text) {
			$message->from($email, $name);
			$message->to("hasibomi@hasibomi.com", "Nexus IT Zone")->subject($subject);
		});
		
		return Redirect::back()->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Thank you. We got your message</p>');
	}

	// Notice
	public function notice()
	{
		return View::make("Main.Notice")
			->with("notices", NoticeUserAssociate::where("user_id", "=", 0));
	}

	// Notice view
	public function noticeView($id)
	{
		$query = Notice::find($id);

		if($query)
		{
			return View::make("Main.NoticeView")
				->with("notice", $query);
		}

		return App::abort(404);
	}

	// Personal Notice
	public function personalNotice()
	{
		if(Auth::check())
		{
			$notices = DB::select(DB::raw(
				"SELECT notices.*, notice_user_associates.* 
				FROM notices, notice_user_associates 
				WHERE notices.notice_id = notice_user_associates.notice_id 
				AND notice_user_associates.user_id = " . Auth::user()->id
			));

			return View::make("Main.Notices.Personal.All")
				->with("notices", $notices);
		}
	}

	// Personal Notice view
	public function personalNoticeView($id)
	{
		$query = Notice::where('notice_id', $id);

		if($query->count() > 0)
		{
			return View::make("Main.Notices.Personal.View")
				->with("notices", $query->get());
		}

		return App::abort(404);
	}

    // Account recovery
    public function recover()
    {
        return View::make("Main.Recovery");
    }

    // Recovery post
    public function passRecover()
    {
        $validator = Validator::make(Input::all(), ['email' => 'required|email', 'date_of_birth' => 'required|integer', 'month_of_birth' => 'required|integer', 'year_of_birth' => 'required|integer'], ['integer' => 'Invalid']);

        if ($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator);
        }

        $find = User::where('email', Input::get('email'))->where('date_of_birth', Input::get('date_of_birth'))->where('month_of_birth', Input::get('month_of_birth'))->where('year_of_birth', Input::get('year_of_birth'));

        if($find->count() > 0)
        {
            $email = Input::get('email');

            Mail::send('emails.Recovery', ['email' => Input::get('email')], function($message) use($email)
            {
                $message->form('donotreply@nexusitzone.com');
                $message->to($email)->subject('Account Recovery');
            });

            return Redirect::back()
                ->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Please check your email to recover your account</p>');
        }

        return Redirect::back()
            ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Sorry, we don\'t find the email you provided</p>');
    }

    // Final step to reset password
    public function finalStepReset($email)
    {
        if($email != "")
        {
            $find = User::where("email", $email);

            if($find->count() > 0)
            {
                View::make('Main.Reset');
            }
            else
            {
                App::abort(404);
            }
        }
        else
        {
            App::abort(404);
        }
    }

    // New password update
    public function update()
    {
        $validator = Validator::make(Input::al(), ['password' => 'required|same:password_confirmation', 'password_confirmation' => 'required|same:password']);

        if($validator->fails())
        {
            return Redirect::back()
                ->withErrors($validator);
        }

        $find = User::where('email', $email);

        $password = Hash::make(Input::get('password_confirmatin'));

        $find->update(['password' => $password]);

        return Redirect::to('login')
            ->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Password successfully changed.</p>');
    }

}
