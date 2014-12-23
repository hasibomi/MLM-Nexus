@extends("Main.Boilerplate")

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
								  <li class="active"><a href="#overview" role="tab" data-toggle="tab">Overview</a></li>
								  <li><a href="#childrenorder" role="tab" data-toggle="tab">Change member order</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="overview">
										<br />
										<div class="row">
											<div class="col-md-4"><label>Total member(s)</label></div>
											<div class="col-md-8">: {{ $total }}</div>
										</div>
										<div class="row">
											<div class="col-md-4"><label>Total ungrouped member(s)</label></div>
											<div class="col-md-8">: {{ $ungrouped->count() }}</div>
										</div>
										<div class="row">
											<div class="col-md-4"><label>Left hand side</label></div>
											<div class="col-md-8">: {{ $left }}</div>
										</div>
										<div class="row">
											<div class="col-md-4"><label>Right hand side</label></div>
											<div class="col-md-8">: {{ $right }}</div>
										</div>
									</div>
									<div class="tab-pane fade" id="childrenorder">
										<br />
										<div class="col-md-4">
											<div class="panel panel-success">
												<div class="panel-heading">
													LEFT HAND SIDE
												</div>
												<div class="panel-body">
													@if ($left_member->count() == 0)
														<p>No member(s) found</p>
													@else
														@foreach ($left_member as $left_side)
															<p>{{ $left_side->name }}</p>
														@endforeach
													@endif
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="panel panel-success">
												<div class="panel-heading">
													UNGROUPED MEMBER(S)
												</div>
												<div class="panel-body">
													@if ($ungrouped->count() == 0)
														<p>No member(s) found</p>
													@else
														@foreach ($ungrouped as $ungroup)
															{{ Form::token() }}
															<div class="row">
																<div class="col-md-3">
																	<a class="glyphicon glyphicon-hand-left" id="{{ $ungroup->id }}" href="javascript:;"> Left</a>
																</div>
																<div class="col-md-6" id="{{ $ungroup->id }}">{{ $ungroup->name }}</div>
																<div class="col-md-2">
																	<a class="glyphicon glyphicon-hand-right" id="{{ $ungroup->id }}" href="javascript:;"> Right</a>
																</div>
															</div>
															<br />
														@endforeach
													@endif
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="panel panel-success">
												<div class="panel-heading">
													RIGHT HAND SIDE
												</div>
												<div class="panel-body">
													@if ($right_member->count() == 0)
														<p>No member(s) found</p>
													@else
														@foreach ($right_member as $right_side)
															<p>{{ $right_side->name }}</p>
														@endforeach
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							  </div>
							  <!-- /#home -->
						  
							  <div class="tab-pane fade" id="profile">
							  	<?php
							  	$select_profile = User::where('id', '=', Auth::id());
							  	?>
							  	@if ($select_profile->first()->profile_picture == "")
							  		<p>No profile image</p>
							  	@else
							  		<div class="col-md-3">
							  			<div class="row">
							  				<img src="{{ asset('images/propic/' . $select_profile->first()->profile_picture) }}" width="200" class="img-responsive" alt="" />
							  			</div>
							  			<div class="row">
							  				<h4><i>{{ $select_profile->first()->designation }}</i></h4>
							  			</div>
							  			<div class="row">
							  				@if ($select_profile->first()->point == "")
							  					<i><font color="red">No points</font></i>
							  				@else
							  					<i><font color="green">{{ $select_profile->first()->point }} points</font></i>
							  				@endif
							  			</div>
							  		</div>
							  	@endif
							  	
							  	<div class="col-md-9">
							  		<div class="row">
							  			<div class="col-md-3">
							  				<label>Name</label>
							  			</div>
							  			<div class="col-md-9">
							  				: {{ $select_profile->first()->name }}
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-md-3">
							  				<label>Date of birth</label>
							  			</div>
							  			<div class="col-md-9">
							  				: {{ $select_profile->first()->date_of_birth }}/{{ $select_profile->first()->month_of_birth }}/{{ $select_profile->first()->year_of_birth }}
							  			</div>
							  		</div>
							  		<div class="row">
							  			<div class="col-md-3">
							  				<label>Address</label>
							  			</div>
							  			<div class="col-md-9">
							  				: {{ $select_profile->first()->address }}
							  			</div>
							  		</div>
									<div class="row">
										<div class="col-md-3"><label>Referral ID</label></div>
										<div class="col-md-9">
											<a href="{{ url("#referalModal") }}" data-toggle="modal" data-target="#referalModal">
												{{ $select_profile->first()->id }} - <u>Refer a friend</u>
											</a>
										</div>
									</div>
							  	</div>
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
										{{ Form::open(array('url' => 'upload', 'files' => true)) }}
								  			{{ Form::file('propic') }}
								  			<br />
								  			{{ Form::submit('Upload', $attributes = ['class' => 'btn btn-success btn-sm']) }}
								  		{{ Form::close() }}
									</div>
									<!-- /#updateinfo -->
									<div class="tab-pane fade" id="rechage">
										<br />
										
										{{ Form::open(array('url' => '/recharge')) }}
											<div class="form-group">
												<div class="row">
													<div class="col-md-offset-2">
														<label>Type the card number</label>
													</div>
												</div>
												<div class="row">
													<div class="row col-md-8 col-md-offset-2">
														{{ Form::text('recharge', $value = null, $attributes = ['placeholder' => 'Type here', 'class' => 'form-control']) }}
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-8">
													<div class="row">
														{{ Form::submit('Recharge', $attributes = ['class' => 'btn btn-success btn-md btn-block']) }}
													</div>
												</div>
											</div>
										{{ Form::close() }}
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
		
		@include("Users.Partials.ReferalModal")
	
	</div>
	<!-- /.container -->

@stop
