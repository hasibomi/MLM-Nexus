<?php

Route::get('/updateapp', function() { Artisan::call('dump-autoload'); echo 'dump-autoload complete'; });

// Home
Route::get('/', array('as'	=> 'home', 'uses'	=> 'HomeController@home'));

// Account
Route::get("account", ["as" => "admin-account", "uses" => "UserController@account"]);

// Products
Route::get('/shop', array('as'	=> 'products', 'uses'	=> 'HomeController@products'));
Route::get('/products/view/{slug}', ['as'=>'product-view','uses'=>'HomeController@productView']);
Route::get('products/all/{id}', ['as'=>'products-by-catagory', 'uses'=>'HomeController@productsByCatagory']);
Route::get('products/subcatagory/all/{id}', ['as'=>'products-by-catagory', 'uses'=>'HomeController@productsBySubCatagory']);
Route::get('/product-details', array('as'	=> 'product-details', 'uses'	=> 'HomeController@productDetails'));

// Contact Us
Route::get('/contact-us', array('as' => 'contact-us', 'uses' => 'HomeController@contactUs'));
Route::get("logout", ["as" => "logout", "uses" => "users@logout"]);

// Notice
Route::get("notice", ["as" => "notice-page", "uses" => "HomeController@notice"]);
Route::get("notice/view/{id}", ["as" => "notice-view-page", "uses" => "HomeController@noticeView"]);

// Account recovery
Route::get("account/recovery", ["uses" => "HomeController@recover"]);

// Reset password page from email
Route::get("account/recover/resetpass/email/{email}", ["uses" => "HomeController@finalStepReset"]);

//Unauthenticated group

// Login & Logout
Route::post("findRefer", ["as" => "find-refer", "uses" => "users@findRefer"]);

// Login & Logout
Route::get('login', array('as' => 'login', 'uses' => 'HomeController@login'));

// Login & Logout Post
Route::post('signup', array('as' => 'signup', 'uses' => 'users@signup'));
Route::post('login', array('as'	=> 'login-post', 'uses'	=> 'users@login'));

Route::group(array('before' => 'csrf'), function() {
	// Contact form submission
	Route::post("submitContact", ["as" => "submit-contact", "uses" => "HomeController@submit"]);

    // Account update
    Route::post("account/update", ["uses" => "ProfileController@update"]);

    // Account recover
    Route::post("account/recovery/recover", ["uses" => "HomeController@passRecover"]);

    // Reset password final
    Route::post("account/recovery/newpassword", ["uses" => "HomeController@update"]);
});

// Member group
Route::group(array('before' => 'member'), function() {
    // Cart
    Route::get('cart', ['as'=>'cart-page', 'uses'=>'CartController@showCart']);
    Route::get('cart/update', ['as' => 'cart-update-page', 'uses' => 'CartController@updateCart']);
    Route::get('cart/delete', ['as' => 'cart-delete-page', 'uses' => 'CartController@deleteCart']);
    Route::get('cart/cancel', ['as' => 'cart-cancel-page', 'uses' => 'CartController@cancel']);
    Route::get('cart/checkout', ['as' => 'checkout-page', 'uses' => 'CartController@checkout']);

	// Personal notice
	Route::get("personal-notice", ["as" => "personal-notice-page", "uses" => "HomeController@personalNotice"]);
	Route::get("personal-notice/view/{id}", ["as" => "personal-notice-page", "uses" => "HomeController@personalNoticeView"]);

	//Upload image
	Route::post('upload', array('as' => 'upload-pro-pic', 'uses'	=> 'ProfileController@upload'));

    Route::group(['before'=>'csrf'], function() {
        // Cart
        Route::post('products/add-to-cart', ['as'=>'add-to-cart','uses'=>'CartController@add']);
		Route::post('cart/update', ['as' => 'user-cart-update', 'uses' => 'CartController@updateCart']);
	    Route::post('cart/delete', ['as' => 'user-cart-delete', 'uses' => 'CartController@deleteCart']);

	    // Rechage point
	    Route::post("account/recharge", ["uses"=>"UserController@recharge"]);

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
	Route::get("products/delete/{slug}", ["as" => "delete-product", "uses" => "ProductController@deleteProduct"]);
    // Find subcatagory
    Route::post("products/add/find_subcatagory", ["uses" => "SubcatagoryController@findSubcatagory"]);

	// Catagory
	Route::get('catagory/add', array('as'	=> 'add-catagory-page', 'uses'	=> 'ProductController@addCatagoryPage'));
    Route::get('catagory/edit_catagory/{slug}', array('as'	=> 'edit-catagory-page', 'uses'	=> 'ProductController@editCatagoryPage'));

    // Sub catagory
    Route::get('subcatagory/add', array('uses'	=> 'SubcatagoryController@add')); //
	Route::get('subcatagory/edit/{slug}', array('uses'	=> 'SubcatagoryController@edit'));

	// User Management
	Route::get("dashboard/usermanagement", ["as" => "user-management-page", "uses" => "UserManagement@userManagementPage"]);
	Route::get('dashboard/user/{slug}', array('as' => 'user-view', 'uses' => 'UserManagement@viewUser'));
	Route::get('dashboard/user/activate/{slug}', array('as' => 'user-active', 'uses' => 'UserManagement@activeUser'));
	Route::get('dashboard/user/deactivate/{slug}', array('as' => 'user-deactive', 'uses' => 'UserManagement@deactiveUser'));

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

	// Notice
	Route::controller("dashboard/notice", "NoticeController");

	// Content Image
	Route::post('dashboard/contentImage', array('as'=>'content-image', 'uses'=>'ContentManagement@upload'));
	Route::post('dashboard/edit-content/updateContentImage', array('as'=>'update-content-image', 'uses'=>'ContentManagement@updateUpload'));

	// Post
	Route::group(["before" => "csrf"], function() {
        // Products
        Route::post('dashboard/addProduct', ['as' => 'product-store', 'uses' => 'ProductController@addProduct']);
        Route::post('dashboard/editProduct/{slug}', ['as' => 'update-product', 'uses' => 'ProductController@editProduct']);

		// Catagory
		Route::post("catagory/addCatagory", ["uses" => "ProductController@addCatagory"]);
		Route::post("catagory/edit-catagory/{slug}", ["uses" => "ProductController@updateCatagory"]);
		Route::post("catagory/delete_catagory/{id}", ["as" => "delete-catagory", "uses" => "ProductController@deleteCatagory"]);

        // Sub Catagory
        Route::post("subcatagory/store", ["uses" => "SubcatagoryController@store"]);
        Route::post("subcatagory/update/{slug}", ["uses" => "SubcatagoryController@update"]);
        Route::post("subcatagory/destroy/{slug}", ["uses" => "SubcatagoryController@destroy"]);

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

	// Ajax
	Route::post("dashboard/finduser", function()
	{
		$notice = Input::get('notice_id');
		$user = Input::get("id");

		$find = NoticeUserAssociate::where("notice_id", $notice)->where("user_id", $user);

		if($find->count() > 0)
		{
			$find->delete();
		}
		else
		{
			$create = new NoticeUserAssociate;
			$create->notice_id = $notice;
			$create->user_id = $user;

			$create->save();
		}
	});

});

App::missing(function($exception)
{
	return Response::view("Main.404",[] , 404);
});
