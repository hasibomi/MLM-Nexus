@extends('Dashboard.Main.Boilerplate')

@section('title')
    <title>{{ $user->first()->name }}</title>
@stop

@section ('content')
	
    <section>
    	
        <div class="container">
			
			@if ( Session::has('event') )
				{{ Session::get( 'event' ) }}
			@endif
        	
            <div class="row">
            
            	<div class="col-sm-12 padding-right">
                	<div class="product-details">
                    	<div class="col-sm-5">
							<div class="view-product">
								<div class="row">
									<img src="{{ asset($user->first()->profile_picture == '' ? 'assets/images/propic/male.png' : $user->first()->profile_picture) }}" alt="" />
								</div>
							</div>
						</div>
                        <!-- /.col-sm-5 -->
                        <div class="col-sm-7">
                        	<div class="product-information">
								<div class="row">
									<h1>{{ $point = $user->first()->points->sum("point") == 0 ? "0 point" : $user->first()->points->sum("point")  }} | {{ $user->first()->amounts->sum("amount") == 0 ? "৳ 0" : "৳ " . $user->first()->amounts->sum("amount")  }}</h1>
								</div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h1>ID</h1>
                                    </div>
                                    <div class="col-md-9">
                                        <h1>: {{ $user->first()->id }}</h1>
                                    </div>
                                </div>
                            	<div class="row">
                                	<div class="col-md-3">
                                    	<label>Name</label>
                                    </div>
                                    <div class="col-md-9">
                                    	: {{ $user->first()->name }}
                                    </div>
                                </div>
								<div class="row">
									<div class="col-md-3">
										<label>Gender</label>
									</div>
									<div class="col-md-9">
										: {{ $user->first()->gender }}
									</div>
								</div>
                                <div class="row">
                                	<div class="col-md-3">
                                		<label>Designation</label>
                                	</div>
                                	<div class="col-md-9"> : {{ $user->first()->designation }}</div>
                                </div>
                                <div class="row">
                                	<div class="col-md-3">
                                		<label>Date of birth</label>
                                	</div>
                                	<div class="col-md-9">
                                		: {{ $user->first()->date_of_birth . '/' . $user->first()->month_of_birth . '/' . $user->first()->year_of_birth }}
                                	</div>
                                </div>
                                <div class="row">
                                	<div class="col-md-3">
                                		<label>Permanent Address</label>
                                	</div>
                                	<div class="col-md-9">
                                		: {{ $user->first()->permanent_address }}
                                	</div>
                                </div>
								<div class="row">
									<div class="col-md-3">
										<label>Present Address</label>
									</div>
									<div class="col-md-9">
										: {{ $user->first()->present_address }}
									</div>
								</div>
                                <div class="row"><br></div>
                                <div class="row">
                                   <div class="col-md-3">
                                        @if ($user->first()->active == 1)
                                            <a class="id btn btn-danger" href="{{ url("dashboard/user/deactivate/" . $user->first()->slug) }}"><i class="glyphicon glyphicon-remove"></i> Deactivate</a>
                                        @else
                                            <a class="id btn btn-success" href="{{ url("dashboard/user/activate/" . $user->first()->slug) }}"><i class="glyphicon glyphicon-ok"></i> Activate</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.product-information -->
                        </div>
                        <!-- /.col-sm-7 -->
                    </div>
                    <!-- /.product-details -->
                </div>
                <!-- /.col-sm-12.padding-right -->

            </div>
            <!-- /.row -->
            
        </div>
        
    </section>
    
    @section('script')
    	<script>
        	$(document).ready( function() {
				$('.id').click( function(e) {
					var conf = confirm( 'Are you sure' );
					
					if ( ! conf ) {
						e.preventDefault();
					}
				} );
			} );
        </script>
    @stop
    
@stop