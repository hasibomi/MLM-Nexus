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
                    @foreach($users as $user)
                    	<div class="col-md-3">
                        	<input type="checkbox" name="users[]" value="{{ $user->id }}" @foreach($notices as $notice) {{ $user->id == $notice->user_id ? "checked" : "" }} @endforeach class="users"> {{ $user->name }}
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

<script>
    $(".users").click(function(e) {
        //alert($(this).val());
        $.ajax({
            url: "/dashboard/finduser",
            method: "post",
            dataType: "html",
            data: 'id=' + $(this).val() + '&notice_id=' + $(".notice_id").val(),
            success: function (data) {
                alert(data);
            }
        });
    });
</script>

@stop
