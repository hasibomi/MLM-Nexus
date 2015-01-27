@extends("Main.Boilerplate")

@section("title") <title> {{  Auth::user()->name }} - Account</title> @stop

@section("content")
<div class="container">
	
	@if (Session::has('event'))
		{{ Session::get('event') }}
	@endif
	
	@if($errors->all())
	<div class="alert alert-danger">
		Error occured:
		<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	
	<div class="panel panel-primary">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<div class="col-md-3">
				<div class="panel panel-info">
					<div class="panel-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs nav-stacked" role="tablist">
							<li class="active"><a href="#home" role="tab" data-toggle="tab">Manage member</a></li>
							<li><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
							<li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-md-9">
				<div class="panel panel-info">
					<div class="panel-body">
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane fade in active" id="home">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#childrenorder" role="tab" data-toggle="tab">Overview</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="childrenorder">
										<br />
										@include("Users.Partials.ManageMember")
									</div>
								</div>
							</div>
							<!-- /#home -->
							
							<div class="tab-pane fade" id="profile">
								@include("Users.Partials.Profile")
							</div>
							<!-- /#profile -->
							
							<div class="tab-pane fade" id="settings">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#updateinfo" role="tab" data-toggle="tab">Change profile picture</a></li>
									<li><a href="#rechage" role="tab" data-toggle="tab">Recharge point</a></li>
								</ul>
								
								<div class="tab-content">
									<div class="tab-pane fade in active" id="updateinfo">
										<br />
										@include("Users.Partials.UpdateInfo")
									</div>
									<!-- /#updateinfo -->
									<div class="tab-pane fade" id="rechage">
										<br />
										
										@include("Users.Partials.Recharge")
									</div>
									<!-- /#recharge -->
								</div>
								<!-- /.tab-content -->
							</div>
							<!-- /#settings -->
						</div>
						<!-- /.tab-content -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel.panel-info -->
			</div>
			<!-- /.col-md-9 -->
		</div>
		<!-- /.panel-body -->
	</div>
	<!-- /.panel.panel-primary -->
</div>
<!-- /.container -->
@stop