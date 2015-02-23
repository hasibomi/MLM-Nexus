@extends("Main.Boilerplate")

@section("title")
<title>Products</title>
@stop

@section("content")

    @include('Partials.Event')

	<section>
		<div class="container">

			<div class="row">
                {{-- Catagory sidebar --}}
                @include('Products.Partials.SidebarCatagory')

                {{-- Featured products --}}
                @include('Products.Partials.FeaturedProducts')
					
				</div>
			</div>
		</div>
	</section>
	
@stop