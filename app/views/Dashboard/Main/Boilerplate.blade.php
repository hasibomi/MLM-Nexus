<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		@yield("title")
		<link href="<?php echo asset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset('assets/css/prettyPhoto.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset('assets/css/price-range.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset('assets/css/animate.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset('assets/css/main.css'); ?>" rel="stylesheet">
		<link href="<?php echo asset('assets/css/responsive.css'); ?>" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="<?php echo asset('js/html5shiv.js'); ?>"></script>
		<script src="<?php echo asset('js/respond.min.js'); ?>"></script>
		<![endif]-->
		<link rel="shortcut icon" href="images/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('assets/images/ico/apple-touch-icon-144-precomposed.png'); ?>">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo asset('assets/images/ico/apple-touch-icon-114-precomposed.png'); ?>">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo asset('assets/images/ico/apple-touch-icon-72-precomposed.png'); ?>">
		<link rel="apple-touch-icon-precomposed" href="<?php echo asset('assets/images/ico/apple-touch-icon-57-precomposed.png'); ?>">
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
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.nexusitzone.com"><img src="<?php echo asset('assets/images/logo/nexus.png');?>" width="100" height="20" alt="" /></a></span></p>
				</div>
			</div>
		</div>
		
		</footer><!--/Footer-->
		
		<script src="<?php echo asset('assets/js/jquery.js'); ?>"></script>
		<script src="<?php echo asset('assets/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo asset('assets/js/jquery.scrollUp.min.js'); ?>"></script>
		<script src="<?php echo asset('assets/js/price-range.js'); ?>"></script>
		<script src="<?php echo asset('assets/js/jquery.prettyPhoto.js'); ?>"></script>
		<script src="<?php echo asset('assets/js/main.js'); ?>"></script>
		<script src="<?= asset('assets/js/user/account.js')?>"></script>
		
		@yield('script')
	</body>
</html>