@extends('layouts.app')


@section('content')
@if (session('exclusive_lock_exception'))
    <div class="alert alert-success" role="alert">
        {{ session('exclusive_lock_exception') }}
    </div>

@endif

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
      <h5>{{$product->presentPrice()}}</h5>
      <form method="post" action="{{action('UserController@addToCart',$product)}}">

        <select class="form-control; col-lg-1"　name="order">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>

        <div style="margin-top:10px;">
            {{ csrf_field() }}
          <button class="btn btn-primary">Add to Cart</button>
          <input type="hidden" name="updated_at" value="{{ $product->updated_at }}"/>
        </div>
      </form>
      <p class="card-text">{{$product->description}}</p>
    </div>
   </div>
</div>




@endsection
