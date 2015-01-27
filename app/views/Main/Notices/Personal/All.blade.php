@extends("Main.Boilerplate")

@section("content")

@foreach($notices as $notice)
	{{ $notice->body }}
@endforeach

@stop