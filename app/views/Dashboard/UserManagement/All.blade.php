@extends('Dashboard.Main.Boilerplate')

@section('title')
    <title>User Management</title>
@stop

@section ('content')

	<div class="container">
    	@if ( Session::has('event') )
        	{{ Session::get( 'event' ) }}
      @endif

      <div class="row">
        @if($users->count() == 0)
          <div class="alert alert-warning">
            <span class="glyphicon glyphicon-exclamation-sign"></span> No members have been registered yet.
          </div>
        @else
          <div class="alert alert-info">
            <span class="glyphicon glyphicon-ok"></span> Total member(s): {{ $users->count() }}
          </div>
        @endif
      </div>

        <div class="table-responsive">
            <table class="table table-condensed table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Point</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->count() != 0)
                        @foreach ($users->get() as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ url("dashboard/user/" . $user->slug) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->designation }}</td>
                                <td>{{ $point = $user->points->sum("point") == 0 ? "No point" : $user->points->sum("point")  }}</td>
                                <td>{{ $point = $user->amounts->sum("amount") == 0 ? "৳ 0" : "৳ " . $user->amounts->sum("amount")  }}</td>
                                <td>
                                    @if ($user->active == 1)
                                        <a class="id btn btn-danger btn-xs" href="{{ url("dashboard/user/deactivate/" . $user->slug) }}"><i class="glyphicon glyphicon-remove"></i> Deactivate</a>
                                    @else
                                        <a class="id btn btn-success btn-xs" href="{{ url("dashboard/user/activate/" . $user->slug) }}"><i class="glyphicon glyphicon-ok"></i> Activate</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No users found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
    <!-- /.container -->

    @section('script')
    	<script>
        	$(document).ready( function() {
				$('.id').click( function(e) {
					var conf = confirm( 'Are you sure' );

					if ( ! conf ) {
						e.preventDefault();
					}
				} );
			} );
        </script>
    @stop

@stop
