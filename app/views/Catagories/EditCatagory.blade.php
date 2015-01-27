@extends("Main.Boilerplate")

@section ("content")

	<br />
	<br />
	<br />

	<div class="container">
		{{ Form::open( array("url" => "catagory/edit-catagory/".$row->first()->id) ) }}
			<div class="form-group">
				<div class="row">
					<div class="col-md-2">
						{{ Form::label("catagory_name", "Catagory name") }}
					</div>
					<div class="col-md-5">
						{{ Form::text("catagory_name", $value = $row->first()->catagory_name, $attributes = ["class" => "form-control", "Placeholder" => "Catagory name"]) }}
					</div>
				</div>
			</div> <!--end form-group-->
			<div class="form-group">
				<div class="row">
					<div class="col-md-2">
						{{ Form::label("catagory_type", "Assign to") }}
					</div>
					<div class="col-md-5">
						<select name="catagory_type">
							@if ( $row->first()->catagory_type != "Main catagory" )
								<option>{{ $row->first()->catagory_type }}</option>
								<option value="Main catagory">This is a main catagory</option>
								<?php $query = Catagory::select('catagory_name')->where('catagory_name', '!=', $row->first()->catagory_name)->get(); ?>
								@foreach ($query as $option)
									<option>{{ $option->catagory_name }}</option>
								@endforeach
							@else
								<option>{{ $row->first()->catagory_type }}</option>
								<?php $query = Catagory::select('catagory_name')->where('catagory_name', '!=', $row->first()->catagory_name)->get(); ?>
								@foreach ($query as $option)
									<option>{{ $option->catagory_name }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
			</div> <!--end form-group-->
			<div class="form-group">
				<div class="row">
					<div class="col-md-offset-2 col-md-5">
						{{ Form::submit("Submit", $attributes = ["class" => "btn btn-block btn-success"]) }}
					</div>
				</div>
			</div> <!--end form-group-->
		{{ Form::close() }}
	</div>
	
	<br />
	<br />
	<br />
	<br />
	<br />
	
@stop
