@extends('homepage.layout.master')
@section('header')
<title> {{ $products->name }} - Toko Lestari</title>
@endsection
@section('slide')

@endsection
@section('content')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">{{ $products->name }}</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar">
      <div class="col-md-9">
        <div id="productMain" class="row">
          <div class="col-sm-6">
            <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
              <div> <img src=" {{ url($products->photo) }}" alt="" class="img-fluid"></div>
              {{--  <div> <img src="img/detailbig2.jpg" alt="" class="img-fluid"></div>
                    <div> <img src="img/detailbig3.jpg" alt="" class="img-fluid"></div> --}}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="box">
              <form action="{{ url('cart') }}" method="POST">
                {{ @csrf_field() }}
                <p class="price" style="margin:0px 0px;">Rp.{{ number_format($products->price,2,",",".") }}</p>
                <br>
                @if($products->stock <1 )
                   <p class="text-center">Stock Habis</p>
                @else
                  <div class="form-group col-6 offset-3">
                      <select class="form-control" name="qty">
                        @for ($i = 1; $i <= $products->stock; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                  @endif
                  <input type="hidden" name="id" value="<?php echo $products->id;?>">
                  <br><br>
                  <p class="text-center">
                    @if(Auth::user())
                      @if(!$products->stock < 1) 
                        <button type="submit" class="btn btn-template-outlined"><i
                        class="fa fa-shopping-cart"></i> Add to cart</button>
                      @endif
                    @else
                      <small>Login dahulu untuk melakukan transaksi</small>
                    @endif
                  </p>
              </form>
            </div>
            <div data-slider-id="1" class="owl-thumbs">
              <button class="owl-thumb-item"><img src="img/detailsquare.jpg" alt="" class="img-fluid"></button>
              <button class="owl-thumb-item"><img src="img/detailsquare2.jpg" alt="" class="img-fluid"></button>
              <button class="owl-thumb-item"><img src="img/detailsquare3.jpg" alt="" class="img-fluid"></button>
            </div>
          </div>
        </div>
        <div id="details" class="box mb-4 mt-4">
          <h4>Category</h4>
          {{ $products->category->name }}
          <br><br>
          <h4>Product details</h4>
          {!! $products->description !!}
        </div>
      </div>
      <div class="col-md-3">
        <!-- MENUS AND FILTERS-->
        <div class="panel panel-default sidebar-menu">
          <div class="panel-heading">
            <h3 class="h4 panel-title">Categories</h3>
          </div>
          <div class="panel-body">
            <ul class="nav nav-pills flex-column text-sm category-menu">
              @foreach($category as $cat)
              <li class="nav-item"><a href="{{ url('/category/'.$cat->slug) }}"
                  class="nav-link active d-flex align-items-center justify-content-between"><span> {{ $cat->name }}
                  </span><span class="badge badge-light">{{ count($cat->children)}}</span></a>
                <ul class="nav nav-pills flex-column">
                  @foreach($cat ->children as $sub)
                  <li class="nav-item"><a href="{{ url('/category/'.$sub->slug) }}" class="nav-link">
                      {{ $sub->name }}</a></li>
                  @endforeach
                </ul>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')

@endsection