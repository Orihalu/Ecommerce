<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Product;

class UserController extends Controller
{
    public function add_to_cart(Request $request,Product $product) {
      $order_number = $request->order;
      Auth::user()->add_to_cart($product,$order_number);
      return redirect()->back();
    }
}
