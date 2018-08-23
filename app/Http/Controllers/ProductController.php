<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;

class ProductController extends Controller
{
  public function index() {
    $products = Product::all();
    return view('home')->with('products',$products);
  }

  public function show(Product $product) {

    return view('products.show')->with('product',$product);
    
  }
}
