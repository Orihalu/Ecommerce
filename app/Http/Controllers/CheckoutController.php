<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class CheckoutController extends Controller
{
    public function showCheckoutPage(Request $request,Product $cart_products) {
      $cart_products = Auth::user()->uniqueProduct();

      return view('checkout.checkout')->with('cart_products',$cart_products);
    }


}
