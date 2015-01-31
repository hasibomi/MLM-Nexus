<?php

class HomeController extends BaseController {

	public function home()
	{
        $catagory   = Catagory::all();
        $product    = Product::orderBy('created_at', 'desc')->get();

        // Check if any users have got any amount by their referals
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

		return View::make('Main.Home.Index', array('query'=>$catagory, 'products'=>$product));
	}
	
	public function products()
	{
		$catagory   = Catagory::all();
        $product    = Product::orderBy('created_at', 'desc')->get();

		return View::make('Products.Shop', array('query'=>$catagory, 'products'=>$product));
	}
	
	public function productDetails()
	{
		return View::make('product-details');
	}

    public function productView($id)
    {
        $query = Product::where('id', $id);

        if($query->count() > 0)
        {
        	return View::make('Products.ProductView', ['product'=>$query->get()]);
        }

        App::abort(404);
    }

    public function productsByCatagory($id)
    {
        $query = Product::where('catagory_id', '=', $id);
        $catagory   = Catagory::all();
        
        return View::make('Products.ProductsByCatagory', ['query'=>$catagory, 'products'=>$query]);
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

}
