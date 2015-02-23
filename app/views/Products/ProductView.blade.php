@extends("Main.Boilerplate")

@section("title") <title>{{ $product->first()->name }}</title>

@section("content")

	@if(Admin::isAdmin())
        @include('Products.Partials.EditProduct')
	@else
		<section>
			<div class="container">
				<div class="row">
					@if (Session::has('event'))
						{{ Session::get('event') }}
					@endif
				</div>
				<div class="row">

					<div class="col-sm-12 padding-right">
						<div class="product-details"><!--product-details-->
							<div class="col-sm-5">
								<div class="view-product">
									<div class="row">
										<img src="{{ asset('assets/images/shop/'.$product->first()->image) }}" alt="" />
									</div>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="product-information"><!--/product-information-->
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("catagory", "Category") }}
										</div>
										<div class="col-md-10">
											 {{ $product->first()->catagory->catagory_name }}
										</div>
									</div>
                                    @if($product->first()->subcatagory_id != 0)
                                        <div class="row">
                                            <div class="col-md-2">
                                                {{ Form::label("subcatagory", "Subcategory") }}
                                            </div>
                                            <div class="col-md-10">
                                                {{ $product->first()->subcatagory->subcatagory_name }}
                                            </div>
                                        </div>
                                    @endif
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("product_name", "Name") }}
										</div>
										<div class="col-md-10">
											{{ $product->first()->name }}
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("price", "Price") }}
										</div>
										<div class="col-md-10">
											৳ {{ $product->first()->price }}
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("condition", "Condition") }}
										</div>
										<div class="col-md-10">
											{{ $product->first()->product_condition }}
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("brand", "Brand") }}
										</div>
										<div class="col-md-10">
											{{ $product->first()->brand }}
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("description", "Description") }}
										</div>
										<div class="col-md-10">
											{{ $product->first()->description }}
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											{{ Form::label("point", "Point") }}
										</div>
										<div class="col-md-10">
											{{ $product->first()->point }}
										</div>
									</div>
									@if (! Auth::user())
										<div class="row">
											<div class="col-md-6">
												<a class="btn btn-default add-to-cart btn-sm pull-right" href="/login">
													<i class="fa fa-shopping-cart"></i> Add to cart
												</a>
											</div>
										</div>
									@elseif (Auth::user() && Auth::user()->type != 'admin')
										{{ Form::open(['url'=>'/products/add-to-cart']) }}
											{{ Form::hidden('id',$product->first()->id) }}
											{{ Form::hidden('catagory',$query->first()->id) }}
                                            <?php
                                            $key = 'kiobostha?kiobos';
                                            $price = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $product->first()->price, MCRYPT_MODE_ECB)));
                                            ?>
                                            {{ Form::hidden('price', $price) }}
											<div class="form-group">
												<div class="row">
													<div class="col-md-2">
														{{ Form::label('quantity', 'Quantity') }}
													</div>
													<div class="col-md-4">
														<input min="1" name="quantity" type="number" value="1"/>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<button class="btn btn-default add-to-cart btn-sm pull-right" type="submit">
															<i class="fa fa-shopping-cart"></i> Add to cart
														</button>
													</div>
												</div>
											</div>
										{{ Form::close() }}
									@elseif (Auth::user()->type == 'admin')
									@else
										<a href="/login" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									@endif
								</div><!--/product-information-->
							</div>
						</div><!--/product-details-->
					</div>
				</div>
			</div>
		</section>
	@endif

@stop

@if(Admin::isAdmin())
    @section('script')
        <script>
            function getSubdcatagory()
            {
                $.ajax({
                    url: '{{ url("products/add/find_subcatagory") }}',
                    type: 'post',
                    dataType: 'html',
                    data: 'catagory=' + $("#catagory").val(),
                    success: function(data) {
                        $("#subcatagory_div").show();
                        $("#subcatagory").html(data);
                    }
                })
            }

            $("#catagory").change(function() {
                getSubdcatagory();
            });
        </script>
    @stop
@endif