<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Product;

class UserController extends Controller
{

    public function __construct() {
      $this->middleware('auth')->except('showCart');
    }

    public function addToCart(Request $request,Product $product) {
      $order_number = $request->order;
      Auth::user()->addToCart($product,$order_number);
      return redirect()->back();

    }

    public function changeOrderNumber(Request $request) {

      $product_id = $request->product_id;
      $order_number = $request->number;
      Auth::user()->changeOrderNumber($product_id, $order_number);
      return redirect()->back();

    }

    public function showCart() {
      if (Auth::check()) {
      $cart_products = Auth::user()->uniqueProduct();
      return view('carts.show')->with('cart_products', $cart_products);
    } else {
      return view('carts.show');
    }
  }
}
