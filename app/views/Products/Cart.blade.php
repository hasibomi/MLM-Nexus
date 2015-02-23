@extends("Main.Boilerplate")

@section("content")

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
			  <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="row">
            @if (Session::has('event'))
                {{ Session::get('event') }}
            @endif
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Catagory</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($query) == 0)
                        <tr>
                            <td colspan="6">Empty cart</td>
                        </tr>
                    @else
                        @foreach($query as $row)
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/images/shop/'.$row->product->image) }}" alt="" width="70" height="70">
                                </td>
                                <td>
                                    {{ $row->catagory->catagory_name }}
                                </td>
                                <td>
                                    {{ $row->product->price * $row->quantity }} ({{ $row->product->price }} X {{ $row->quantity }})
                                </td>
                                {{ Form::open(['url'=>'/cart/update']) }}
                                    <td>
                                        {{ Form::hidden('cat_id', $row->id) }}
                                        <input type="number" name="quantity" value="{{ $row->quantity }}">
                                        {{ Form::hidden('price', $row->product->price) }}
                                    </td>
                                    <td width="5%">
                                        {{ Form::submit('Update') }}
                                    </td>
                                {{ Form::close() }}

                                {{ Form::open(['url' => '/cart/delete']) }}
                                    <td>
                                        {{ Form::hidden('id', $row->id) }}
                                        <button type="submit" class="cart_quantity_delete"><i class="fa fa-times"></i></button>
                                    </td>
                                {{ Form::close() }}
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="pull-right">
                {{-- Show total price --}}
                @if (count($query) == 0)
                @else
                    <?php
                    $price = Cart::where('user_id', Auth::user()->id)->sum('price');
                    ?>
                    <p><strong>Total</strong> - ৳ {{ $price }}</p>
                    <p>
                        <a href="cart/cancel" class="btn btn-warning">Cancel</a>
                        <a href="cart/checkout" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Check out</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->

@stop