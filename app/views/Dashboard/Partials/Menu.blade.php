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
							<a href="/mlm/admin"><img src="<?php echo asset('images/logo/nexus.png');?>" width="139" height="39" alt="" /></a>
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
									<a href="{{ url("/") }}" target="_blank">
										<span class="glyphicon glyphicon-globe"></span>
										Back to <u>Main Site</u>
									</a>
								</li>
								<li>
									<a href="{{ url('dashboard/account') }}" class="{{ $account }}">
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
								<li><a href="{{ url('logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
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
                                <li><a href="{{ url('dashboard/usermanagement') }}" class="{{ $user_management }}">User Management</a>
                                </li>
								<li><a href="{{ url('dashboard/manage-content') }}" class="{{ $content_management }}">Manage Content</a></li>
								<li><a href="{{ url('dashboard/order') }}" class="{{ $order }}">Order</a></li>
								<li><a href="{{ url("dashboard/support") }}">Support</a></li>
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