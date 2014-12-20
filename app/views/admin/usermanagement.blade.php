@extends ('admin.layouts.main')

@section ('content')

	<div class="container">
    
    	@if ( Session::has('event') )
        	{{ Session::get( 'event' ) }}
        @endif

        <div class="table-responsive">
            <table class="table table-condensed table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Point</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="/mlm/admin/user/{{ $user->id }}">{{ $user->name }}</a></td>
                            <td>{{ $user->designation }}</td>
                            <td>{{ $user->point }}</td>
                            <td>
                            	@if ($user->active == 1)
                                	<a class="id btn btn-danger btn-xs" href="/mlm/admin/user/deactivate/{{ $user->id }}"><i class="glyphicon glyphicon-remove"></i> Deactivate</a>
                                @else
                                	<a class="id btn btn-success btn-xs" href="/mlm/admin/user/activate/{{ $user->id }}"><i class="glyphicon glyphicon-ok"></i> Activate</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
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