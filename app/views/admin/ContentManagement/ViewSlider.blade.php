@extends('admin.layouts.main')

@section('css')
  {{ HTML::style('redactor/redactor.css')}}
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
		
		{{ Form::open(array('url' => 'admin/update/'.$row->first()->id, 'files' => true)) }}
		
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
                	<img src="{{ asset('images/slider/'.$row->first()->slider) }}" alt="{{$row->first()->slider1}}" width="300" height="100" class="img-responsive" />
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
        {{ HTML::script('redactor/redactor.js') }}
        <script>
        $("#editor").redactor({
          minHeight: 200
        });
        </script>
  	@stop

@stop
