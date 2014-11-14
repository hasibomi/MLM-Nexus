@extends('admin.layouts.main')

@section('content')

    <div class="container">
        
        <div class="row">
            @if(Session::has('event'))
                {{ Session::get('event') }}
            @endif
        </div>
        
        <div class="row">
            <a href="/admin/add-slider" class="btn btn-info"><span class='glyphicon glyphicon-plus'></span> Add slider</a>
            <a class="btn btn-warning" href="/admin/change-settings"><i class="glyphicon glyphicon-wrench"></i> Change settings</a>
        </div>
        
    </div>
    {{-- /.container --}}

@stop