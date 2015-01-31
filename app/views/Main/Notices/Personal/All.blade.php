@extends("Main.Boilerplate")

@section("title")
<title>Personal Notices</title>
@stop

@section("content")

<section>
	<section class="container">
		<div class="row">
        	<div class="table-responsive">
            	<table class="table table-hover table-striped table-condensed">
                	<thead>
                    	<tr>
                        	<th>#</th>
                            <th>Date</th>
                            <th>Notice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(! $notices)
                            <tr><td colspan="3">No notice found</td></tr>
                        @else
                        	@foreach($notices as $key => $notice)
                            	<tr>
                                	<td>{{ $key + 1 }}</td>
                                    <td>
                                        <?php $date = explode(" ", $notice->created_at); $corr_date = explode("-", $date[0]); ?>
                                        <a href="{{ url('personal-notice/view/' . $notice->notice_id) }}">{{ $corr_date[2] }}-{{ $corr_date[1] }}-{{ $corr_date[0] }}</a>
                                    </td>
                                    <td><a href="{{ url('personal-notice/view/' . $notice->notice_id) }}">{{ substr($notice->body, 0, 50) }}</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
	</section>
</section>

@stop