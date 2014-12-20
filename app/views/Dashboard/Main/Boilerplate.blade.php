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
$content_management = '';
$slider = '';
$order = '';

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
} else if ( $base == 'admin/manage-content' ) {
	$content_management = 'active';
	$title = 'Content Management';
} else if ($base == 'admin/slider') {
    $slider = 'active';
    $content_management = 'active';
    $title = 'Slider';
} else if ($base == 'admin/order') {
	$order = 'active';
	$title = 'Order Process';
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

    @yield('css')
    
</head><!--/head-->

<body>
	@include("Dashboard.Partials.Menu")
	
	@yield('content')
	
	<footer id="footer"><!--Footer-->
		
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
    
    @yield('script')
    
</body>
</html>
