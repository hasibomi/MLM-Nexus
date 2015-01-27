@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Browse User</title>

@section('content')

<section>
	<section class="container">
    	<div class="row">{{ Session::has("event") ? Session::get("event") : "" }}</div>
      
    	<div class="row">
			{{ Form::open(["url" => "dashboard/notice/updateassignuser/" . $notice]) }}
        		<div class="row">                    
                    @foreach($users as $user)
                        @foreach($notices as $notice)
                        	<div class="col-md-3">
                            	<input type="checkbox" name="users[]" value="{{ $user->id }}" {{ $user->id == $notice->user_id ? "checked" : "" }}> {{ $user->name }}
                          	</div>
                        @endforeach
                    @endforeach
                </div>

                <div class="row">
                    {{ Form::submit("Select", ["class" => "btn btn-success pull-right col-md-3"]) }}
                </div>
            {{ Form::close() }}
        </div>
    </section>
@stop
