<?php

Route::get('/updateapp', function() { Artisan::call('dump-autoload'); echo 'dump-autoload complete'; });

// Home
Route::get('/', array('as'	=> 'home', 'uses'	=> 'HomeController@home'));

// Account
Route::get("account", ["as" => "admin-account", "uses" => "UserController@account"]);

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
		
		// Contact form submission
		Route::post("submitContact", ["as" => "submit-contact", "uses" => "HomeController@submit"]);
	});
	
});

/**
 * Member group
 */
Route::group(array('before' => 'member'), function() {

    // Cart
    Route::get('cart', ['as'=>'cart-page', 'uses'=>'CartController@showCart']);
    Route::get('cart/update', ['as' => 'cart-update-page', 'uses' => 'CartController@updateCart']);
    Route::get('cart/delete', ['as' => 'cart-delete-page', 'uses' => 'CartController@deleteCart']);
    Route::get('cart/cancel', ['as' => 'cart-cancel-page', 'uses' => 'CartController@cancel']);
    Route::get('cart/checkout', ['as' => 'checkout-page', 'uses' => 'CartController@checkout']);
	
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
	Route::post('upload', array('as'	=> 'upload-pro-pic', 'uses'	=> 'ProfileController@upload'));

    Route::group(['before'=>'csrf'], function() {
        // Cart
        Route::post('products/add-to-cart', ['as'=>'add-to-cart','uses'=>'CartController@add']);
		Route::post('cart/update', ['as' => 'user-cart-update', 'uses' => 'CartController@updateCart']);
	    Route::post('cart/delete', ['as' => 'user-cart-delete', 'uses' => 'CartController@deleteCart']);
		
		// Refer a friend
		Route::post("refer", ["as" => "refer-friend", "uses" => "UserController@refer"]);
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
	
	// User Management
	Route::get("dashboard/usermanagement", ["as" => "user-management-page", "uses" => "UserManagement@userManagementPage"]);
	Route::get('dashboard/user/{id}', array('as' => 'user-view', 'uses' => 'UserManagement@viewUser'));
	Route::get('dashboard/user/activate/{id}', array('as' => 'user-active', 'uses' => 'UserManagement@activeUser'));
	Route::get('dashboard/user/deactivate/{id}', array('as' => 'user-deactive', 'uses' => 'UserManagement@deactiveUser'));
	
	// Content Management
	Route::get("dashboard/add-content", ["as" => "add-content-page", "uses" => "ContentManagement@addContent"]);
	Route::get("dashboard/manage-content", ["as" => "cms", "uses" => "ContentManagement@index"]);
	Route::get("dashboard/edit-content/{id}", ["as" => "edit-content-page", "uses" => "ContentManagement@edit"]);
	Route::get('dashboard/change-settings', array('as' => 'change-settings-page', 'uses' => 'ContentManagement@settings'));
	
	// Slider
    Route::get('dashboard/slider', array('as' => 'slider-page', 'uses' => 'SliderController@index'));
    Route::get('dashboard/add-slider', array('as' => 'add-slider-page', 'uses' => 'SliderController@addSliderPage'));
	Route::get('dashboard/edit-slider/{id}', array('as' => 'view-slider-page', 'uses' => 'SliderController@edit'));
    Route::get('dashboard/getId', function()
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
	
	// Contact Info
	Route::controller('dashboard/contact-info', 'ContactController');
	
	// Order
    Route::controller('dashboard/order', 'OrderController');
	
	// Support
	Route::controller("dashboard/support", "SupportController");
	
	// Post
	Route::group(["before" => "csrf"], function() {
		
		Route::post('dashboard/contentImage', array('as'=>'content-image', 'uses'=>'ContentManagement@upload'));
		Route::post('dashboard/edit-content/updateContentImage', array('as'=>'update-content-image', 'uses'=>'ContentManagement@updateUpload'));
	
		// Catagory
		Route::post("catagory/delete_catagory/{id}", ["as" => "delete-catagory", "uses" => "ProductController@deleteCatagory"]);
		
		// Content Management
        Route::post( 'dashboard/storeContent', array('as' => 'add-content', 'uses' => 'ContentManagement@store') );
        Route::post('dashboard/changeSettings', array('as' => 'change-settings', 'uses' => 'ContentManagement@change'));
        Route::post('dashboard/changeStatus', array('as' => 'change-status', 'uses' => 'ContentManagement@status'));
		Route::post('dashboard/update-content', array('as' => 'update-content', 'uses' => 'ContentManagement@update'));
		Route::post('dashboard/delete-content', array('as' => 'delete-content', 'uses' => 'ContentManagement@delete'));
        
		// Slider
		Route::post('dashboard/add-slider-post', array('as' => 'add-slider', 'uses' => 'SliderController@addSlider'));
        Route::post('dashboard/slider-status', array('as' => 'slider-status', 'uses' => 'SliderController@changeStatus'));
		Route::post('dashboard/update/{id}', array('as' => 'update-slider', 'uses' => 'SliderController@update'));
		Route::post('dashboard/delete', array('as' => 'delete-slider', 'uses' => 'SliderController@delete'));
	});
});


Route::post('signup', 'users@signup');

Route::post('login', 'users@login');
