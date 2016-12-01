@extends('layouts.main')

@section('content')

    <div class="container">
        <h1>Your Orders</h1>
        con status
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="menu">
            <div class="accordion">
                @foreach($orders as $order)
                    <div class="accordion-group">
                        <div class="accordion-heading country">
                            <h4>
                                Order: Order #{{$order->id}} - {{$order->created_at}}
                            </h4>
                        </div>
                        <div class="accordion-body" id="order{{$order->id}}">
                            <div class="accordion-inner">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{$orderItem->product_name}}</td>
                                            <td>{{$orderItem->pivot->quantity}}</td>
                                            <td>{{$orderItem->pivot->price}}</td>
                                            <td>{{$orderItem->pivot->total}}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total</b></td>
                                            <td><b>{{$order->total}}</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Shipping address</b></td>
                                            <td>{{$order->delivery_address}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

@stop
