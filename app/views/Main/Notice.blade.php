@extends("Main.Boilerplate")

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
                    	@foreach($notices as $key => $notice)
                        	<tr>
                            	<td>{{ $key + 1 }}</td>
                                <td>
                                    <?php $date = explode(" ", $notice->created_at); $corr_date = explode("-", $date[0]); ?>
                                    <a href="{{ url('notice/view/' . $notice->id) }}">{{ $corr_date[2] }}-{{ $corr_date[1] }}-{{ $corr_date[0] }}</a>
                                </td>
                                <td><a href="{{ url('notice/view/' . $notice->id) }}">{{ substr($notice->body, 0, 10) }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
	</section>
</section>

@stop