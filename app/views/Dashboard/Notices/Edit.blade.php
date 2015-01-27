@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Edit Notice</title>

@section('css')
    {{ HTML::style('assets/redactor/redactor.css')}}
@stop

@section('content')

<section>
	<section class="container">
    	<div class="row">@if(Session::has("event")) {{ Session::get("event") }} @endif</div>
        @if($errors->all()) <div class="row alert alert-danger"><ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div> @endif
        
    	<div class="row">
            <fieldset>
                <legend>Edit Notice</legend>
                
                @foreach($notices as $notice)
                    {{ Form::open(["url" => "dashboard/notice/update/" . $notice->id]) }}
                        {{ Form::hidden("noticeId", $notice->notice_id) }}
                        {{ Form::label("body", "Notice") }}
                        {{ Form::textarea("body", Input::old("body") ? e(Input::old("body")) : $notice->body, ["class" => "form-control", "id" => "body"]) }}
                        <br>
                        {{ Form::label("user", "Do you want to associate any user?") }}
                        <select name="user">
                            <option value="0" @if($notice->user_id == "") selected @endif>No</option>
                            <option value="1" @if($notice->user_id != "") selected @endif>Yes</option>
                        </select>
                        <br>
                        <br>
                        {{ Form::submit("Submit", ["class" => "btn btn-success pull-right col-md-4"]) }}
                    {{ Form::close() }}
                @endforeach
            </fieldset>
        </div>
	</section>
</section>

<br>

@section ('script')
    {{ HTML::script('assets/redactor/redactor.js') }}
    
    <script>
        $("#body").redactor({
            minHeight: 200,
            imageUpload: "{{ url('dashboard/notice/upload') }}"
        });
    </script>
@stop
@stop