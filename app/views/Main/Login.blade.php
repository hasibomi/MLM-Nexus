@extends("Main.Boilerplate")

@section("content")

	<div class="container">
		@if (Session::has('event'))
			{{ Session::get('event') }}
		@endif
		
		@if (Session::has('referal_error'))
			<div class="alert alert-danger">
				{{ Session::get('referal_error') }}
			</div>
		@endif
		
		@if (Session::has('signup_error'))
			<div class="alert alert-danger">
				{{ Session::get('signup_error') }}
			</div>
		@endif
		
		@if (Session::has('login_failed'))
			<div class="alert alert-danger">
				{{ Session::get('login_failed') }}
			</div>
		@endif
		
		@if (Session::has('signup_success'))
			<div class="alert alert-success">
				{{ Session::get('signup_success') }}
			</div>
		@endif
		
		@if (Session::has('unauthorised'))
			<div class="alert alert-danger">
				{{ Session::get('unauthorised') }}
			</div>
		@endif
		
		@if (Session::has('logout'))
			<div class="alert alert-warning">
				{{ Session::get('logout') }}
			</div>
		@endif
	</div>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						{{ Form::open(array('url' => 'login')) }}
							{{ Form::email('login_email', $value = e(Input::old('login_email')), $attributes = ['placeholder' => 'Email Address']) }}
							@if ($errors->has('login_email'))
								{{ $errors->first('login_email', '<p class="alert alert-danger">The email field is required</p>') }}
							@endif
							{{ Form::password('login_password', $attributes = ['placeholder' => 'Password']) }}
							@if ($errors->has('login_password'))
								{{ $errors->first('login_password', '<p class="alert alert-danger">The password field is required</p>') }}								
							@endif
							<button type="submit" class="btn btn-default">Login</button>
						{{ Form::close(); }}
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						{{Form::open(array('url' => 'signup'))}}
                            {{ Form::label("name", "Name") }}
							{{ Form::text('name', $value=Input::old('name'), $attributes = ['placeholder' => 'Name', 'required' => 'required']) }}
							@if($errors->has('name'))
								{{ $errors->first('name') }}
							@endif
                            
                            {{ Form::label("email", "Email") }}
							{{ Form::email('email', $value=Input::old('email'), $attributes = ['placeholder' => 'Email Address', 'required' => 'required']) }}
							@if ($errors->has('email'))
								{{ $errors->first('email') }}
							@endif
                            
                            {{ Form::label("password", "Password") }}
							{{ Form::password('password', $attributes = ['placeholder' => 'Password', 'required' => 'required']) }}
							@if ($errors->has('password'))
								{{ $errors->first('password') }}
							@endif
                            
                            {{ Form::label("confirm_password", "Confirm Password") }}
							{{ Form::password('confirm_password', $attributes = ['placeholder' => 'Confirm Password', 'required' => 'required']) }}
							@if ($errors->has('confirm_password'))
								{{ $errors->first('confirm_password') }}
							@endif
							
                            {{ Form::label("gender", "Gender") }}
							<select name="gender">
								<option>Male</option>
								<option>Female</option>
							</select>
							<br />
							<br />
							<p>Date of birth</p>
							<div class="col-md-4">
								<select name="date">
									<option>Date</option>
									@for($i = 1; $i <= 31; $i++)
										<option>{{ $i }}</option>
									@endfor
								</select>
							</div>
							<div class="col-md-4">
								<select name="month">
									<option>Month</option>
									@for($i = 1; $i <= 12; $i++)
										<option>{{ $i }}</option>
									@endfor
								</select>
							</div>
							<div class="col-md-4">
								<select name="year">
									<option>Year</option>
									@for($i = 1900; $i <= 2050; $i++)
										<option>{{ $i }}</option>
									@endfor
								</select>
							</div>
							<br />
							<br />
                            
                            {{ Form::label("present_address", "Present Address") }}
							{{ Form::textarea('present_address', $value = Input::old("present_address"), $attributes = ['placeholder' => 'Present Address']) }}
                            @if($errors->has("present_address"))
                                {{ $errors->first("present_address") }}
                            @endif
							<br /><br />
                            
                            {{ Form::label("permanent_address", "Permanent Address") }}
                            {{ Form::textarea('permanent_address', $value = Input::old("permanent_address"), $attributes = ['placeholder' => 'Permanent Address']) }}
                            @if($errors->has("permanent_address"))
                                {{ $errors->first("permanent_address") }}
                            @endif
							<br /><br />
                            
                            {{ Form::label("referal_id", "Referal ID") }}
							{{ Form::text('referal_id', $value = null, $attributes = ['placeholder' => 'Referal ID', 'id' => 'referal_id']) }}
                            <br />
                            
                            <div id="hand"></div>
                            
							<button type="submit" class="btn btn-default">Signup</button>
						{{ Form::close() }}
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@section("script") 
<script>
    $("#referal_id").keyup(function() {
        var referal_id = $(this).val(),
            $hand = $("#hand");
            
        if(referal_id != "") {
        
            $.ajax({
                url: "{{url('findRefer')}}",
                type: "POST",
                data: "referal_id=" + referal_id,
                success: function(data) {
                    $hand.html(data);
                }
            });
        } else {
            $hand.html("<div class='alert alert-danger'>Referal ID is required</div>");
        }
    });
</script>
@stop

@stop