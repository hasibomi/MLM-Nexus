<?php

class ProductController extends BaseController
{
	/**
	 * Add product page
	 */
	public function addProductPage()
	{
		if (Auth::check()) {
			return View::make('admin.add-product');
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Edit product page
	 */
	public function editProductPage()
	{
		if (Auth::check()) {
			return View::make('admin.add-product');
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * View catagory page
	 */
	public function viewCatagory()
	{
		if ( Auth::check() )
		{
			$catagory = Catagory::get();
			return View::make('admin.view-catagory', array(
														'catagories'	=> $catagory
													)
							 );
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Edit catagory page
	 */
	public function editCatagoryPage($id)
	{
		if ( Auth::check() )
		{
			$catagories = Catagory::where('id', '=', $id)->get();
			
			return View::make('admin.edit-catagory', array(
					'row'	=> $catagories
				)
			);
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Cart page
	 */
	public function cartPage()
	{
		if (Auth::check())
		{
			return View::make('admin.cart');
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Add product
	 */
	public function addProduct()
	{
		if (Auth::check()) {
			$validator = Validator::make(Input::all(), array(
				'name'			=> 'required',
				'price'			=> 'required',
				'description'	=> 'required',
                'condition'     => 'required',
                'quantity'		=> 'required',
                'brand'         => 'required',
				'image'			=> 'required',
				'point'			=> 'required'
			));
			
			if ($validator->fails()) {
				return Redirect::route('add-product-page')
								->withErrors($validator)
								->withInput();
			} else {
				$file 			= Input::file('image');
				$file_name 		= $file->getClientOriginalName();
				$file_type 		= $file->getMimeType();
				$file_size 		= $file->getSize()/1000;
				$destination 	= public_path('/mlm/images/shop/');
				
				if ($file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
					if ($file_size <= 2000) {
						if ($file->move($destination, $file_name)) {
							$product = New Product;
				
							$product->name 			= Input::get('name');
							$product->price 		= Input::get('price');
							$product->description 	= Input::get('description');
							$product->catagory 		= Input::get('catagory');
							$product->quantity 		= Input::get('quantity');
                            $product->condition     = Input::get('condition');
                            $product->brand         = Input::get('brand');
							$product->image 		= $file_name;
							$product->point 		= Input::get('point');
							$product->code 			= uniqid(str_random(9));
							
							if ($product->save()) {
								return Redirect::route('add-product-page')
					  							->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Product added!</p>');
							} else {
								return Redirect::route('add-product-page')
					  							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
							}
						} else {
							return Redirect::route('add-product-page')
					  							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Cannot upload image at this time. Please try after sometime</p>');
						}
					} else {
						return Redirect::route('add-product-page')
					  							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Image cannot be more than 2 MB</p>');
					}
				} else {
					return Redirect::route('add-product-page')
					  							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Invalid file</p>');
				}
			}
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Edit product
	 */
	public function editProduct($id)
	{
		if ( Auth::check() ) {
			$validator = Validator::make(
				array (
						"catagory"			=> Input::get("catagory"),
						"product_name"		=> Input::get("product_name"),
						"price"				=> Input::get("price"),
						"condition"			=> Input::get("condition"),
						"quantity"			=> Input::get("quantity"),
						"brand"				=> Input::get("brand"),
						"description"		=> Input::get("description"),
						"point"				=> Input::get("point")
				),
				
				array (
					"catagory"			=> "required",
					"product_name"		=> "required",
					"price"				=> "required",
					"condition"			=> "required",
					"quantity"			=> "required",
					"brand"				=> "required",
					"description"		=> "required",
					"point"				=> "required"
				)
			);
			
			if ( $validator->fails() == TRUE ) {
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			} else {
				$product = Product::find($id);
				
				$product->catagory 		= Input::get("catagory");
				$product->name 			= Input::get("product_name");
				$product->price 		= Input::get("price");
				$product->description 	= Input::get("description");
				$product->point 		= Input::get("point");
				$product->quantity 		= Input::get("quantity");
				$product->condition 	= Input::get("condition");
				$product->brand 		= Input::get("brand");
				
				if (Input::get("image") != "") {
					$product->catagory 	= Input::get("catagory");
				}
				
				if ( $product->save() ) {
					return Redirect::route("products")
									->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Product has been changed successfully</p>');
				} else {
					return Redirect::route('products')
					  							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
				}
			}
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}

	/**
	 * Products page
	 */
	public function products()
	{
		if (Auth::check()) {
			$query = Product::get();
			return View::make('admin.shop', array(
												'query'	=> $query
							 				)
							 );
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}

    /**
     * Product details page
     */
    public function productDetailsPage($id)
    {
        if (Auth::check())
        {
            $query = Product::where('id', '=', $id);
            return View::make('admin.product-details', array('product' => $query));
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }

	/**
	 * Add Catagory page
	 */
	public function addCatagoryPage()
	{
		if (Auth::check())
		{
			return View::make('admin.catagory');
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger">You are not loged in!</p>');
		}
	}

	/**
	 * Add Catagory
	 */
	public function addCatagory()
	{
		if (Auth::check())
		{
			$validator = Validator::make(Input::all(),
				array(
					'catagory_name'		=> 'required|unique:catagories'
				),
				
				array(
					'required'		=> '<div class="col-md-3 alert alert-danger">Please write a catagory name</div>',
					'unique'		=> '<div class="col-md-3 alert alert-danger"><b>'.Input::get('catagory_name').'</b> alredy exists</div>'
				)
			);
			
			if ($validator->fails() == TRUE)
			{
				return Redirect::route('add-catagory-page')
								->withErrors($validator)
								->withInput();
			}
			else
			{
				$catagory = new Catagory;
				
				$catagory->catagory_name = Input::get('catagory_name');
				$catagory->catagory_type = Input::get('catagory_type');
				
				if ($catagory->save())
				{
					return Redirect::route('view-catagory-page')
								->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory added successfully.</p>');
				}
				else
				{
					return Redirect::route('view-catagory-page')
								->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
				}
			}
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}

	/**
	 * Edit catagory
	 */
	public function editCatagory($id)
	{
		if ( Auth::check() ) {
			$validator = Validator::make(Input::all(), array(
					'catagory_name'		=> 'required',
					'catagory_type'		=> 'required'
				)
			);
			
			if ($validator->fails() == TRUE) {
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			} else {
				$catagory = Catagory::find($id);
				
				$catagory->catagory_name 	= Input::get("catagory_name");
				$catagory->catagory_type 	= Input::get('catagory_type');
				
				if ($catagory->save()) {
					return Redirect::route("view-catagory-page")
									->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory has been successfully modified</p>');
				} else {
					return Redirect::route('view-catagory-page')
									->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
				}
			}
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}

	/**
	 * Delete catagory
	 */
	public function deleteCatagory($id)
	{
		if ( Auth::check() ) {
			$catagory = Catagory::find($id);
			
			if ( $catagory->delete() ) {
				return Redirect::route('view-catagory-page')
								->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory has been successfully deleted</p>');
			} else {
				return Redirect::route('view-catagory-page')
								->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
			}
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger">You are not loged in!</p>');
		}
	}
	
	
}
