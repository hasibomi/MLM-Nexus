<?php
$base = Request::path();

$title = "";
$home = "";
$shop = "";
$contact = "";
$login = "";
$productMenu = "";
$account = "";
$cart = "";

if ($base == 'user') {
	$home = 'active';
	$title = 'Home';
} else if ($base == 'user/shop') {
	$shop = 'active';
	$productMenu = 'active';
	$title = 'Products';
} else if ($base == 'login') {
	$login = 'active';
	$title = 'Login';
} else if ($base == 'user/contact-us') {
	$contact = 'active';
	$title = 'Contact Us';
} else if ($base == 'user/products/view/{id}') {
    $shop = "active";
    $productMenu = "active";
    $title = "Products";
} else if ($base == 'user/account') {
    $title = 'User account';
    $account = 'active';
} else if ($base == 'user/cart') {
    $title = 'Shipping cart';
    $cart = 'active';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ $title }}</title>
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
	@include("Partials.Menu") 
	
	@yield('content')
	
	<footer id="footer"><!--Footer-->		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2014 <a href="http://www.nexusitzone.com">NEXUS IT ZONE</a>. All rights reserved.</p>
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
