<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>We are lost!</title>
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
	<div class="container text-center">
		<div class="logo-404">
			<a href="{{ url('/') }}">{{ HTML::image("images/logo/nexus.png") }}</a>
		</div>
		<div class="content-404">
            {{ HTML::image("images/404/404.png", "404", ["class" => "img-responsive"]) }}
			<h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
			<p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
			<h2><a href="{{ url('/') }}">Bring me back Home</a></h2>
		</div>
	</div>

  
    <script src="<?php echo asset('js/jquery.js'); ?>"></script>
    <script src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset('js/jquery.scrollUp.min.js'); ?>"></script>
    <script src="<?php echo asset('js/price-range.js'); ?>"></script>
    <script src="<?php echo asset('js/jquery.prettyPhoto.js'); ?>"></script>
    <script src="<?php echo asset('js/main.js'); ?>"></script>
    <script src="<?= asset('js/user/account.js')?>"></script>
</body>
</html>