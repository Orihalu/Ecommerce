@extends('layouts.app')

@section('content')
<div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">PC Shop</h1>
          <div class="list-group">

            <p>CSVファイルを選択してください</p>
<form role="form" method="post" action="csv-imports/csv" enctype="multipart/form-data">
{{ csrf_field() }}
    <input type="file" name="csv_file">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">インポート</button>
    </div>
</form>
            <a href="{{ action('ProductController@sortProduct', ['id' => 1]) }}" class="list-group-item">Category 1</a>

            <a href="{{ action('ProductController@sortProduct', ['id' => 2]) }}" class="list-group-item">Category 2</a>
            <a href="{{ action('ProductController@sortProduct', ['id' => 3]) }}" class="list-group-item">Category 3</a>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">


          <form method="post" class="form-inline" >
            {{ csrf_field() }}
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="name" aria-label="Search"/>
            <button class="btn btn-outline-success my-2 my-sm-0">Search</button>
          </form>


          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item">
                <img class="d-block img-fluid" src="/img/mac.png" alt="First slide">
              </div>
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="/img/mac.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="/img/mac.png" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="{{action('ProductController@show',$product) }}"><img class="card-img-top" src="/img/macbook.jpg" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">{{$product->name}}</a>
                  </h4>
                  <h5>{{$product->detail}}</h5>
                  <h5>{{$product->presentPrice()}}</h5>
                  <p class="card-text">{{$product->description}}</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">★ ★ ★ ★ ☆</small>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
@endsection
