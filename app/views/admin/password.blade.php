@extends('admin.layouts.main')

@section('content')

	<div class="container">
		
		<div class="alert alert-warning">
			Please check your email to change password. {{ $admin->first()->email }}
		</div>
		
	</div>
@stop