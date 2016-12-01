<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function postOrder(Request $request)
    {
        $this->validate($request, [
            'delivery_address' => 'required',
        ]);

        $user_id = Auth::id();
        $delivery_address = Input::get('delivery_address');

        $cart_products = Cart::with('Products')->where('user_id', '=', $user_id)->get();

        $cart_total = Cart::with('Products')->where('user_id', '=', $user_id)->sum('total');

        if(!$cart_products){
            return redirect('home')->with('status', 'Your cart is empty!');
        }

        $order = Order::create(array(
                'user_id' => $user_id,
                'delivery_address' => $delivery_address,
                'total'   => $cart_total,
            ));

        foreach ($cart_products as $order_products) {

            $order->orderItems()->attach($order_products->product_id, array(
                'quantity' => $order_products->quantity,
                'price' => $order_products->Products->price,
                'total' => $order_products->Products->price*$order_products->quantity
            ));
        }

        Cart::where('user_id', '=', $user_id)->delete();

        return redirect('home')->with('status', 'Your order processed successfully!');


    }

    public function getIndex()
    {
        $user_id = Auth::id();

        $orders = Order::with('orderItems')->where('user_id', '=', $user_id)->get();
        if(!$orders) {
            return redirect('home')->with('status', 'There is no order.');
        }

        return view('orders')->with('orders', $orders);

    }
}
