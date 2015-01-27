@extends("Main.Boilerplate")

@section("title") <title>{{ $product->first()->name }}</title>

@section("content")

	@if(Admin::isAdmin())
		<section>
			<div class="container">
				<div class="row">

					<div class="col-sm-12 padding-right">
						<div class="product-details"><!--product-details-->
							<div class="col-sm-5">
								<div class="view-product">
									<div class="row">
										<img src="{{ asset('assets/images/shop/'.$product->first()->image) }}" alt="" />
									</div>
									<br />
									<div class="row">
										{{ Form::open(array("url" => "dashboard/editProduct/".$product->first()->id, "files" => true)) }}
											{{ Form::file("image") }}
											@if($errors->first("image"))
												{{ $errors->first("image") }}
											@endif
									</div>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="product-information"><!--/product-information-->

										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("catagory", "Catagory") }}
												</div>
												<div class="col-md-10">
													<?php $query = Catagory::select("id", "catagory_name")->where("id", "!=", $product->first()->catagory_id)->get(); $query2 = Catagory::where('id', $product->first()->catagory_id)->get(); ?>
													<select name="catagory">
														<option value="{{ $product->first()->catagory_id }}">{{ $query2->first()->catagory_name }}</option>
														@foreach ($query as $row)
															<option value="{{ $row->id }}">{{ $row->catagory_name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("product_name") )
													{{ $errors->first( "product_name", '<p class="alert alert-danger">Please write a name of the product</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("product_name", "Name") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('product_name') ) has-error @endif">
													{{ Form::text("product_name", $value = $product->first()->name, $attribute = [ "class" => "form-control", "Placeholder" => "Product's name" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("price") )
													{{ $errors->first( "price", '<p class="alert alert-danger">Please write the price</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("price", "Price") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('price') ) has-error @endif">
													{{ Form::text("price", $value = $product->first()->price, $attribute = [ "class" => "form-control", "Placeholder" => "Price" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("condition") )
													{{ $errors->first( "condition", '<p class="alert alert-danger">Please write a condition</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("condition", "Condition") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('condition') ) has-error @endif">
													{{ Form::text("condition", $value = $product->first()->product_condition, $attribute = [ "class" => "form-control", "Placeholder" => "Condition" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("quantity") )
													{{ $errors->first( "quantity", '<p class="alert alert-danger">Please write some quantities</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("quantity", "Quanity") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('quantity') ) has-error @endif">
													{{ Form::text("quantity", $value = $product->first()->quantity, $attribute = [ "class" => "form-control", "Placeholder" => "Quanity" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("brand") )
													{{ $errors->first( "brand", '<p class="alert alert-danger">Please write a brand name</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("brand", "Brand") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('brand') ) has-error @endif">
													{{ Form::text("brand", $value = $product->first()->brand, $attribute = [ "class" => "form-control", "Placeholder" => "Brand" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("description") )
													{{ $errors->first( "description", '<p class="alert alert-danger">Please describe about the product</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("description", "Description") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('description') ) has-error @endif">
													{{ Form::textarea("description", $value = $product->first()->description, $attribute = [ "class" => "form-control", "Placeholder" => "Description" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("point") )
													{{ $errors->first( "point", '<p class="alert alert-danger">Please specify some points for the product</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("point", "Point") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('point') ) has-error @endif">
													{{ Form::text("point", $value = $product->first()->point, $attribute = [ "class" => "form-control", "Placeholder" => "Point" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												@if ( $errors->has("product_code") )
													{{ $errors->first( "product_code", '<p class="alert alert-danger">Please specify a product code</p>' ) }}
												@endif
											</div>
										</div> <!-- Error message -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-2">
													{{ Form::label("product_code", "Product code") }}
												</div>
												<div class="col-md-10 @if ( $errors->has('product_code') ) has-error @endif">
													{{ Form::text("product_code", $value = $product->first()->product_code, $attribute = [ "class" => "form-control", "Placeholder" => "Product code" ]) }}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-12">
													{{ Form::submit("Save", $attributes = [ "class" => "btn btn-success btn-block" ]) }}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div><!--/product-information-->
							</div>
						</div><!--/product-details-->
					</div>
				</div>
			</div>
		</section>
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
											{{ Form::label("catagory", "Catagory") }}
										</div>
										<div class="col-md-10">
											<?php
											 $query = Catagory::where("id", "=", $product->first()->catagory_id)->get();
											 ?>
											 {{ $query->first()->catagory_name }}
										</div>
									</div>
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