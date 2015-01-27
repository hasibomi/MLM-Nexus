@extends("Main.Boilerplate")
@section("content")

<section>
    <div class="container">
        <div class="row">
            @if (Session::has('event'))
            {{ Session::get('event') }}
            @endif
            @if ($errors->all())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
        </div>
        <div class="row">
            @if (count($query) > 0)
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    @foreach($query as $catagory)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            @if($catagory->catagory_type != 'Main catagory')
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $catagory->id }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $catagory->catagory_name }}
                            </a>
                            @else
                            {{ HTML::link('/mlm/products/all/'.$catagory->id, $catagory->catagory_name) }}
                            @endif
                            </h4>
                        </div>
                        <div id="{{ $catagory->id }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @if($catagory->catagory_type == 'Main catagory')
                                    @else
                                    <li><a href="/mlm/products/all/{{ $catagory->id }}">{{ $catagory->catagory_type }} </a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div><!--/category-products-->
                </div>
            </div>
            @endif
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Features Items</h2>
                @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                {{ HTML::image('images/shop/'.$product->image, $product->name, ['width'=>'200', 'height'=>'200']) }}
                                <h2>{{ $product->name }}</h2>
                                <p>{{ $product->price }} ৳</p>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    @if (! Auth::user())
                                    <h2>
                                    {{ HTML::link('/mlm/products/view/'.$product->id, $product->name) }}
                                    </h2>
                                    <p>
                                    {{ HTML::link('/mlm/products/view/'.$product->id, $product->price) }} ৳
                                    </p>
                                    @elseif (Auth::user() && Auth::user()->type != 'admin')
                                    <h2>
                                    {{ HTML::link('/mlm/products/view/'.$product->id, $product->name) }}
                                    
                                    </h2>
                                    <p>
                                    {{ HTML::link('/mlm/products/view/'.$product->id, $product->price) }} ৳
                                    </p>
                                    @endif
                                    @if (! Auth::user())
                                    <a href="/login" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    @elseif (Auth::user()->type == 'admin')
                                    @else
                                    {{ Form::open(['url'=>'/products/add-to-cart']) }}
                                    {{ Form::hidden('id',$product->id) }}
                                    {{ Form::hidden('catagory',$product->catagory) }}
                                    {{ Form::hidden('quantity', '1') }}
                                    <button class="btn btn-default add-to-cart" type="submit">
                                    <i class="fa fa-shopping-cart"></i> Add to cart
                                    </button>
                                    {{ Form::close() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                </div><!--features_items-->
                
            </div>
        </div>
    </div>
</section>

@stop