<?php

class HomeController extends BaseController {

	public function home()
	{
		return View::make('index');
	}
	
	public function products()
	{
		return View::make('shop');
	}
	
	public function productDetails()
	{
		return View::make('product-details');
	}
	
	public function checkOut()
	{
		return View::make('checkout');
	}
	
	public function cart()
	{
		return View::make('cart');
	}
	
	public function blog()
	{
		return View::make('blog');
	}
	
	public function blogSingle()
	{
		return View::make('blog-single');
	}
	
	public function contactUs()
	{
		return View::make('contact-us')
			->with('contact', ContactInfo::where('status', '=', 1)->get())
			->with('facebooks', ContactInfo::select('facebook')->where('status', '=', 1)->get())
			->with('twitters', ContactInfo::select('twitter')->where('status', '=', 1)->get())
			->with('googles', ContactInfo::select('google')->where('status', '=', 1)->get());
	}
	
	public function login()
	{
		return View::make('login');
	}

}
