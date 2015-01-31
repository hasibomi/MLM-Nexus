@extends("Main.Boilerplate")

<?php foreach($notices as $notice) { $date = explode(" ", $notice->created_at); $corr_date = explode("-", $date[0]); } ?>

@section('title')
<title>Notice - {{ $corr_date[2] }}-{{ $corr_date[1] }}-{{ $corr_date[0] }}</title>
@stop

@section("content")

<section>
	<section class="container">
		<div class="row">
			<h4>
				Date: 
				{{ $corr_date[2] }}-{{ $corr_date[1] }}-{{ $corr_date[0] }}
			</h4>
			<hr>
		</div>
		<div class="row">
			{{ $notice->body }}
		</div>
	</section>
</section>

@stop