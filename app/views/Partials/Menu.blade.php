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
							<a href="{{ url("/") }}"><img src="<?php echo asset('assets/images/logo/nexus.png');?>" width="139" height="39" alt="" /></a>
						</div>
					</div>

					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@if (Auth::user() && Auth::user()->type == "member")
									<li>
										<a href="{{ url("account") }}" class="{{ Request::path() == 'account' ? 'active' : '' }}">
											<?php
											$picture = User::select('name')->where('id', '=', Auth::id());
											?>
											<i class="fa fa-user"></i> {{ $picture->first()->name }}
										</a>
									</li>
									<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
									<li><a href="{{ url("checkout") }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
									<li class="{{ Request::path() == 'cart' ? 'active' : '' }}"><a href="{{ url("cart") }}" class="{{ Request::path() == 'cart' ? 'active' : '' }}"><i class="fa fa-shopping-cart"></i> Cart (<?php $cart = Cart::where('user_id', '=', Auth::user()->id)->where('checked_out', '0')->get(); echo count($cart); ?>)</a></li>
									<li><a href="{{ url("logout") }}"><i class="fa fa-lock"></i> Logout</a></li>
								@elseif(Auth::user() && Auth::user()->type == "admin")
									<li>
										<a href="{{ url("account") }}" class="{{ Request::path() == 'account' ? 'active' : '' }}">
											<?php
											$picture = User::select('name')->where('id', '=', Auth::id());
											?>
											<i class="fa fa-user"></i> {{ $picture->first()->name }}
										</a>
									</li>
									<li><a href="{{ url("logout") }}"><i class="fa fa-lock"></i> Logout</a></li>
								@else
                                <li><a href="{{ url("login") }}" class="{{ Request::path() == 'login' ? 'active': '' }}"><i class="fa fa-lock"></i> Login <small>or </small>Signup</a></li>
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
					<div @if(Admin::isAdmin()) class="col-sm-7" @else class="col-sm-8" @endif>
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
								<li><a href="{{ url("/") }}" class="{{ Request::path() == '/' ? 'active' : '' }}">Home</a></li>
								<li class="dropdown"><a href="#" class="{{ Request::path() == 'shop' ? 'active' : Request::is('products/*') ? 'active' : Request::is('subcatagory/*') ? 'active' : Request::is('catagory/*') ? 'active' : '' }}">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url("shop") }}" class="{{ Request::path() == 'shop' ? 'active' : Request::is('products/*') ? 'active' : Request::is('subcatagory/*') ? 'active' : Request::is('catagory/*') ? 'active' : '' }}">Products</a></li>
                                    </ul>
                                </li>

								<li><a href="{{ url("contact-us") }}" class="{{ Request::path() == 'contact-us' ? 'active' : '' }}">Contact</a></li>
								<li><a href="{{ url("notice") }}" class="{{ Request::path() == "notice" ? "active" : Request::is("notice/*") ? "active" : "" }}">Notice</a></li>
								@if(Auth::user())
									<li><a href="{{ url('personal-notice') }}" class="{{ Request::path() == "personal-notice" ? "active" : Request::is("personal-notice/*") ? "active" : "" }}">Personal Notice</a></li>
								@endif
							</ul>
                            @if(Admin::isAdmin())
                                <div class="col-md-1">
                                    <a href="{{ url("dashboard") }}" class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                                    </a>
                                </div>
                            @endif
						</div>
					</div>

					<div class="col-sm-3 pull-right">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>

				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->