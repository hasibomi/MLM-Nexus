<?php

Route::get('/', array(
	'as'	=> 'home',
	'uses'	=> 'HomeController@home'
));

Route::get('shop', array(
	'as'	=> 'product',
	'uses'	=> 'HomeController@products'
));

Route::get('product-details', array(
	'as'	=> 'product-details',
	'uses'	=> 'HomeController@productDetails'
));

Route::get('checkout', array(
	'as'	=> 'checkout',
	'uses'	=> 'HomeController@checkOut'
));

Route::get('cart', array(
	'as'	=> 'cart',
	'uses'	=> 'HomeController@cart'
));

Route::get('contact-us', array(
	'as'	=> 'contact-us',
	'uses'	=> 'HomeController@contactUs'
));


/**
 * Unauthenticated group
 */
Route::group(array('before' => 'guest'), function() {
	
	Route::get('login', array(
		'as'	=> 'login',
		'uses'	=> 'HomeController@login'
	));
	
	Route::group(array('before' => 'csrf'), function() {
		Route::post('signup', array(
			'as' 	=> 'signup',
			'uses'	=> 'users@signup'
		));
		
		Route::post('login', array(
			'as'	=> 'login-post',
			'uses'	=> 'users@login'
		));
	});
	
});

/**
 * Authenticated group
 */
Route::group(array('before' => 'auth'), function() {
	Route::get('logout', array(
		'as'	=> 'logout-page',
		'uses'	=> 'users@logout'
	));

	/**
	 * User page
	 */
	Route::get('/user/', array(
		'as'	=> 'user-page',
		'uses'	=> 'UserController@home'
	));
	
	/**
	 * User accout page
	 */
	Route::get('user/account', array(
		'as'	=> 'user-account-page',
		'uses'	=> 'UserController@account'
	));
	
	/**
	 * Ajax request to arrange member
	 */	
	Route::post('/user/accountright', function() {
		
		if (Request::ajax()) {
			$id 	= Input::get('id');
			$right 	= Input::get('right');
			
			$group = User::find($id);
			
			$group->arrange_group = 'right_side';
			
			$group->save();
			
			return "Success";
		}
	});
	
	Route::post('/user/accountleft', function() {
		
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
});

/*********************************************************************************
 * Admin panel
 *********************************************************************************
*/
 
// Unauthenicated group
Route::group(array('before' => 'guest'), function() {

	/**
	 * Admin Login get
	 */
	Route::get('/admin/login', array(
		'as'	=> 'admin-login',
		'uses'	=> 'AdminLogin@login_page'
	));
	
	Route::group(array('before' => 'csrf'), function() {
	
		/**
		 * Admin Login post
		 */
		Route::post('/admin/login', array(
			'as'	=> 'admin-login',
			'uses'	=> 'AdminLogin@login'
		));
	});
});
 

// Authenticated group
Route::group(array('before' => 'auth'), function() {
	/**
	 * Admin home page
	 */
	Route::get('/admin/', array(
		'as'	=> 'admin-home',
		'uses'	=> 'AdminLogin@home'
	));
	
	/**
	 * Admin account page
	 */
	Route::get('/admin/account', array(
		'as'	=> 'admin-account',
		'uses'	=> 'AdminLogin@account'
	));
	
	// Change password page
	Route::get('/admin/password', array(
		'as'	=> 'change-password-admin-page',
		'uses'	=> 'AdminLogin@changePasswordPage'
	));
	
	// Change password
	Route::get('/admin/change_password/{id}', array(
		'as'	=> 'change-password-admin',
		'uses'	=> 'AdminLogin@changePassword'
	));
	
	// Add product page
	Route::get('/admin/add-product', array(
		'as'	=> 'add-product-page',
		'uses'	=> 'ProductController@addProductPage'
	));
	
	// Add product catagory page
	Route::get('/admin/catagory', array(
		'as'	=> 'add-catagory-page',
		'uses'	=> 'ProductController@addCatagoryPage'
	));
	
	// Edit catagory page
	Route::get('/admin/edit_catagory/{id}', array(
		'as'	=> 'edit-catagory-page',
		'uses'	=> 'ProductController@editCatagoryPage'
	));
	
	// Delete catagory
	Route::get('/admin/delete_catagory/{id}', array(
		'as'	=> 'delete-catagory',
		'uses'	=> 'ProductController@deleteCatagory'
	));

    // Product details page
    Route::get('/admin/product-details/{id}', array(
        'as'    => 'product-details-page',
        'uses'  => 'ProductController@productDetailsPage'
    ));
	
	// User management
	Route::get('/admin/usermanagement', array('as' => 'user-management-page', 'uses' => 'UserManagement@userManagementPage'));
	Route::get('/admin/user/{id}', array('as' => 'user-view', 'uses' => 'UserManagement@viewUser'));
	Route::get('/admin/user/activate/{id}', array('as' => 'user-active', 'uses' => 'UserManagement@activeUser'));
	Route::get('/admin/user/deactivate/{id}', array('as' => 'user-deactive', 'uses' => 'UserManagement@deactiveUser'));
	
	Route::group(array('before' => 'csrf'), function() {
		
		// Add product catagory
		Route::post('/admin/addCatagory', array(
			'as'	=> 'add-catagory',
			'uses'	=> 'ProductController@addCatagory'
		));
		
		// Add product
		Route::post('/admin/addProduct', array(
			'as'	=> 'add-product',
			'uses'	=> 'ProductController@addProduct'
		));
		
		// Edit product
		Route::post("/admin/edit-product-details/{id}", array(
			"as"	=> "edit-product",
			"uses"	=> 'ProductController@editProduct'
		));
		
		// Edit catagory
		Route::post('/admin/edit-catagory/{id}', array(
			'as'	=> 'edit-catagory',
			'uses'	=> 'ProductController@editCatagory'
		));
		
		
	});
	
	// Products page
	Route::get('/admin/shop', array(
		'as'	=> 'products',
		'uses'	=> 'ProductController@products'
	));
	
	// VIew catagory page
	Route::get('/admin/view-catagory', array(
		'as'	=> 'view-catagory-page',
		'uses'	=> 'ProductController@viewCatagory'
	));
	
	// Cart page
	Route::get('/admin/cart', array(
		'as'	=> 'cart-page',
		'uses'	=> 'ProductController@cartPage'
	));
	
	/**
	 * Admin logout page
	 */
	Route::get('/admin/logout', array(
		'as'	=> 'logout-admin',
		'uses'	=> 'AdminLogin@logout'
	));
});


Route::post('signup', 'users@signup');

Route::post('login', 'users@login');
