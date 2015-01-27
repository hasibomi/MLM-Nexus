@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Edit slider</title> @stop

@section('css')
  {{ HTML::style('assets/redactor/redactor.css')}}
@stop

@section('content')

	@if($errors->all())
		<div class="container">
			<div class="row alert alert-danger">
				@foreach($errors->all() as $error)
					{{ $error }}
					<br />
				@endforeach
			</div>
		</div>
	@endif
	
	@if (Session::has('event'))
		<div class="container">
			<div class="row">
				{{ Session::get('event') }}
			</div>
		</div>
	@endif

	<div class="container">
		
		{{ Form::open(array('url' => 'dashboard/update/'.$row->first()->id, 'files' => true)) }}
		
			<div class="form-group">
                <div class="row">
                    {{ Form::label('text', 'Image Text') }}
                    {{ Form::textarea('text', $row->first()->slider_text, ['placeholder' => 'Image text', 'id'=>'editor']) }}
                </div>
            </div>
                
			<div class="form-group">
                <div class="row">
                    {{ Form::label('slider', 'Image') }}
                    {{ Form::file('slider') }}
                </div>
                <div class="row">
                	<img src="{{ asset($row->first()->slider) }}" alt="{{$row->first()->slider}}" width="300" height="100" class="img-responsive" />
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    {{ Form::submit('Update', ['class' => 'btn btn-block btn-success']) }}
                </div>
            </div>
		
		{{ Form::close() }}
		
	</div> <!-- /.container -->

	@section ('script')
        {{ HTML::script('assets/redactor/redactor.js') }}
        <script>
        $("#editor").redactor({
          minHeight: 200
        });
        </script>
  	@stop

@stop
