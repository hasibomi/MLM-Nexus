@extends("Main.Boilerplate")

@section("title")
<title>Login</title>
@stop

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
				<div class="col-sm-5">
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

                        <br/>

                        <!-- password recovery -->
                        <a href="account/recovery">Forgot password?</a>
					</div><!--/login form-->
				</div>

				<div class="col-sm-5 pull-right">
					<div class="signup-form"><!--sign up form-->
                        <h3 style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, facere, ut. Corporis cum cupiditate error exercitationem nam necessitatibus provident ratione saepe? Animi architecto dicta dolores error id in iure iusto maxime molestias praesentium provident quae quaerat quam sit tempore, ut voluptatem. A aliquid excepturi nulla possimus praesentium repudiandae saepe tenetur.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signupModal">
                            Signup
                        </button>
                        @include('Main.Partials.SignupModal')
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