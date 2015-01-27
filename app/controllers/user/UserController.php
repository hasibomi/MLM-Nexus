<?php

class UserController extends BaseController {

	public function home()
	{
		if (Auth::check()) {
            $catagory   = Catagory::all();
            $product    = Product::orderBy('created_at', 'desc')->get();

			return View::make('users.index', array('query'=>$catagory, 'products'=>$product));
		} else {
			return Redirect::route('login')
							->with('unauthorised', 'You are not loged in. Please Login first');
		}
	}    

    public function contact()
    {
        return View::make('users.contact-us')
			->with('contact', ContactInfo::where('status', '=', 1)->get())
			->with('facebooks', ContactInfo::select('facebook')->where('status', '=', 1)->get())
			->with('twitters', ContactInfo::select('twitter')->where('status', '=', 1)->get())
			->with('googles', ContactInfo::select('google')->where('status', '=', 1)->get());
    }    

    // Shop
    public function shop()
    {
        $catagory   = Catagory::all();
        $product    = Product::orderBy('created_at', 'desc')->get();

        return View::make('users.shop', array('query'=>$catagory, 'products'=>$product));
    }

    public function productView($id)
    {
        $query = Product::where('id', $id)->get();

        return View::make('users.productView', ['product'=>$query]);
    }

    public function productsByCatagory($id)
    {
        $query = Product::where('catagory_id', '=', $id)->get();
        $catagory   = Catagory::all();

        return View::make('users.products', ['query'=>$catagory, 'products'=>$query, 'cat_id' => $id]);
    }	

	public function account()
	{
		if(Auth::check())
		{
            $query = User::select('referal_id', 'active')->where('referal_id', '=', Auth::id())->where('active', '=', '1');

            if ($query->count() == 0) {
                $total = $query->count();
            } else {
                $total = $query->count();
            }

            $ungrouped_total = User::where('referal_id', '=', Auth::id())->where('arrange_group', '=', 'ungrouped')->get();

            $left_count = User::where('referal_id', '=', Auth::id())->where('arrange_group', '=', 'left_side')->get();

            if ($left_count->count() == 0) {
                $left = $left_count->count();
            } else {
                $left = $left_count->count();
            }

            $right_count = User::where('referal_id', '=', Auth::id())->where('arrange_group', '=', 'right_side')->get();

            if ($right_count->count() == 0) {
                $right = $right_count->count();
            } else {
                $right = $right_count->count();
            }

            $points = Point::where("user_id", Auth::user()->id);

            if($points->count() > 0)
            {
            	$point = $points->sum("point") . " points";
            }
            else
            {
            	$point = 0 . " point";
            }

            return View::make('Users.Account', array(
                                'total' 			=> $total,
                                'left' 				=> $left,
                                'right' 			=> $right,
                                'ungrouped' 		=> $ungrouped_total,
                                'left_member'		=> $left_count,
                                'right_member'		=> $right_count,
                                'point'				=> $point
                                )
                            );
		}
		else
		{
			return Redirect::route("login")->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign'></span> You are not logged in!</p>");
		}
	}

	// Refer a friend
	public function refer()
	{
		$email = Input::get("email");
		$text = Input::get("referMessage");
		$user = Auth::user()->email;
		$name = Auth::user()->name;		

		if($email == $user)
		{
			return Redirect::back()->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign'></span> You can't send invitation to yourself</p>");
		}
		else if(User::where("email", "=", $email)->count() == 1)
		{
			return Redirect::back()->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign'></span> Your friend is already a member</p>");
		}
		else
		{
			Mail::send("emails.auth.Refer", ["query" => $text], function($message) use ($email, $text, $user, $name) {
				$message->from($user, $name);
				$message->to($email)->subject("Invitation from " . $user);
			});

			return Redirect::back()->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Thank you. Your invitation has been sent.</p>");
		}
	}

	// Rechage
	public function recharge()
	{
		$v = Validator::make(Input::all(), ["code"=>"required|size:22"], ["required"=>"<span class='glyphicon glyphicon-exclamation-sign'></span> Please typr the code.", "size"=>"<span class='glyphicon glyphicon-exclamation-sign'></span> Invalid code"]);

		if($v->fails())
		{
			return Redirect::back()
				->withErrors($v)
				->withInput();
		}
		$find = Product::where("code", Input::get("code"));

		if($find->count() > 0)
		{
			$point = $find->get()->first()->point;

			$p = new Point;

			$p->user_id = Auth::user()->id;
			$p->point = $point;
			$p->product_id = $find->get()->first()->id;

			$p->save(); 

			Product::where("code", Input::get("code"))->update(["code" => ""]);			

			return Redirect::back()
			->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Congratulation! You got " .$point. " points.</p>");
		}

		return Redirect::back()->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign'></span> Invalid code.</p>");
	}

}