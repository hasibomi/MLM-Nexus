@extends('admin.layouts.main')

@section('content')

	<br />
	<br />
	<br />
	
	<div class="container">
		@if (Session::has('event'))
			{{ Session::get('event') }}
		@endif
	</div>
	
	<section>
		<div class="container">
			{{ Form::open(array('url' => '/admin/addProduct', 'files' => true)) }}
				<div class="form-group">
					<div class="row">
						<div class="col-md-2">
							<label for="catagory">Catagories</label>
						</div>
						<div class="col-md-6">
							<?php
							$query = Catagory::get();
							?>
							<select name="catagory">
								@foreach ($query as $row)
									<option value="{{ $row->id }}">{{ $row->catagory_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-md-offset-2">
						<div class="col-md-7">
							@if ($errors->has('name'))
								{{ $errors->first('name', '<p class="alert alert-danger">Please write a name of the product</p>') }}
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-2"><label for="name">Product's name</label></div>
						<div class="col-md-6">
							{{ Form::text('name', $value = e(Input::old('name')), $attributes = ['class' => 'form-control', 'placeholder' => 'Name']) }}
						</div>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-md-offset-2">
						<div class="col-md-7">
							@if ($errors->has('price'))
								{{ $errors->first('price', '<p class="alert alert-danger">Please specify the price of the product</p>') }}
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-2"><label for="price">Price</label></div>
						<div class="col-md-6">
							{{ Form::text('price', $value = e(Input::old('price')), $attributes = ['class' => 'form-control', 'placeholder' => 'Price']) }}
						</div>
					</div>
				</div>
				<br />
				<div class="row">
                    <div class="col-md-offset-2">
                        <div class="col-md-7">
                            @if ($errors->has('condition'))
                                {{ $errors->first('condition', '<p class="alert alert-danger">Please specify the condition of the product</p>') }}
                            @endif
                        </div>
                    </div>
                </div>
				<div class="form-group">
				    <div class="row">
                        <div class="col-md-2"><label for="condition">Condition</label></div>
                        <div class="col-md-6">
                            {{ Form::text('condition', $value = e(Input::old('condition')), $attributes = ['class' => 'form-control', 'placeholder' => 'Condition']) }}
                        </div>
				    </div>
				</div>
				<br/>
				<div class="row">
                    <div class="col-md-offset-2">
                        <div class="col-md-7">
                            @if ($errors->has('quantity'))
                                {{ $errors->first('quantity', '<p class="alert alert-danger">What is the quantity of the product?</p>') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
				    <div class="row">
                        <div class="col-md-2"><label for="condition">Quantity</label></div>
                        <div class="col-md-6">
                            {{ Form::text('quantity', $value = e(Input::old('quantity')), $attributes = ['class' => 'form-control', 'placeholder' => 'Quantity']) }}
                        </div>
				    </div>
				</div>
                <br />
				<div class="row">
                    <div class="col-md-offset-2">
                        <div class="col-md-7">
                            @if ($errors->has('brand'))
                                {{ $errors->first('brand', '<p class="alert alert-danger">Please write a brand name of the product</p>') }}
                            @endif
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-2"><label for="brand">Brand</label></div>
                        <div class="col-md-6">
                            {{ Form::text('brand', $value = e(Input::old('brand')), $attributes = ['class' => 'form-control', 'placeholder' => 'Brand']) }}
                        </div>
                    </div>
                </div>
                <br/>
				<div class="row">
					<div class="col-md-offset-2">
						<div class="col-md-7">
							@if ($errors->has('description'))
								{{ $errors->first('description', '<p class="alert alert-danger">Please write a description of the product</p>') }}
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-2"><label for="description">Description</label></div>
						<div class="col-md-6">
							{{ Form::textarea('description', $value = e(Input::old('description')), $attributes = ['class' => 'form-control', 'placeholder' => 'Description']) }}
						</div>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-md-offset-2">
						<div class="col-md-7">
							@if ($errors->has('image'))
								{{ $errors->first('image', '<p class="alert alert-danger">Please upload an image of the product</p>') }}
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-2"><label for="image">Upload an image</label></div>
						<div class="col-md-6">
							{{ Form::file('image') }}
						</div>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-md-offset-2">
						<div class="col-md-7">
							@if ($errors->has('point'))
								{{ $errors->first('point', '<p class="alert alert-danger">Please specify some points of the product</p>') }}
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-2"><label for="product_code">Product code</label></div>
						<div class="col-md-6">
						    {{ Form::text('point', $value = e(Input::old('point')), $attributes = ['class' => 'form-control', 'placeholder' => 'Point']) }}
						</div>
					</div>
				</div>
				<br />
				<div class="row">
                    <div class="col-md-offset-2">
                        <div class="col-md-7">
                            @if ($errors->has('product_code'))
                                {{ $errors->first('product_code', '<p class="alert alert-danger">Please specify a product code</p>') }}
                            @endif
                        </div>
                    </div>
                </div>
                <br />
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-2"><label for="point">Point</label></div>
                        <div class="col-md-6">
                            {{ Form::text('product_code', $value = e(Input::old('product_code')), $attributes = ['class' => 'form-control', 'placeholder' => 'Product code']) }}
                        </div>
                    </div>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-offset-3">
							{{ Form::submit('Add', $attributes = ['class' => 'btn btn-lg btn-success col-md-5']) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</section>
	
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	
@stop