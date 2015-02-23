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
				'image'			=> 'required|image|mimes:jpg,jpeg,png|max:6000',
				'point'			=> 'required',
                'product_code'  => 'required|unique:products',
			));
			
			if ($validator->fails()) {
				return Redirect::route('add-product-page')
								->withErrors($validator)
								->withInput();
			} else {
				$file 			= Input::file('image');

				$file_name 		    = date('d-m-Y-h-i-s-') . $file->getClientOriginalName();
				$destination 	= $destination = "assets/images/shop/";

                $file->move($destination, $file_name);

                $product = New Product;

                $product->name 			    = Input::get('name');
                $product->slug              = Str::slug(Input::get('name'));
                $product->price 		    = Input::get('price');
                $product->description 	    = Input::get('description');
                $product->catagory_id 		= Input::get('catagory');
                $product->subcatagory_id    = Input::get('subcatagory');
                $product->quantity 		    = Input::get('quantity');
                $product->product_condition = Input::get('condition');
                $product->brand             = Input::get('brand');
                $product->image 		    = $file_name;
                $product->point 		    = Input::get('point');
                $product->product_code      = Input::get('product_code');
                $product->code 			    = uniqid(str_random(9));
				
				if($product->save())
                {
                    return Redirect::back()
                        ->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Product saved successfully.</p>');
                }

                return Redirect::back()
                    ->with("event", '<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Error occured. Please try after sometime</p>');
			}
		} else {
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	/**
	 * Edit product
	 */
	public function editProduct($slug)
	{
		$validator = Validator::make(Input::all(),

			array (
				"catagory"			=> "required",
				"product_name"		=> "required",
				"price"				=> "required",
				"condition"			=> "required",
				"quantity"			=> "required",
				"brand"				=> "required",
				"description"		=> "required",
				"point"				=> "required",
				'product_code'      => 'required',
                "image"             => 'image|mimes:jpg,jpeg,png|max:6000'
			)
		);

		if ( $validator->fails() == TRUE ) {
			return Redirect::back()
							->withErrors($validator)
							->withInput();
		} else {
			$product = Product::where("slug", $slug);

            $update = $product->update(
                [
                    'catagory_id' => Input::get('catagory'),
                    'subcatagory_id' => Input::get('subcatagory'),
                    'name' => Input::get('product_name'),
                    'slug' => Str::slug(Input::get('product_name')),
                    'price' => Input::get('price'),
                    'description' => Input::get('description'),
                    'point' => Input::get('point'),
                    'quantity' => Input::get('quantity'),
                    'product_condition' => Input::get('condition'),
                    'brand' => Input::get('brand'),
                    'product_code' => Input::get('product_code')

                ]
            );

			if (Input::hasFile("image")) {
				$file = Input::file('image');
				$image = $file->getClientOriginalName();
				$destination = "assets/images/shop/";

				if($file->move($destination, $image) == false)
				{
					return "Move error";
				}

                $update = $product->update(
                    [
                        'catagory_id' => Input::get('catagory'),
                        'subcatagory_id' => Input::get('subcatagory'),
                        'name' => Input::get('product_name'),
                        'slug' => Str::slug(Input::get('product_name')),
                        'price' => Input::get('price'),
                        'description' => Input::get('description'),
                        'point' => Input::get('point'),
                        'quantity' => Input::get('quantity'),
                        'product_condition' => Input::get('condition'),
                        'brand' => Input::get('brand'),
                        'product_code' => Input::get('product_code'),
                        'image' => $image

                    ]
                );
			}

			if ( $update ) {
				return Redirect::route("products")
								->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Product has been changed successfully</p>');
			} else {
				return Redirect::route('products')
											->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
			}
		}
	}
	
	// Delete product
	public function deleteProduct($slug)
	{
		$query = Product::where('slug', $slug);
		
		if($query->delete())
		{
			File::delete("assets/images/shop/" . $query->first()->image);
			
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
	public function editCatagoryPage($slug)
	{
		$catagories = Catagory::where('slug', '=', $slug)->get();

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
            $catagory->slug = Str::slug(Input::get('catagory_name'));

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
	 * Delete catagory
	 */
	public function deleteCatagory($id)
	{
		$catagory = Catagory::find($id);

        Subcatagory::where('catagory_id', $id)->delete();
        Product::where('catagory_id', $id)->delete();

		if ( $catagory->delete() ) {
			return Redirect::back()
							->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory has been successfully deleted</p>');
		} else {
			return Redirect::back()
							->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
		}
	}

	public function updateCatagory($slug)
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
			$catagory = Catagory::where('slug', $slug);

            if($catagory->count() > 0)
            {
                $update = $catagory->update(
                    [
                        'catagory_name' => Input::get('catagory_name'),
                        'slug' => Str::slug(Input::get('catagory_name'))
                    ]
                );

                if ($update)
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
            else
            {
                App::abort(404);
            }
		}
	}
	
}
