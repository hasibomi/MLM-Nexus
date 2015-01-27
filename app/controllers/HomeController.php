<?php

class HomeController extends BaseController {

	public function home()
	{
        $catagory   = Catagory::all();
        $product    = Product::orderBy('created_at', 'desc')->get();

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
        $query = Product::where('id', $id)->get();

        return View::make('Products.ProductView', ['product'=>$query]);
    }

    public function productsByCatagory($id)
    {
        $query = Product::where('catagory_id', '=', $id)->get();
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
		/*return View::make("Main.Notice")
			->with("notices", Notice::where("notice_id", "=",);*/
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
			$id = json_encode(Auth::id());
			$notices = Notice::where("associated_users", $id)->get();
			return View::make("Main.Notices.Personal.All")
				->with("notices", $notices);
		}
	}

}
