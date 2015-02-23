@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Browse User</title>

@section('content')

<section>
	<section class="container">
    	<div class="row">{{ Session::has("event") ? Session::get("event") : "" }}</div>
      
    	<div class="row">
			{{ Form::open(["url" => "dashboard/notice/updateassignuser/" . $notice]) }}
                {{ Form::hidden('notice_id', $notice, ['class'=>'notice_id']) }}
                <div class="row">
                    <h3>Please select user from the list. You can select all by clicking (Select All) button or you can select individual user by clicking their name.</h3>
                </div>
                <hr/>
                <div class="row">
                    {{ Form::checkbox("select", "", false, ["id" => "all"]) }} Select All
                </div>
                <br/>
        		<div class="row">                    
                    @foreach($users as $user)
                    	<div class="col-md-3">
                        	<input type="checkbox" name="users[]" value="{{ $user->id }}" @foreach($notices as $notice) {{ $user->id == $notice->user_id ? "checked" : "" }} @endforeach class="user"> {{ $user->name }}
                      	</div>
                    @endforeach
                </div>

                <div class="row">
                    {{ Form::submit("Select", ["class" => "btn btn-success pull-right col-md-3"]) }}
                </div>
            {{ Form::close() }}
        </div>
    </section>
@stop

@section("script")

@section("script")
    <script type="text/javascript">
        $('input[name=select]').click(function(e) {
            for (var i = 0; i < $('.user').length; i++) {
                $('.user')[i].checked = $(this)[0].checked;
            };
        });

        $('.user').change(function(e) {
            if ($('.user:checked').length == $('.user').length) {
                $('input[name=select]')[0].checked = true;
            } else {
                $('input[name=select]')[0].checked = false;
            }
        });
    </script>
@stop
