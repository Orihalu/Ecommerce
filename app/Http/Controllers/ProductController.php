<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Carbon\Carbon;
use Auth;

class ProductController extends Controller
{
  public function index() {
    $products = Product::all();
    return view('home')->with('products',$products);
  }

  public function show(Product $product) {
    return view('products.show')->with('product',$product);

  }

  public function search(Request $request) {
    $keyword = $request->name;
    $query = Product::query();
    if(!empty($keyword)) {
      $query->where('name','like','%'.$keyword.'%');
    }
    $products = $query->latest()->get();
    return view('home')->with('products',$products)->with('keyword',$keyword);
  }

  public function sortProduct(Request $request) {
    $all_products = Product::all();
    $products = $all_products->where('category_id', $request->id);
    // dd($sorted_products);
    return view('home')->with('products',$products);
  }

}
