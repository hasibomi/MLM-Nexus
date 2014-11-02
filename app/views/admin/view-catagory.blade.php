@extends('admin.layouts.main')

@section('content')
	
	<section id="cart_items">
		<div class="container">
			@if (Session::has('event'))
				{{ Session::get('event') }}
			@endif
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Name</td>
							<td class="description">Assigned To</td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if ( $catagories->count() == 0 )
							<tr>
								<td col-span="3">No catagories has been added yet.</td>
							</tr>
						@else
							@foreach ($catagories as $catagory)
								<tr>
									<td class="cart_description"><h4><a href="javascript:;">{{ $catagory->catagory_name }}</a></h4></td>
									<td class="cart_description"><h4><a href="javascript:;">{{ $catagory->catagory_type }}</a></h4></td>
									<td class="cart_description">
										<h4>
											<a href="/admin/edit_catagory/{{ $catagory->id }}" >Edit</a>
										</h4>
									</td>
									<td class="cart_delete"><a class="cart_quantity_delete" href="/admin/delete_catagory/{{ $catagory->id }}"><i class="fa fa-times"></i></a></td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</section>
	
@stop
