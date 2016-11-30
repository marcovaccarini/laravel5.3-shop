@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="span12">
            <div class="row">
                con status
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <ul class="thumbnails">
                    @foreach($products as $product)
                        <li class="span4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3>{{$product->product_name}}</h3>
                                    <p>Brand: <b>{{$product->description}}</b></p>
                                    <p>Price: <b>{{$product->price}}</b> </p>
                                    <form action="/cart/add" name="add_to_cart" method="post" accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product" value="{{$product->id}}" />
                                        <select name="quantity">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <p class="center">
                                            <button class="btn btn-info btn-block">Add to Cart</button></p>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

@stop
