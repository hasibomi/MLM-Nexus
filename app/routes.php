<?php

Route::get('/updateapp', function() { Artisan::call('dump-autoload'); echo 'dump-autoload complete'; });

// Home
Route::get('/', array('as'	=> 'home', 'uses'	=> 'HomeController@home'));

// Products
Route::get('/shop', array('as'	=> 'products', 'uses'	=> 'HomeController@products'));
Route::get('/products/view/{id}', ['as'=>'product-view','uses'=>'HomeController@productView']);
Route::get('/products/all/{id}', ['as'=>'products-by-catagory', 'uses'=>'HomeController@productsByCatagory']);
Route::get('/product-details', array('as'	=> 'product-details', 'uses'	=> 'HomeController@productDetails'));

// Cart
Route::get('/cart', array('as' => 'cart', 'uses' => 'HomeController@cart'));
Route::get('/checkout', array('as' => 'checkout', 'uses' => 'HomeController@checkOut'));

// Contact Us
Route::get('/contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@contactUs'));

Route::get("logout", ["as" => "logout", "uses" => "users@logout"]);


/**
 * Unauthenticated group
 * Login & Logout
 */
Route::group(array('before' => 'guest'), function() {
	
	// Login & Logout
	Route::get('/login', array('as' => 'login', 'uses' => 'HomeController@login'));
	
	Route::group(array('before' => 'csrf'), function() {
		
		// Login & Logout Post
		Route::post('mlm/signup', array('as' => 'signup', 'uses' => 'users@signup'));
		Route::post('login', array('as'	=> 'login-post', 'uses'	=> 'users@login'));
	});
	
});

/**
 * Member group
 */
Route::group(array('before' => 'member'), function() {

	// Logout
	
	
    // Cart
    Route::get('cart', ['as'=>'cart-page', 'uses'=>'CartController@showCart']);
    Route::get('cart/update', ['as' => 'cart-update-page', 'uses' => 'CartController@updateCart']);
    Route::get('cart/delete', ['as' => 'cart-delete-page', 'uses' => 'CartController@deleteCart']);
    Route::get('cart/cancel', ['as' => 'cart-cancel-page', 'uses' => 'CartController@cancel']);
    Route::get('cart/checkout', ['as' => 'checkout-page', 'uses' => 'CartController@checkout']);
	
	// Account
	Route::get('account', ['as' => 'account-page', 'uses' => 'UserController@account']);
	
	/**
	 * Ajax request to arrange member
	 */	
	Route::post('accountright', function() {
		
		if (Request::ajax()) {
			$id 	= Input::get('id');
			$right 	= Input::get('right');
			
			$group = User::find($id);
			
			$group->arrange_group = 'right_side';
			
			$group->save();
			
			return "Success";
		}
	});
	
	Route::post('accountleft', function() {
		
		if (Request::ajax()) {
			$id 	= Input::get('id');
			$left 	= Input::get('left');
			
			$group = User::find($id);
			
			$group->arrange_group = 'left_side';
			
			$group->save();
			
			return "Success";
		}
	});
	
	/**
	 * Upload image
	 */
	Route::post('upload', array(
		'as'	=> 'upload-pro-pic',
		'uses'	=> 'ProfileController@upload'
	));

    Route::group(['before'=>'csrf'], function() {
        // Cart
        Route::post('products/add-to-cart', ['as'=>'add-to-cart','uses'=>'CartController@add']);
		Route::post('cart/update', ['as' => 'user-cart-update', 'uses' => 'CartController@updateCart']);
	    Route::post('cart/delete', ['as' => 'user-cart-delete', 'uses' => 'CartController@deleteCart']);
    });
});

/*********************************************************************************
 * Admin panel
 *********************************************************************************
*/

// Authenticated group
Route::group(array('before' => 'admin'), function() {
	
	// Dashboard
	Route::get('dashboard', array('as'	=> 'admin-home', 'uses'	=> 'AdminLogin@home'));
	
	// Products
	Route::get("product/add", ["as" => "add-product-page", "uses" => "ProductController@addProductPage"]);
	Route::get("products/delete/{id}", ["as" => "delete-product", "uses" => "ProductController@deleteProduct"]);
	
	// Catagory
	Route::get('catagory/add', array('as'	=> 'add-catagory-page', 'uses'	=> 'ProductController@addCatagoryPage'));
	Route::get('catagory/edit_catagory/{id}', array('as'	=> 'edit-catagory-page', 'uses'	=> 'ProductController@editCatagoryPage'));
	Route::get('catagory/delete_catagory/{id}', array('as'	=> 'delete-catagory', 'uses'	=> 'ProductController@deleteCatagory'));
	
	// Cart page
	Route::get('admin/cart', array(
		'as'	=> 'cart-page',
		'uses'	=> 'ProductController@cartPage'
	));
	
	/**
	 * Admin account page
	 */
	Route::get('admin/account', array(
		'as'	=> 'admin-account',
		'uses'	=> 'AdminLogin@account'
	));
	
	// Change password page
	Route::get('admin/password', array(
		'as'	=> 'change-password-admin-page',
		'uses'	=> 'AdminLogin@changePasswordPage'
	));
	
	// Change password
	Route::get('admin/change_password/{id}', array(
		'as'	=> 'change-password-admin',
		'uses'	=> 'AdminLogin@changePassword'
	));
	
	// Add product page
	Route::get('admin/add-product', array(
		'as'	=> 'add-product-page',
		'uses'	=> 'ProductController@addProductPage'
	));

    // Product details page
    Route::get('admin/product-details/{id}', array(
        'as'    => 'product-details-page',
        'uses'  => 'ProductController@productDetailsPage'
    ));
	
	// User management
	Route::get('admin/usermanagement', array('as' => 'user-management-page', 'uses' => 'UserManagement@userManagementPage'));
	Route::get('admin/user/{id}', array('as' => 'user-view', 'uses' => 'UserManagement@viewUser'));
	Route::get('admin/user/activate/{id}', array('as' => 'user-active', 'uses' => 'UserManagement@activeUser'));
	Route::get('admin/user/deactivate/{id}', array('as' => 'user-deactive', 'uses' => 'UserManagement@deactiveUser'));
	
	// Content Management
	Route::get( 'admin/manage-content', array( 'as' => 'manage-content-page', 'uses' => 'ContentManagement@index' ) );
	Route::get( 'admin/add-content', array( 'as' => 'add-content-page', 'uses' => 'ContentManagement@addContent' ) );
	Route::get('admin/edit-content/{id}', array('as' => 'edit-content-page', 'uses' => 'ContentManagement@edit'));
    Route::get('admin/change-settings', array('as' => 'change-settings-page', 'uses' => 'ContentManagement@settings'));

    // Contact Info
    //Route::get('admin/contact-info', array('as' => 'contact-info-page', 'uses' => 'ContactController@index'));
    Route::controller('admin/contact-info', 'ContactController');

    // Slider
    Route::get('admin/slider', array('as' => 'slider-page', 'uses' => 'SliderController@index'));
    Route::get('admin/add-slider', array('as' => 'add-slider-page', 'uses' => 'SliderController@addSliderPage'));
	Route::get('admin/edit-slider/{id}', array('as' => 'view-slider-page', 'uses' => 'SliderController@edit'));
    Route::get('admin/getId', function()
    {
        if (Request::ajax())
        {
            $query  = Slider::get();
            foreach ($query as $row)
            {
                $id     = $row->slider_id;
            }
            return $id + 1;
        }
    });
    Route::post('admin/contentImage', array('as'=>'content-image', 'uses'=>'ContentManagement@upload'));
    Route::post('admin/edit-content/updateContentImage', array('as'=>'update-content-image', 'uses'=>'ContentManagement@updateUpload'));

    // Order
    Route::controller('admin/order', 'OrderController');
	
	Route::group(array('before' => 'csrf'), function() {
		
		// Add product catagory
		Route::post('admin/addCatagory', array(
			'as'	=> 'add-catagory',
			'uses'	=> 'ProductController@addCatagory'
		));
		
		// Add product
		Route::post('admin/addProduct', array(
			'as'	=> 'add-product',
			'uses'	=> 'ProductController@addProduct'
		));
		
		// Edit product
		Route::post("admin/edit-product-details/{id}", array(
			"as"	=> "edit-product",
			"uses"	=> 'ProductController@editProduct'
		));
		
		// Edit catagory
		Route::post('admin/edit-catagory/{id}', array(
			'as'	=> 'edit-catagory',
			'uses'	=> 'ProductController@editCatagory'
		));

        // Content Management
        Route::post( 'admin/storeContent', array('as' => 'add-content', 'uses' => 'ContentManagement@store') );
        Route::post('admin/changeSettings', array('as' => 'change-settings', 'uses' => 'ContentManagement@change'));
        Route::post('admin/changeStatus', array('as' => 'change-status', 'uses' => 'ContentManagement@status'));
		Route::post('admin/update-content', array('as' => 'update-content', 'uses' => 'ContentManagement@update'));
		Route::post('admin/delete-content', array('as' => 'delete-content', 'uses' => 'ContentManagement@delete'));
        Route::post('admin/add-slider-post', array('as' => 'add-slider', 'uses' => 'SliderController@addSlider'));
        Route::post('admin/slider-status', array('as' => 'slider-status', 'uses' => 'SliderController@changeStatus'));
		Route::post('admin/update/{id}', array('as' => 'update-slider', 'uses' => 'SliderController@update'));
		Route::post('admin/delete', array('as' => 'delete-slider', 'uses' => 'SliderController@delete'));		
	});
	
	/**
	 * Admin logout page
	 */
	Route::get('admin/logout', array(
		'as'	=> 'logout-admin',
		'uses'	=> 'AdminLogin@logout'
	));
});


Route::post('signup', 'users@signup');

Route::post('login', 'users@login');
