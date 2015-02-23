<?php

class CartController extends BaseController
{
	public function add()
    {
        $validator = Validator::make(Input::all(), Cart::$rules);

        if ($validator->passes() == true)
        {
            $key = 'kiobostha?kiobos';
            $price = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode(Input::get('price')), MCRYPT_MODE_ECB));

            $cart = new Cart;

            $cart->invoice = uniqid(rand());
            $cart->user_id = Auth::user()->id;
            $cart->product_id = Input::get('id');
            $cart->quantity = Input::get('quantity');
            $cart->price = Input::get('quantity') * $price;
            $cart->catagory_id = Input::get('catagory');

            if ($cart->save())
            {
                return Redirect::back()
                                ->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Successfully added to cart</p>');
            }

            return Redirect::back()
                            ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after again.</p>');
        }

        return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
    }

    public function showCart()
    {
        // $query = Cart::with('product')->where('user_id', Auth::user()->id)->get();

        $query = Cart::where('user_id', Auth::user()->id)->where('checked_out', '0')->get();

        return View::make('Products.Cart', ['query'=>$query]);
    }

    public function updateCart()
    {
    	$query = Cart::find(Input::get('cat_id'));
 
    	$query->quantity = Input::get('quantity');
        $query->price = Input::get('quantity') * Input::get('price');

    	if ($query->save())
    	{
    		return Redirect::back()
    						->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Cart updated</p>');
    	}

    	return Redirect::back()
						->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured.</p>');
    }

    public function deleteCart()
    {
    	$query = Cart::find(Input::get('id'));

    	if ($query->delete())
    	{
    		return Redirect::back()
    						->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Cart deleted</p>');
    	}

    	return Redirect::back()
						->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured.</p>');
    }

    // Cancel cart
    public function cancel()
    {
    	$query = Cart::where('user_id', Auth::user()->id);

    	if ($query)
    	{
    		if ($query->delete())
    		{
    			return Redirect::back();
    		}

    		return Redirect::back()
    						->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span> Error occured</p>');
    	}

    	return Redirect::back()
    					->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured</p>');
    }

    // Checkout
    public function checkout()
    {
    	$query = Cart::where('user_id', Auth::user()->id)->where('checked_out', '0');

    	if ($query)
    	{
    		if ($query->update(['checked_out' => '1']))
    		{
    			Mail::send('emails.auth.order', array('query' => $query), function ($message) {
					$message->form("info@nexusitzone.com", "Nexus IT Zone");
    				$message->to(Auth::user()->email, Auth::user()->name)->subject('Nexus Order Process');
    			});

    			return Redirect::back()
    							->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Thank you. We received your order. Please check your email</p>');
    		}

    		return Redirect::back()
    						->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span> Error occured</p>');
    	}

    	return Redirect::back()
    					->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured</p>');
    }
}