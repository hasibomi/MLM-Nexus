@extends('Dashboard.Main.Boilerplate')

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

    <div class="container">
        
        <div class="col-md-8">
            
            {{ Form::open(array('url' => 'dashboard/add-slider-post', 'files' => true)) }}
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::hidden('getId', $query) }}
                        {{ Form::label('text', 'Image Text') }}
                        {{ Form::textarea('text', '', ['placeholder' => 'Image text', 'id'=>'editor']) }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider', 'Image') }}
                        {{ Form::file('slider') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::submit('Add', ['class' => 'btn btn-block btn-success']) }}
                    </div>
                </div>
            
            {{ Form::close() }}
            
        </div>
        
    </div>
    {{-- /.container --}}
    
    @section ('script')
        {{ HTML::script('redactor/redactor.js') }}
        <script>
        $("#editor").redactor({
          minHeight: 200
        });
        </script>
  @stop

@stop