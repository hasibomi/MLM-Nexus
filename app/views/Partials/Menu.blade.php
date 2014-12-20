	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="callto:+880 1615 888920"><i class="fa fa-phone"></i> +880 1615 888920</a></li>
								<li><a href="mailto:hasibomi@hasibomi.com"><i class="fa fa-envelope"></i> info@nexusitzone.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
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
							<a href="/mlm/"><img src="<?php echo asset('images/logo/nexus.png');?>" width="139" height="39" alt="" /></a>
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
								@if (Auth::user() && Auth::user()->type == "member")
									<li>
										<a href="/mlm/account" class="{{ $account }}">
											<?php
											$picture = User::select('profile_picture', 'name')->where('id', '=', Auth::id());
											?>
											<i class="fa fa-user"></i> {{ $picture->first()->name }}
										</a>
									</li>
									<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
									<li><a href="/mlm/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
									<li class="{{ $cart }}"><a href="/mlm/cart" class="{{ $cart }}"><i class="fa fa-shopping-cart"></i> Cart (<?php $cart = Cart::where('user_id', '=', Auth::user()->id)->where('checked_out', '0')->get(); echo count($cart); ?>)</a></li>
								
									<li><a href="/mlm/logout"><i class="fa fa-lock"></i> Logout</a></li>
								@elseif(Auth::user() && Auth::user()->type == "admin")
									<li><a href="/mlm/logout"><i class="fa fa-lock"></i> Logout</a></li>
								@else
									<li><a href="/mlm/login"><i class="fa fa-lock"></i> Login</a></li>
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
					<div class="col-sm-7">
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
								<li><a href="/mlm/" class="<?= $home; ?>">Home</a></li>
								<li class="dropdown"><a href="#" class="<?= $productMenu; ?>">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/mlm/shop" class="<?= $shop; ?>">Products</a></li>
                                    </ul>
                                </li>
								<li><a href="/mlm/contact-us" class="<?= $contact; ?>">Contact</a></li>
								
							</ul>
						</div>
					</div>
					@if(Admin::isAdmin())
						<div class="col-md-2 pull-right">
							<a href="{{ url("dashboard") }}" class="btn btn-success">
								<span class="glyphicon glyphicon-dashboard"></span> Dashboard
							</a>
						</div>
					@endif
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->