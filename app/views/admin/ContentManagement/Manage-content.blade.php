@extends ('admin.layouts.main')

@section ('content')
    
    <div class="container">
    	
    	<div class="row">
    		@if(Session::has('event'))
    			{{ Session::get('event') }}
    		@endif
    	</div>
        
        <div class="row">
            <a href="/mlm/admin/add-content" class="btn btn-info"><span class='glyphicon glyphicon-plus'></span> Add content</a>
            <a href="/mlm/admin/slider" class="btn btn-success"><span class="glyphicon glyphicon-retweet"></span> Slider</a>
            <a href="/mlm/admin/contact-info" class="btn btn-default">
                <span class="glyphicon glyphicon-envelope"></span> Contact Info
            </a>
            <a class="btn btn-warning" href="/mlm/admin/change-settings"><i class="glyphicon glyphicon-wrench"></i> Change settings</a>
        </div>
            
        <br>
            
        <div class="row">
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Page</th>
                            <th>Active</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contents->count() == 0)   
                            <tr>
                                <td colspan="7" class='alert alert-warning'>No contens have been added yet</td>
                            </tr>
                        @else
                            @foreach ($contents as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ ucfirst($row->call_name) }}</td>
                                    @if ($row->active == 1)
                                        <td>
                                            <font color="#769e77">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </font>
                                        </td>
                                    @else
                                        <td>
                                            <font color="#a94442">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </font>
                                        </td>
                                    @endif
                                    <td width="5%">
                                        <a class="btn btn-info btn-xs" href="edit-content/{{$row->id}}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    </td>

                                    <td width="5%">
                                        
                                        {{ Form::open(array('url' => 'admin/changeStatus')) }}
                                            {{ Form::hidden('id', $row->id) }}

                                            @if ($row->active == 1)
                                                {{ Form::hidden('status', 0) }}

                                                <button type="submit" class="btn btn-xs btn-warning">
                                                    <span class="glyphicon glyphicon-cog"></span> Deactivate
                                                </button>
                                            @elseif($row->active == 0)
                                                {{ Form::hidden('status', 1) }}
                                                <button type="submit" class="btn btn-xs btn-warning">
                                                    <span class="glyphicon glyphicon-cog"></span> Activate
                                                </button>
                                            @endif
                                        {{ Form::close() }}
                                    </td>

                                    <td width="10%">
                                        {{Form::open(array('url' => 'admin/delete-content'))}}
                                            {{Form::hidden('id', $row->id)}}
                                            <button type="submit" id="btn" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</button>
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
    <!-- /.container -->

    @section('script')
        
        <script>
            $(document).ready(function () {
                $('#btn').click(function (e) {
                    var con = confirm('Are you sure? This can\'t be undone.');

                    if (! con) {
                        e.preventDefault();
                    }
                });
            });
        </script>

    @stop
    
@stop