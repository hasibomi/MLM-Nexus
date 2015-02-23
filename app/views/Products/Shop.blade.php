@extends("Main.Boilerplate")

@section("title")
<title>Products</title>
@stop

@section("content")
	
	<section>
		<div class="container">
            @include('Partials.Event')
			
			<div class="row">
				@if(Admin::isAdmin())
					<a href="{{ url("product/add") }}" class="btn btn-success">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Product
					</a>
				
					<a href="{{ url("catagory/add") }}" class="btn btn-warning">
						<span class="glyphicon glyphicon-plus-sign"></span> Add Catagory
					</a>

                    <a href="{{ url("subcatagory/add") }}" class="btn btn-info">
                        <span class="glyphicon glyphicon-plus-sign"></span> Add Sub Catagory
                    </a>
				@endif
			</div>
			
			<br>
			<br>

			<div class="row">

				{{-- Sidebar Catagory --}}
                @include('Products.Partials.SidebarCatagory')

                {{-- Featured Products --}}
                @include('Products.Partials.FeaturedProducts')
			</div>
		</div>
	</section>
	
@stop