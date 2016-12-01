@extends('layouts.main')

@section('content')

    <div class="container">
        <h1>Your Cart</h1>
        con status
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <tbody>
            <tr>
                <td><b>Product</b></td>
                <td><b>Quantity</b></td>
                <td><b>Price</b></td>
                <td><b>Total</b></td>
                <td><b>Delete</b></td>
            </tr>
            @foreach($cart_products as $cart_item)
                <tr>
                    <td>{{$cart_item->Products->product_name}}</td>
                    <td>
                        <form action="/cart/update" method="post" class="form-inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="product" value="{{$cart_item->products->id}}" />
                            <input type="hidden" name="cart_id" value="{{$cart_item->id}}" />
                            <div class="form-group">
                                <input type="text" name="quantity" value="{{$cart_item->quantity}}">

                                <button class="btn btn-sm btn-default">Refresh</button>
                            </div>
                        </form>
                    </td>
                    <td>{{$cart_item->Products->price}}</td>
                    <td>{{$cart_item->total}}</td>
                    <td><a href="{{URL::route('delete_product_from_cart', array($cart_item->id))}}">Delete</a></td>


                </tr>
            @endforeach
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                    <b>Total</b>
                </td>
                <td>
                    <b>{{$cart_total}}</b>
                </td>
                <td>
                </td>
            </tr>
            </tbody>
        </table>
        <h1>Shipping</h1>
        <form action="/order" method="post" accept-charset="utf-8">
            {{ csrf_field() }}
            <label for="delivery_address">Address</label>
            <textarea name="delivery_address" id="" rows="5"></textarea>
            <button class="btn btn-block btn-primary btn-large">Place Order</button>
        </form>
    </div>

@stop
