<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        @if($products->count() == 0)
            <h2>No products found</h2>
        @else
            <h2 class="title text-center">Featured</h2>
            @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                {{ HTML::image('assets/images/shop/'.$product->image, $product->name, ['width'=>'200', 'height'=>'200']) }}
                                <h2>{{ $product->name }}</h2>
                                <p>{{ $product->price }} ৳</p>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    @if (! Auth::user())
                                        <h2>
                                            {{ HTML::link('products/view/'.$product->slug, $product->name) }}
                                        </h2>
                                        <p>
                                            {{ HTML::link('products/view/'.$product->slug, $product->price) }} ৳
                                        </p>
                                    @elseif (Auth::user() && Auth::user()->type != 'admin')
                                        <h2>
                                            {{ HTML::link('products/view/'.$product->slug, $product->name) }}

                                        </h2>
                                        <p>
                                            {{ HTML::link('products/view/'.$product->slug, $product->price) }} ৳
                                        </p>
                                    @endif
                                    @if (! Auth::user())
                                        <a href="{{ url('login') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    @elseif (Auth::user()->type == 'admin')
                                    @else
                                        {{ Form::open(['url'=>'products/add-to-cart']) }}
                                        {{ Form::hidden('id',$product->id) }}
                                        {{ Form::hidden('catagory',$product->catagory_id) }}
                                        <?php
                                            $key = 'kiobostha?kiobos';
                                            $price = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $product->price, MCRYPT_MODE_ECB)));
                                        ?>
                                        {{ Form::hidden('price', $price) }}
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
                                @if(Admin::isAdmin())
                                    <li><a class="btn btn-info" href="{{ url("products/view/" . $product->slug) }}" style="color: #fff;"><span class="glyphicon glyphicon-edit"></span>Edit</a></li>
                                    <li><a class="btn btn-danger" style="color: #fff;" href="{{ url("products/delete/" . $product->slug) }}"><i class="glyphicon glyphicon-trash"></i>Delete</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div><!--features_items-->

    <div class="row">
        {{ $products->links() }}
    </div>

</div>