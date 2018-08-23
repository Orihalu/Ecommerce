@extends('layouts.app')


@section('content')

{{--dd($user->products())--}}

<div class="row">
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="#"><img class="card-img-top" src="/img/macbook.jpg" alt=""></a>

      <div class="card-footer">
        <small class="text-muted">★ ★ ★ ★ ☆</small>
      </div>
    </div>
  </div>

  <div class="col-lg-8 col-md-6">
    <div class="card-body">
      <h4 class="card-title">
        <a href="#">{{$product->name}}</a>
      </h4>
      <h5>{{$product->detail}}</h5>
      <h5>{{$product->price}}</h5>
      <select class="form-control; col-lg-1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
      </select>
      <div style="margin-top:10px;">
        <form method="post" action="{{action('UserController@add_to_cart',$product)}}">
          {{ csrf_field() }}
        <button class="btn btn-primary">Add to Cart</button>
      </form>
      </div>
      <p class="card-text">{{$product->description}}</p>
    </div>
   </div>
</div>

<div class="col-lg-12 col-md-6">
  <div class="card-body">

    <h5>{{$product->detail}}</h5>
    <h5>{{$product->price}}</h5>
    <p class="card-text">{{$product->description}}</p>
  </div>
 </div>


@endsection
