<?php
$base = Request::path();

$title = "Product Details";
$home = "";
$account = "";
$shop = "";
$addProduct = '';
$productDetails = '';
$productMenu = '';
$catagory = '';
$view_catagory = '';
$product_catagory = '';
$edit_product = '';
$user_management = '';

if ($base == 'admin/account') {
	$account = 'active';
	$title = 'Account';
} else if ($base == 'admin') {
	$home = 'active';
	$title = 'Home';
} else if ($base == 'admin/shop') {
	$shop = 'active';
	$title = 'Products';
	$productMenu = 'active';
} else if ($base == 'admin/add-product') {
	$addProduct = 'active';
	$title = 'Add product';
	$productMenu = 'active';
} else if ($base == 'admin/product-details') {
	$productDetails = 'active';
	$title = 'Product Details';
	$productMenu = 'active';
} else if ($base == 'admin/catagory') {
	$catagory = 'active';
	$product_catagory = 'active';
	$title = 'Catagory';
} else if ($base == 'admin/view-catagory') {
	$view_catagory = 'active';
	$product_catagory = 'active';
} else if ($base == 'admin/edit-product') {
	$edit_product = 'active';
	$product_catagory = 'active';
	$title = 'Edit Product';
} else if ( $base == 'admin/usermanagement' ) {
	$user_management = 'active';
	$title = 'User Management';
} else if ( $base == 'admin/user/{id}' ) {
	$user_management = 'active';
	$title = 'User Management';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <link href="<?php echo asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('css/prettyPhoto.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('css/price-range.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('css/animate.css'); ?>" rel="stylesheet">
	<link href="<?php echo asset('css/main.css'); ?>" rel="stylesheet">
	<link href="<?php echo asset('css/responsive.css'); ?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo asset('js/html5shiv.js'); ?>"></script>
    <script src="<?php echo asset('js/respond.min.js'); ?>"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('images/ico/apple-touch-icon-144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo asset('images/ico/apple-touch-icon-114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo asset('images/ico/apple-touch-icon-72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo asset('images/ico/apple-touch-icon-57-precomposed.png'); ?>">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +8801 615 888 920</a></li>
								<li><a href="mailto:info@nexusitzone.com"><i class="fa fa-envelope"></i> info@nexusitzone.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="http://www.facebook.com/NexusITzone" target="_blank"><i class="fa fa-facebook"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="/admin"><img src="<?php echo asset('images/logo/nexus.png');?>" width="139" height="39" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa">
									BANGLADESH
								</button>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa">
									TAKA
								</button>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li>
									<a href="/admin/account" class="{{ $account }}">
										<?php
										$admin = User::select('profile_picture', 'name')->where('id', '=', Auth::id())->get();
										?>
										@if ($admin->first()->proflie_picture == "")
											<i class="fa fa-user"></i> {{ $admin->first()->name }}
										@else
											<div class="col-md-5">
												<img src="{{ asset('images/propic/' . $picture->first()->profile_picture) }}" width="45" class="img-responsive" alt="" />
											</div>
										@endif
									</a>
								</li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="/admin/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="/admin/cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								@if (Auth::check())
									<li><a href="/admin/logout"><i class="fa fa-lock"></i> Logout</a></li>
								@else
									<li><a href="/admin/login"><i class="fa fa-lock"></i> Login</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/admin" class="{{ $home }}">Home</a></li>
								<li class="dropdown"><a href="javascript:;" class="{{ $productMenu }}">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    	<li><a href="/admin/add-product" class="{{ $addProduct }}">Add Product</a></li>
                                        <li><a href="/admin/shop" class="{{ $shop }}">Products</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="javascript:;" class="{{ $product_catagory }}">Product Catagory<i class="fa fa-angle-down"></i></a>
                                	<ul class="sub-menu" role="menu">
                                		<li><a href="/admin/catagory" class="{{ $catagory }}">Add Catagory</a></li>
                                		<li><a href="/admin/view-catagory" class="{{ $view_catagory }}">View Catagory</a></li>
                                	</ul>
                                </li>
                                <li><a href="/admin/usermanagement" class="{{ $user_management }}">User Management</a>
                                </li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	@yield('content')
	
	<footer id="footer"><!--Footer-->
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Nexus</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2014 <a href="http://www.nexusitzone.com" target="_blank">NEXUS IT ZONE</a>. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.nexusitzone.com"><img src="<?php echo asset('images/logo/nexus.png');?>" width="100" height="20" alt="" /></a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="<?php echo asset('js/jquery.js'); ?>"></script>
	<script src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo asset('js/jquery.scrollUp.min.js'); ?>"></script>
	<script src="<?php echo asset('js/price-range.js'); ?>"></script>
    <script src="<?php echo asset('js/jquery.prettyPhoto.js'); ?>"></script>
    <script src="<?php echo asset('js/main.js'); ?>"></script>
    <script src="<?= asset('js/user/account.js')?>"></script>
    
    <script type="text/javascript">
        $(document).ready( function() {
        	$('.cart_quantity_delete').click( function(e) {
        		var con = confirm('Are you sure?');
        		
        		if (!con) {
        			e.preventDefault();
        		}
        	});
        });
    </script>
    
    @yield('script')
    
</body>
</html>
