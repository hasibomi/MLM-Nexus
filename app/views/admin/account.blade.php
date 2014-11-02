@extends('admin.layouts.main')

@section('content')

	<div class="container">
		
		@if (Session::has('event'))
			{{ Session::get('event') }}
		@endif
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				Profile
			</div>
			<div class="panel-body">
				<div class="col-md-3">
					<div class="panel panel-info">
						<div class="panel-body">
							<ul class="nav nav-tabs nav-stacked" role="tablist">
								<li class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
								<li><a href="#recharge" role="tab" data-toggle="tab">Recharge</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-info">
						<div class="panel-body">					
							<div class="tab-content">
								<div class="tab-pane fade in active" id="profile">
									<ul class="nav nav-tabs" roe="tablist">
										<li class="active"><a href="#personal" role="tab" data-toggle="tab">Personal</a></li>
										<li><a href="#organizational" role="tab" data-toggle="tab">Organizational</a></li>
									</ul>
									
									<div class="tab-content">
										<br />
										
										<div class="tab-pane fade in active" id="personal">
											<div class="row">
												<div class="col-md-4">
													@if ($admin->first()->profile_picture == "")
														@if ($admin->first()->gender == "Male")
															<img src="{{ asset('images/propic/male.png') }}" alt="" />
														@else
															<img src="{{ asset('images/propic/female.png') }}" alt="" />
														@endif
													@else
														<img src="{{ asset('images/propic/'.$admin->first()->profile_picture) }}" alt="" />
													@endif
												</div>
												<div class="col-md-8">
													<div class="row">
														<div class="col-md-4">
															<label>Name</label>
														</div>
														<div class="col-md-8">
															: {{ $admin->first()->name }}
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<label>Email Address</label>
														</div>
														<div class="col-md-8">
															: {{ $admin->first()->email }}
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<label>Gender</label>
														</div>
														<div class="col-md-8">
															: {{ $admin->first()->gender }}
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<label>Date of birth</label>
														</div>
														<div class="col-md-8">
															: {{ $admin->first()->date_of_birth }}/{{ $admin->first()->month_of_birth }}/{{ $admin->first()->year_of_birth }}
														</div>
													</div>
													<div class="row">
														<div class="col-md-4">
															<label>Address</label>
														</div>
														<div class="col-md-8">
															@if ($admin->first()->address != "")
																: {{ $admin->first()->address }}
															@else
																: No address
															@endif
														</div>
													</div>
													<div class="row">
														<div class="col-md-8">
															<a href="/mlm/admin/password" class="btn btn-success btn-block">Change password</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /#personal -->
										<div class="tab-pane fade" id="organizational">
											<div class="row">
												<div class="col-md-2"><label>Designation</label></div>
												<div class="col-md-10"> : <i>Admin</i></div>
											</div>
											<div class="row">
												<div class="col-md-2"><label>Points</label></div>
												<div class="col-md-10"> : @if ($admin->first()->point=="") No points @else {{ $admin->first()->point }} @endif</div>
											</div>
											<div class="row">
												<div class="col-md-2"><label>Referal ID</label></div>
												<div class="col-md-10"> : <a href="javascript:;">{{ $admin->first()->id }}</a></div>
											</div>
											<div class="row">
												<div class="col-md-2"><label>Referal Link</label></div>
												<div class="col-md-10">: <a href="javascript:;">{{ URL::Route('login').'/'.$admin->first()->id }}</a></div>
											</div>
										</div>
										<!-- /#organizational -->
									</div>
									<!-- /.tab-content 2 -->
								</div>
								<!-- /#profile -->
								<div class="tab-pane fade" id="recharge">
									{{ Form::open(array('url' => 'recharge')) }}
										<div class="form-group">
											<div class="row">
												<div class="col-md-10 col-md-offset-1">
													{{ Form::text('code', $value = null, $attributes = ['class' => 'form-control', 'placeholder' => 'Type code here'])}}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-10 col-md-offset-1">
													{{ Form::submit('Recharge', $attributes = ['class' => 'btn btn-success btn-block']) }}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
								<!-- /#recharge -->
							</div>
							<!-- /.tab-content (MAIN) -->
						</div>
						<!-- /.panel-body 2 -->
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
