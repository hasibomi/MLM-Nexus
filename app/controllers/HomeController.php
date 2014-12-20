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

}
