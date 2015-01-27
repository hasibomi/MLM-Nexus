@extends('Main.Boilerplate')

@section('content')

	<div class="container">
		<br />
		<br />
		@if (Session::has('event'))
			{{ Session::get('event') }}
		@endif
		<br />
		{{ Form::open(array('url' => 'catagory/addCatagory')) }}
			<div class="form-group">
				<div class="row">
					<div class="col-md-2">
						{{ Form::label('catagory_name', 'Catagory Name') }}
					</div>
					<div class="col-md-5 @if ($errors->has('catagory_name')) has-error @endif">
						{{ Form::text('catagory_name', $value = Input::old('catagory_name'), $attributes = ['class' => 'form-control', 'placeholder' => 'Catagory Name']) }}
					</div>
				</div>
			</div>
			@if ($errors->has('catagory_name'))
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 col-md-offset-2">
							{{ $errors->first('catagory_name') }}
						</div>
					</div>
				</div>
			@endif
			<div class="form-group">
				<div class="row">
					<div class="col-md-2">
						{{ Form::label('catagory_type', 'Assign to') }}
					</div>
					<div class="col-md-5">
						<select name="catagory_type">
							<option value="Main catagory">This is a main catagory</option>
							<?php $catagories = Catagory::select('catagory_name')->get(); ?>
							@foreach ($catagories as $catagory)
								<option>{{ $catagory->catagory_name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-5 col-md-offset-2">	
					{{ Form::submit('Add', $attributes = ['class' => 'btn btn-block btn-success']) }}
					</div>
				</div>
			</div>
		{{ Form::close() }}
		<br />
		<br />
		<br />
	</div>

@stop
