@extends("Main.Boilerplate")

@section("title")
<title>Contact Us</title>
@stop

@section("content")

	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Get In Touch</strong></h2>
				</div>			 		
			</div>
			@if($errors->all())
				<div class="row">
					<div class="alert alert-danger">
						Error occured :
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
			
			@if(Session::has("event"))
				{{ Session::get("event") }}
			@endif
    		<div class="row">
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<div class="status alert alert-success" style="display: none"></div>
						<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{ url("submitContact") }}">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div> <!--/.contact-form-->
	    		</div> <!--/.col-sm-8-->
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				@if ($contact)

							<h2 class="title text-center">Contact Info</h2>

							@foreach ($contact as $row)
								
								<address>
									{{ $row->description }}
								</address>

							@endforeach

	    				@endif

	    				@if ($facebooks || $twitters || $googles)

	    				<div class="social-networks">
	    				
	    					<h2 class="title text-center">Social Networking</h2>

							<ul>
								@foreach ($facebooks as $facebook)
								<li>
									<a href="{{ $facebook->facebook }}"><i class="fa fa-facebook"></i></a>
								</li>
								@endforeach
							</ul>

							&nbsp;&nbsp;&nbsp;&nbsp;

							<ul>
								@foreach ($twitters as $twitter)
								<li>
									<a href="{{ $twitter->twitter }}"><i class="fa fa-twitter"></i></a>
								</li>
								@endforeach
							</ul>

							<ul>
								@foreach ($googles as $google)
								<li>
									<a href="{{ $google->google }}"><i class="fa fa-google"></i></a>
								</li>
								@endforeach
							</ul>

	    				</div>

	    				@endif

	    				
	    			</div>
    			</div> <!-- /.col-sm-4 -->
	    	</div> <!-- /.row -->

	    	<div class="row">
				@foreach (Content::where('call_name', '=', 'contact')->where('active', '=', 1)->get() as $content)
					{{ $content->title }}
					{{ $content->description }}
				@endforeach
			</div>

    	</div>	<!-- /.bg -->
    </div><!--/#contact-page.container-->
	
@stop