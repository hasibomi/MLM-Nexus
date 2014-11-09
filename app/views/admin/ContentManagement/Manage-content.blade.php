@extends ('admin.layouts.main')

@section ('content')
    
    <div class="container">
        
        <div class="row">
            <a href="/admin/add-content" class="btn btn-info"><span class='glyphicon glyphicon-plus'></span> Add content</a>
            <a class="btn btn-warning" href="/admin/change-settings"><i class="glyphicon glyphicon-wrench"></i> Change settings</a>
        </div>
            
        <br>
            
        <div class="row">
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Page</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contents->count() == 0)   
                            <tr>
                                <td colspan="5" class='alert alert-warning'>No contens have been added yet</td>
                            </tr>
                        @else
                            @foreach ($contents as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ ucfirst($row->call_name) }}</td>
                                    @if ($row->active == 1)
                                        <td class="alert alert-success"><span class="glyphicon glyphicon-ok"></span></td>
                                    @else
                                        <td class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span></td>
                                    @endif
                                    <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <!-- /.container -->
    
@stop