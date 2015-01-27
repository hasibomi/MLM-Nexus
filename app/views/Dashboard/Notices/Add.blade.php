@extends('Dashboard.Main.Boilerplate')

@section('css')

    {{ HTML::style('redactor/redactor.css')}}

@stop

@section('content')

<section>
	<section class="container">
    	<div class="row">@if(Session::has("event")) {{ Session::get("event") }} @endif</div>
        @if($errors->all()) <div class="row alert alert-danger"><ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div> @endif
        
    	<div class="row">
            <fieldset>
                <legend>Add Notice</legend>
                
                {{ Form::open(["url" => "dashboard/notice/add"]) }}
                	{{ Form::hidden("noticeId", uniqid()) }}
                	{{ Form::label("body", "Notice") }}
                	{{ Form::textarea("body", Input::old("body"), ["class" => "form-control", "id" => "body"]) }}
                    <br>
                    {{ Form::label("user", "Do you want to associate any user?") }}
                    <select name="user">
                    	<option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <br>
                    <br>
                    {{ Form::submit("Submit", ["class" => "btn btn-success pull-right col-md-4"]) }}
                {{ Form::close() }}
            </fieldset>
        </div>
	</section>
</section>

<br>

@section ('script')
    {{ HTML::script('redactor/redactor.js') }}
    
    <script>
        $("#body").redactor({
            minHeight: 200,
            imageUpload: '{{ url("dashboard/notice/upload") }}'
        });
    </script>
@stop
@stop