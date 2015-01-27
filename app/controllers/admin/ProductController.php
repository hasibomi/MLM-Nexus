<?php

class ProductController extends BaseController
{
	/**
	 * Add product page
	 */
	public function addProductPage()
	{
		return View::make('Products.AddProduct');
		
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
				'point'			=> 'required',
                'product_code'  => 'required|unique:products'
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
				$destination 	= $destination = "assets/images/shop/";
				
				if ($file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/png') {
					if ($file_size <= 2000) {
						if ($file->move($destination, $file_name)) {
							$product = New Product;
				
							$product->name 			    = Input::get('name');
							$product->price 		    = Input::get('price');
							$product->description 	    = Input::get('description');
							$product->catagory_id 		= Input::get('catagory');
							$product->quantity 		    = Input::get('quantity');
                            $product->product_condition = Input::get('condition');
                            $product->brand             = Input::get('brand');
							$product->image 		    = $file_name;
							$product->point 		    = Input::get('point');
                            $product->product_code      = Input::get('product_code');
							$product->code 			    = uniqid(str_random(9));
							
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
		$validator = Validator::make(
			array (
					"catagory"			=> Input::get("catagory"),
					"product_name"		=> Input::get("product_name"),
					"price"				=> Input::get("price"),
					"condition"			=> Input::get("condition"),
					"quantity"			=> Input::get("quantity"),
					"brand"				=> Input::get("brand"),
					"description"		=> Input::get("description"),
					"point"				=> Input::get("point"),
					"product_code"      => Input::get('product_code')
			),

			array (
				"catagory"			=> "required",
				"product_name"		=> "required",
				"price"				=> "required",
				"condition"			=> "required",
				"quantity"			=> "required",
				"brand"				=> "required",
				"description"		=> "required",
				"point"				=> "required",
				'product_code'      => 'required'
			)
		);

		if ( $validator->fails() == TRUE ) {
			return Redirect::back()
							->withErrors($validator)
							->withInput();
		} else {
			$product = Product::find($id);

			$product->catagory_id 		    = Input::get("catagory");
			$product->name 			        = Input::get("product_name");
			$product->price 		        = Input::get("price");
			$product->description 	        = Input::get("description");
			$product->point 		        = Input::get("point");
			$product->quantity 		        = Input::get("quantity");
			$product->product_condition 	= Input::get("condition");
			$product->brand 		        = Input::get("brand");
			$product->product_code          = Input::get('product_code');

			if (Input::file("image") != "") {
				$file = Input::file('image');
				$image = $file->getClientOriginalName();
				$destination = "assets/images/shop/";

				if($file->move($destination, $image) == false)
				{
					return "Move error";
				}

				$product->image 	= $image;
			}

			if ( $product->save() ) {
				return Redirect::route("products")
								->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Product has been changed successfully</p>');
			} else {
				return Redirect::route('products')
											->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
			}
		}
	}
	
	// Delete product
	public function deleteProduct($id)
	{
		$query = Product::find($id);
		
		if($query->delete())
		{
			File::delete("assets/images/shop/" . $query->image);
			
			return Redirect::back()->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Product deleted</p>");
		}
		else
		{
			return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
		}
	}

	/**
	 * Add Catagory page
	 */
	public function addCatagoryPage()
	{
		return View::make('Catagories.AddCatagory');
	}
	
	/**
	 * Edit catagory page
	 */
	public function editCatagoryPage($id)
	{
		$catagories = Catagory::where('id', '=', $id)->get();

		return View::make('Catagories.EditCatagory', array('row'	=> $catagories));
	}

	/**
	 * Add Catagory
	 */
	public function addCatagory()
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
				return Redirect::back()
							->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory added successfully.</p>');
			}
			else
			{
				return Redirect::back()
							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
			}
		}
	}

	/**
	 * Edit catagory
	 */
	public function editCatagory($id)
	{
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
				return Redirect::back()
								->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory has been successfully modified</p>');
			} else {
				return Redirect::back()
								->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
			}
		}
	}

	/**
	 * Delete catagory
	 */
	public function deleteCatagory($id)
	{
		$catagory = Catagory::find($id);

		if ( $catagory->delete() ) {
			Catagory::where("catagory_id", $id)->delete();

			return Redirect::back()
							->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory has been successfully deleted</p>');
		} else {
			return Redirect::back()
							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
		}
	}

	public function updateCatagory($id)
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
			$catagory = Catagory::find($id);

			$catagory->catagory_name = Input::get('catagory_name');
			$catagory->catagory_type = Input::get('catagory_type');

			if ($catagory->save())
			{
				return Redirect::to('shop')
							->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory updated successfully.</p>');
			}
			else
			{
				return Redirect::back()
							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
			}
		}
	}
	
}
