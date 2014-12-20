@extends('Dashboard.Main.Boilerplate')

@section('content')
	
<div class="container">
	<h1 class="page-header">Admin Dashboard</h1>
	
	<a href="javascript:;" class="btn btn-success">
		<span class="glyphicon glyphicon-list-alt"></span>
		@if(Product::all()->count() < 2) Product - <span class="badge">{{ Product::all()->count() }}</span>
		@else Products - <span class="badge">{{ Product::all()->count() }}</span> @endif
	</a>
	
	<a href="javascript:;" class="btn btn-warning">
		<span class="glyphicon glyphicon-th-large"></span>
		@if(Catagory::all()->count() < 2) Catagory - <span class="badge">{{ Catagory::all()->count() }}</span>
		@else Catagorys - <span class="badge">{{ Catagory::all()->count() }}</span> @endif
	</a>
	
	<a href="{{ url('dashboard/usermanagement') }}" class="btn btn-info">
		<span class="glyphicon glyphicon-user"></span>
		@if(User::all()->count() < 2) Member - <span class="badge">{{ User::all()->count() }}</span>
		@else Members - <span class="badge">{{ User::all()->count() }}</span> @endif
	</a>
	
	<br>
	<br>
	
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="panel-title">Orders</h2>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>Product code</th>
								<th>Product name</th>
								<th>Product catagory</th>
								<th>Customer's name</th>
								<th>Customer's email</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						
						<tbody>
							@if($query->count() == 0)
							<tr><td colspan="10">No orders found</td></tr>
							@else
								@foreach($query as $order)
									<tr>
										<td>{{ $order->id }}</td>
										<td>{{ $order->product->first()->product_code }}</td>
										<td>{{ $order->product->first()->name }}</td>
										@foreach(Catagory::where('id', $order->catagory)->get() as $catagory)
											<td>{{ $catagory->catagory_name }}</td>
										@endforeach
										<td>{{ $order->user->first()->name }}</td>
										<td>{{ $order->user->first()->email }}</td>
										<td>{{ $order->quantity }}</td>
										<td>{{ $order->quantity * $order->product->first()->price }}</td>
										@if($order->status == 0)
										<td width="5%">
											{{ Form::open(['url' => '/admin/order/accept/' . $order->id]) }}
												{{ Form::hidden('status', '1') }}
												<button type="submit" class="btn btn-success btn-xs">
													<span class="glyphicon glyphicon-ok"></span>
													Accept
												</button>
											{{ Form::close() }}
										</td>
										<td>
											<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#denyModal{{ $order->id }}">
												<span class="glyphicon glyphicon-remove"></span>
												Deny
											</button>
										</td>
										@else
										<td colspan="2">
											{{ Form::open(['url' => '/admin/order/delete']) }}
												{{ Form::hidden('id', $order->id) }}
												<button type="submit" class="btn btn-danger btn-xs">
													<span class="glyphicon glyphicon-remove"></span>
													Deny
												</button>
											{{ Form::close() }}
										</td>
										@endif
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- end .panel.panel-primary -->
    
		<!-- Deny modal -->
		@foreach($query as $cart)
			<div class="modal fade" id="denyModal{{ $cart->id }}" tabindex="-1" role="dialog" aria-labelledby="denyModalLabel{{ $cart->id }}" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="denyModalLabel{{ $cart->id }}">Please tell the customer, why the order is rejected.</h4>
						</div> <!-- end .modal-header -->

						<div class="modal-body">
							{{ Form::open(['url' => '/admin/order/delete']) }}
								{{ Form::hidden('id', $cart->id) }}
								{{ Form::hidden('user_id', $cart->user_id) }}

								<div class="form-group">
									<div class="row">
										{{ Form::label('message', 'Type your message here') }}
									</div>
									<div class="row">
										{{ Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Type your message here', 'id' => 'messagebox']) }}
									</div>
								</div>
								<button type="submit" class="btn btn-warning pull-right">
									Send & Deny order
									<span class="glyphicon glyphicon-arrow-right"></span>
								</button>
								<br>
							{{ Form::close() }}
						</div> <!-- end .modal-body -->

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div> <!-- end .modal-footer -->
					</div> <!-- end .modal-content -->
				</div> <!-- end .modal-dialog -->
			</div> <!-- end .modal.fade -->
		@endforeach
	</div>
</div>

	@section ('script')
		{{ HTML::script('redactor/redactor.js') }}

		<script>
		$("#messagebox").redactor({
			minHeight: 200,
			imageUpload: 'contentImage'
		});
		</script>
	@stop
	
@stop
