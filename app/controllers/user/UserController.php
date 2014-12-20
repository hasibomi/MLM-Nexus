<?php

class UserController extends BaseController {
	/**
	 * View Index page for autheticated users
	 */
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

		return View::make('Users.Account', array(
							'total' 			=> $total,
							'left' 				=> $left,
							'right' 			=> $right,
							'ungrouped' 		=> $ungrouped_total,
							'left_member'		=> $left_count,
							'right_member'		=> $right_count
							)
						);
	}
}

?>