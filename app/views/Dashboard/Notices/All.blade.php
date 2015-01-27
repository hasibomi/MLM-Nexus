@extends('Dashboard.Main.Boilerplate')

@section("title") <title>Notices</title> @stop

@section('content')

<section>
	<section class="container">
    	<div class="row">
        	@if(Session::has("event"))
            	{{ Session::get("event") }}
            @endif
        </div>
        
        <div class="row">
        	<a href="{{ url('dashboard/notice/store') }}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add Notice</a>
        </div>
        
        <div class="row">
        	<div class="table-responsive">
            	<table class="table table-hover table-striped table-condensed">
                	<thead>
                    	<tr>
                        	<th>#</th>
                            <th>Notice ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($notices as $key => $notice)
                        	<tr>
                            	<td>{{ $key + 1 }}</td>
                                <td>{{ $notice->notice_id }}</td>
                                <td>
                                    <?php $date = explode(" ", $notice->created_at); $corr_date = explode("-", $date[0]); ?>
                                    <a href="{{ url('dashboard/notice/edit/' . $notice->id) }}">{{ $corr_date[2] }}-{{ $corr_date[1] }}-{{ $corr_date[0] }}</a>
                                </td>
                                <td>
                                    <?php $notice_user = rtrim($notice->user_id, ", "); ?>
                                    <h1>{{ $notice_user }}</h1>
                                </td>
                                <td width="5%">
                                	<a href="{{ url('dashboard/notice/edit/' . $notice->id) }}" class="btn btn-xs btn-success">
                                    	<i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
                                </td>
                                <td>
                                	{{ Form::open(["url" => "dashboard/notice/delete"]) }}
                                    	{{ Form::hidden("id", $notice->id) }}
                                        <button type="submit" class="btn btn-danger btn-xs">
                                        	<span class="glyphicon glyphicon-remove"></span> Delete
                                        </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</section>

@stop