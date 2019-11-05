@extends('homepage.layout.master')
@section('header')
<title>{{ $name }} - Toko Lestari</title>
@endsection
@section('slide')

@endsection
@section('content')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">{{ $name }}</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item "><a href="{{ url('product')}}">Product</a></li>
          <li class="breadcrumb-item active">{{ $name }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar">
      <div class="col-md-9">
        <div class="row products products-big">
          @if(count($products) > 0)
          @foreach($products as $product)
          <div class="col-lg-4 col-md-6">
            <div class="product">
              <div class="image"><a href="{{ url('product/detail/'.$product->slug) }}"><img
                    src="{{ url($product->photo) }}" alt="" class="img-fluid image1"></a></div>
              <div class="text">
                <h3 class="h5"><a href="{{ url('product/detail/'.$product->slug) }}">{{ $product->name }}</a></h3>
                <p class="price">Rp. {{ number_format($product->price) }}</p>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <h4>Product Tidak tersedia</h4>
          @endif
        </div>
        {{-- <div class="row">
          <div class="col-md-12 banner mb-small"><a href="#"><img src="img/banner2.jpg" alt="" class="img-fluid"></a>
          </div>
        </div> --}}
        <div class="pages">
          <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            {{ $products->links() }}
          </nav>
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
              <li class="nav-item">
                <a href="{{ url('/category/'.$cat->slug) }}"
                  class="nav-link active d-flex align-items-center justify-content-between">
                  <span> {{ $cat->name }} </span>
                  <span class="badge badge-light">{{ count($cat->children)}}</span>
                </a>
                <ul class="nav nav-pills flex-column">
                  @foreach($cat ->children as $sub)
                  <li class="nav-item">
                    <a href="{{ url('/category/'.$sub->slug) }}" class="nav-link">
                      {{ $sub->name }}
                    </a>
                  </li>
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

@show