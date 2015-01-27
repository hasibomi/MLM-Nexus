@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Browse User</title>

@section('content')

<section>
	<section class="container">
        {{ Form::open(["url" => "dashboard/notice/assignuser/" . $notice]) }}
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-3">
                        <input type="checkbox" name="users[]" value="{{ $user->id }}"> {{ $user->name }}
                    </div>
                @endforeach
            </div>
            <div class="row">
                {{ Form::submit("Select", ["class" => "btn btn-success pull-right col-md-3"]) }}
            </div>
        {{ Form::close() }}
    </section>
</section>

@stop