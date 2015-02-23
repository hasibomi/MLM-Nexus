@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Edit Contact Information</title> @stop

@section('css')
  {{ HTML::style('assets/redactor/redactor.css')}}
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

            {{ Form::open(array('url'=>'dashboard/contact-info/update/'.$info->id)) }}
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('description', 'Address') }}</div>
                        <div class="col-md-10">{{ Form::textarea('description', (Input::old('description') ? Input::old('description') : $info->description), ['id'=>'description']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('facebook', 'Facebook Link') }}</div>
                        <div class="col-md-10">{{ Form::text('facebook', (Input::old('facebook') ? Input::old('facebook') : $info->facebook), ['class'=>'form-control', 'placeholder'=>'Please add http://','id'=>'facebook']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('twitter', 'Twitter Link') }}</div>
                        <div class="col-md-10">{{ Form::text('twitter', (Input::old('twitter') ? Input::old('twitter') : $info->twitter), ['class'=>'form-control', 'placeholder'=>'Please add http://','id'=>'twitter']) }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('google', 'Google + Link') }}</div>
                        <div class="col-md-10">{{ Form::text('google', (Input::old('google') ? Input::old('google') : $info->google), ['class'=>'form-control', 'placeholder'=>'Please add http://','id'=>'google']) }}</div>
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
    {{ HTML::script('assets/redactor/redactor.js') }}
    <script>
        $("#description").redactor({
          minHeight: 200
        });
    </script>
@stop

@stop