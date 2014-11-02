@extends('admin.layouts.login')

@section('content')

	<div class="container">
		@if (Session::has('event'))
			{{ Session::get('event') }}
		@endif
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-offset-2">
				<div class="login-form"><!--login form-->
					<h2>Admin login</h2>
					{{ Form::open(array('url' => '/admin/login')) }}
						{{ Form::email('email', $value = e(Input::old('email')), $attributes = ['placeholder' => 'Email Address']) }}
						@if ($errors->has('email'))
							{{ $errors->first('email', '<p class="alert alert-danger">The email field is required</p>') }}
						@endif
						{{ Form::password('password', $attributes = ['placeholder' => 'Password']) }}
						@if ($errors->has('password'))
							{{ $errors->first('password', '<p class="alert alert-danger">The password field is required</p>') }}								
						@endif
						<button type="submit" class="btn btn-default btn-block btn-lg">Login</button>
					{{ Form::close(); }}
				</div><!--/login form-->
			</div>
		</div>
	</div>
	
	<br />
	<br />

@stop