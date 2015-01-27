@extends('Dashboard.Main.Boilerplate')
@section("title") <title>Contact Information</title> @stop
@section('content')
<div class="container">
	
	@if (Session::has('event'))
	{{ Session::get('event') }}
	@endif
	<div class="row">
		<a href="{{ url('dashboard/contact-info/add') }}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add</a>
	</div>
	<br>
	<div class="row">
		
		<div class="table-responsive">
			<table class="table table-condensed table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Address</th>
						<th>Facebook</th>
						<th>Twitter</th>
						<th>Google +</th>
						<th>Active</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@if (count($info) == 0)
					<tr>
						<td colspan="9" class='alert alert-warning'>No contact info has been added yet</td>
					</tr>
					@else
					@foreach($info as $row)
					<tr>
						<td>{{ $row->id }}</td>
						<td>{{ $row->description }}</td>
						<td>{{ Social::facebook($row->facebook) }}</td>
						<td>{{ Social::twitter($row->twitter) }}</td>
						<td>{{ Social::google($row->google) }}</td>
						<td>{{ Social::status($row->status) }}</td>
						<td width="5%">
							<a class="btn btn-info btn-xs" href="contact-info/edit/{{ $row->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
						<td width="5%">
							
							{{ Form::open(array('url' => 'dashboard/contact-info/change')) }}
							{{ Form::hidden('id', $row->id) }}
							@if ($row->status == 1)
							{{ Form::hidden('status', 0) }}
							<button type="submit" class="btn btn-xs btn-warning">
							<span class="glyphicon glyphicon-cog"></span> Deactivate
							</button>
							@else
							{{ Form::hidden('status', 1) }}
							<button type="submit" class="btn btn-xs btn-warning">
							<span class="glyphicon glyphicon-cog"></span> Activate
							</button>
							@endif
							{{ Form::close() }}
						</td>
						<td width="10%">
							{{Form::open(array('url' => 'dashboard/contact-info/delete'))}}
							{{Form::hidden('id', $row->id)}}
							<button type="submit" id="del" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#del').click( function(e) {
			var con = confirm('Delete this info?');
			if (! con) {
				e.preventDefault();
			}
		});
	});
</script>
@stop
@stop