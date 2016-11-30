<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;
use Illuminate\View\View;

class CartController extends Controller
{
    public function postAddToCart()
    {
        $rules = array(
            'quantity' => 'required|numeric',
            'product'  => 'required|numeric|exists:product,id'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::route('index')->with('error', 'The product could not been added to your cart!')
        }

        $user_id = Auth::user()->id;
        $product_id = Input::get('product');
        $quantity = Input::get('quantity');

        $product = Product::find($product_id);
        $total = $quantity*$product->price;

        $count = Cart::where('product_id', '=', $product_id)->where('user_id', '=', $user_id)->count();

        if($count){

            return Redirect::route('index')->with('error', 'The product is already in your cart!')
        }

        Cart::create(array(
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'total' => $total
        ));

        return Redirect::route('cart');

    }

    public function getIndex()
    {
        $user_id = Auth::user()->id;

        $cart_products = Cart::with('products')->where('user_id', '=', $user_id)->get();

        $cart_total = Cart::with('products')->where('user_id', '=', $user_id)->sum('total');

        if(!$cart_products){

            return Redirect::route('index')->with('error', 'Your Cart is empty!');
        }

        return View::make('cart')
            ->with('cart_products', $cart_products)
            ->with('cart_total', $cart_total);
    }

    public function getDelete($id)
    {
        $cart = Cart::find($id)->delete();

        return Redirect::route('cart');
    }
}
