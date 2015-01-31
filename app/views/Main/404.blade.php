<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>We are lost!</title>
    <link href="<?php echo asset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/prettyPhoto.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/price-range.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/main.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/responsive.css'); ?>" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?php echo asset('assets/js/html5shiv.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/respond.min.js'); ?>"></script>
    <![endif]-->       

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('assets/images/ico/apple-touch-icon-144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo asset('assets/images/ico/apple-touch-icon-114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo asset('assets/images/ico/apple-touch-icon-72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo asset('assets/images/ico/apple-touch-icon-57-precomposed.png'); ?>">
</head><!--/head-->

<body>
	<div class="container text-center">
		<div class="logo-404">
			<a href="{{ url('/') }}">{{ HTML::image("assets/images/logo/nexus.png") }}</a>
		</div>
		<div class="content-404">
            {{ HTML::image("assets/images/404/404.png", "404", ["class" => "img-responsive"]) }}
			<h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
			<p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
			<h2><a href="{{ url('/') }}">Bring me back Home</a></h2>
		</div>
	</div>

  
    <script src="<?php echo asset('assetsjs/jquery.js'); ?>"></script>
    <script src="<?php echo asset('assetsjs/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset('assetsjs/jquery.scrollUp.min.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/price-range.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/jquery.prettyPhoto.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/main.js'); ?>"></script>
    <script src="<?= asset('assets/js/user/account.js')?>"></script>
</body>
</html>