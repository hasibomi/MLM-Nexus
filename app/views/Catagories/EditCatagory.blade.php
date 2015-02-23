@extends("Main.Boilerplate")

@section('title')
    <title>Edit catagory - {{ $row->first()->catagory_name }}</title>
@stop

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
