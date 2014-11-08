@extends ('admin.layouts.main')

@section ('content')
	
    <section>
    	
        <div class="container">
        	
            <div class="row">
            
            	<div class="col-sm-12 padding-right">
                	<div class="product-details">
                    	<div class="col-sm-5">
							<div class="view-product">
								<div class="row">
									<img src="{{ asset('images/propic/'.$user->first()->profile_picture) }}" alt="" />
								</div>
							</div>
						</div>
                        <!-- /.col-sm-5 -->
                        <div class="col-sm-7">
                        	<div class="product-information">
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
                                		<label>Address</label>
                                	</div>
                                	<div class="col-md-9">
                                		: {{ $user->first()->address }}
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
    
@stop