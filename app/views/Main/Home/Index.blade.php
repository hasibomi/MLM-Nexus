@extends("Main.Boilerplate")

@section("title")
<title>Home</title>
@stop

@section("content")
	
	<!-- Slider -->
	@include('Partials.Slider')
	
	<section>
		<div class="container">
            {{-- Flash messages or errors --}}
            @include('Partials.Event')

			{{-- Dynamic content --}}
            <div class="row">
                <?php $contents = Content::where('call_name', '=', 'home')->where('active', '=', 1); ?>

                @if($contents->count() > 0)
                    <div class="product-information">
                        @foreach ($contents->get() as $content)
                            {{ $content->title }}
                            {{ $content->description }}
                        @endforeach
                    </div>

                    <br/>
                @endif
			</div>

			<div class="row">
			    {{-- Sidebar catagory --}}
                @include('Products.Partials.SidebarCatagory')

                {{-- Featured products --}}
				@include('Products.Partials.FeaturedProducts')
			</div>

            {{-- Pagination --}}
            <div class="row">
                {{ $products->links() }}
            </div>
		</div>
	</section>
	
@stop
