@extends('layouts.app')

@section('content')
<div class="row">

  @foreach($cart_products as $product)

  <div class="col-lg-2 col-md-4 mb-4" style="margin-bottom:10px;">
    <div class="card">
      <a href="{{action('ProductController@show',$product) }}" style="margin-top:20px;"><img class="card-img-top" src="/img/macbook.jpg" alt=""></a>
    </div>
  </div>
  <div class="col-lg-10 col-md-6">
    <div class="card-body">
      <h4 class="card-title">
        <a href="#">{{$product->name}}</a>
      </h4>
      <div>
        個数：
        {{--あとでjs--}}
        <select>
          <option>
            <h5>{{$product->productCount()}}</h5>
          </option>
        </select>
        <form action="{{action('UserController@changeOrderNumber',$product)}}" method="post">
          {{ csrf_field() }}
          <input placeholder="注文数の変更" name="number" type="number"/>
          <input name="product_id" value="{{$product->id}}" type="hidden"/>
          <input type="submit"/>
        </form>
        <h5>{{$product->presentPrice()}}</h5>
        <h5>金額{{$product->getSum()}}</h5>
      </div>
    </div>
  </div>
  @endforeach
</div>

<form method="get" action="{{action('CheckoutController@showCheckoutPage')}}">
  <button class="btn btn-success" style="float:right;">購入する</button>
</form>



@endsection
