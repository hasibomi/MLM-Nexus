<?php
$base = Request::path();

$title = "";
$home = "";
$shop = "";
$contact = "";
$login = "";
$productMenu = "";

if ($base == '/') {
	$home = 'active';
	$title = 'Home';
} else if ($base == 'shop') {
	$shop = 'active';
	$productMenu = 'active';
	$title = 'Products';
} else if ($base == 'login') {
	$login = 'active';
	$title = 'Login';
} else if ($base == 'contact-us') {
	$contact = 'active';
	$title = 'Contact Us';
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
								<li><a href="#"><i class="fa fa-phone"></i> +880 1615 888920</a></li>
								<li><a href="mailto:info@nexusitzone.com"><i class="fa fa-envelope"></i> info@nexusitzone.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="http://www.facebook.com/NexusItzone"><i class="fa fa-facebook"></i></a></li>
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
							<a href="/"><img src="<?php echo asset('images/logo/nexus.png');?>" width="139" height="39" alt="Logo" /></a>
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
								<?php
								if (Auth::check()) {
								?>
								<li><a href="logout"><i class="fa fa-lock"></i> Logout</a></li>
								<?php
								} else {
								?>
								<li><a href="login" class="<?= $login; ?>"><i class="fa fa-lock"></i> Login</a></li>
								<?php
								}
								?>
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
								<li><a href="/" class="<?= $home; ?>">Home</a></li>
								<li class="dropdown"><a href="#" class="<?= $productMenu; ?>">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop" class="<?= $shop; ?>">Products</a></li>
                                    </ul>
                                </li>
								<li><a href="contact-us" class="<?= $contact; ?>">Contact</a></li>
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