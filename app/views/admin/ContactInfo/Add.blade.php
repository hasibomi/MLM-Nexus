@extends('admin.layouts.main')

@section('css')
  {{ HTML::style('redactor/redactor.css')}}
@stop

@section('content')

<div class="container">
	
	@if (Session::has('event'))
		{{ Session::get('event') }}
	@endif

    @if ($errors->all())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

	<div class="row">
		
		<fieldset>

            <legend>Add Contact Info</legend>

            {{ Form::open(array('url'=>'admin/contact-info/create')) }}
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('description', 'Address') }}</div>
                        <div class="col-md-10">{{ Form::textarea('description', Input::old('description'), ['id'=>'description']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('facebook', 'Facebook Link') }}</div>
                        <div class="col-md-10">{{ Form::text('facebook', Input::old('facebook'), ['class'=>'form-control', 'placeholder'=>'Please add http://','id'=>'facebook']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('twitter', 'Twitter Link') }}</div>
                        <div class="col-md-10">{{ Form::text('twitter', Input::old('twitter'), ['class'=>'form-control', 'placeholder'=>'Please add http://','id'=>'twitter']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('google', 'Google + Link') }}</div>
                        <div class="col-md-10">{{ Form::text('google', Input::old('google'), ['class'=>'form-control', 'placeholder'=>'Please add http://','id'=>'google']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">{{ Form::submit('Add', ['class'=>'btn btn-success btn-block']) }}</div>
                    </div>
                </div>

            {{ Form::close() }}
        </fieldset>

	</div>
</div>

@section ('script')
    {{ HTML::script('redactor/redactor.js') }}
    <script>
        $("#description").redactor({
          minHeight: 200
        });
    </script>
@stop

@stop