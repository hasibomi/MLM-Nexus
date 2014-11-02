@extends('admin.layouts.main')

@section('content')
	
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="row">
									<img src="{{ asset('images/shop/'.$product->first()->image) }}" alt="" />
								</div>
								<br />
								<div class="row">
									{{ Form::open(array("url" => "/admin/edit-product-details/".$product->first()->id, "files" => true)) }}
										{{ Form::file("image") }}
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
												<?php $query = Catagory::select("catagory_name")->where("catagory_name", "!=", $product->first()->catagory)->get(); ?>
												<select name="catagory">
													<option>{{ $product->first()->catagory }}</option>
													@foreach ($query as $row)
														<option>{{ $row->first()->catagory_name }}</option>
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
												{{ Form::text("condition", $value = $product->first()->condition, $attribute = [ "class" => "form-control", "Placeholder" => "Condition" ]) }}
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
	
@stop