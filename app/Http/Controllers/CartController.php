<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;



class CartController extends Controller
{
    public function postAddToCart(Request $request)
    {


        $this->validate($request, [
            'quantity' => 'required|numeric',
            'product'  => 'required|numeric|exists:products,id'
        ]);

        $user_id = Auth::id();
        $product_id = Input::get('product');
        $quantity = Input::get('quantity');

        $product = Product::find($product_id);
        $total = $quantity*$product->price;

        $count = Cart::where('product_id', '=', $product_id)->where('user_id', '=', $user_id)->count();

        if($count){

            //return redirect('home')->with('error', 'The product is already in your cart!');
            return redirect('home')->with('status', 'The product is already in your cart!');
        }

        Cart::create(array(
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'total' => $total
        ));


        return redirect('cart');

    }

    public function showCart()
    {
        $user_id = Auth::user()->id;

        $cart_products = Cart::with('products')->where('user_id', '=', $user_id)->get();

        $cart_total = Cart::with('products')->where('user_id', '=', $user_id)->sum('total');

        if(!$cart_products){

            return redirect('home')->with('error', 'Your Cart is empty!');
        }

        return view('cart')
            ->with('cart_products', $cart_products)
            ->with('cart_total', $cart_total);
    }

    public function getDelete($id)
    {
        $cart = Cart::find($id)->delete();

        return Redirect::route('cart');
    }

    public function update()
    {
        $user_id = Auth::user()->id;

        $quantity = Input::get('quantity');

        $product_id = Input::get('product');

        $cart_id = Input::get('cart_id');

        // Find the ID of the products in the Cart
        $product = Product::find($product_id);

        $total = $quantity * $product->price;

        $cart = Cart::where('user_id', '=', $user_id)
            ->where('product_id', '=', $product_id)
            ->where('id', '=', $cart_id);

        //  Update the cart
        $cart->update(array(
            'user_id'    => $user_id,
            'product_id' => $product_id,
            'quantity'   => $quantity,
            'total'      => $total
        ));
        //dd($quantity);
        return redirect()->route('cart');
    }
}
