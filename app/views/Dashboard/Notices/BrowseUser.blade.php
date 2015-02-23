@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Browse User</title>

@section('content')

<section>
	<section class="container">
        {{ Form::open(["url" => "dashboard/notice/assignuser/" . $notice]) }}
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
                        <input type="checkbox" name="users[]" value="{{ $user->id }}" class="user"> {{ $user->name }}
                    </div>
                @endforeach
            </div>
            <br/>
            <div class="row">
                <div class="col-md-offset-4">
                    {{ Form::submit("Add to sending list", ["class" => "btn btn-success col-md-3"]) }}
                </div>
            </div>
        {{ Form::close() }}
    </section>
</section>

@stop

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