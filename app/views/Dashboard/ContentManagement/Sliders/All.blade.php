@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Sliders</title> @stop

@section('content')

    <div class="container">
        
        <div class="row">
            <a href="{{ url('dashboard/add-slider') }}" class="btn btn-info"><span class='glyphicon glyphicon-plus'></span> Add slider</a>
        </div>
        
        <br>
        <br>


        @if(Session::has('event'))
            {{ Session::get('event') }}
        @endif
        
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Text</th>
                            <th>Image</th>
                            <th>Active</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if ($sliders->count() == 0)
                            <tr>
                                <td colspan="10">No sliders have been added yet</td>
                            </tr>
                        @else
                            @foreach($sliders as $row)
                                
                                <tr>
                                    <td>{{ $row->slider_id }}</td>
                                    <td><a href="{{ url('dashboard/edit-slider/' . $row->id) }}">{{ $row->slider_text }}</a></td>
                                    <td>
                                       @if($row->slider != '')
                                            <a href="{{ url('dashboard/edit-slider/' . $row->id) }}"><img src="{{ asset($row->slider) }}" alt="{{$row->slider}}" width="70" height="70"></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->active == 1)
                                            <div class="btn btn-success btn-xs">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </div>
                                        @else
                                            <div class="btn btn-danger btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </div>
                                        @endif
                                    </td>
                                    <td width="5%">
                                        @if($row->active == 1)
                                           
                                            {{ Form::open(array('url' => 'dashboard/slider-status')) }}
                                                {{ Form::hidden('status', 0) }}
                                                {{ Form::hidden('id', $row->id) }}
                                                {{ Form::submit('Deactivate', ['class' => 'btn btn-danger btn-xs']) }}
                                            {{ Form::close() }}
                                        @else
                                           {{ Form::open(array('url' => 'dashboard/slider-status')) }}
                                                {{ Form::hidden('status', 1) }}
                                                {{ Form::hidden('id', $row->id) }}
                                                {{ Form::submit('Activate', ['class' => 'btn btn-success btn-xs']) }}
                                            {{ Form::close() }}
                                        @endif                                        
                                    </td>
                                    <td>
                                        {{ Form::open(array('url' => 'dashboard/delete')) }}
                                            {{ Form::hidden('id', $row->id)}}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <br><br>
        
    </div>
    {{-- /.container --}}

@stop