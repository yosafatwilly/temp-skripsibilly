@extends('homepage.layout.master')
@section('header')
<title>Toko Lestari - Jual Bahan Bangunan</title>

@endsection
@section('slide')

@endsection
@section('content')
<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-7">
        <h1 class="h2">My Orders</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">My Orders</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar mb-0">
      <div id="customer-orders" class="col-md-12">
        <div class="box mt-0 mb-lg-0">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="30px">No</th>
                  <th>Code</th>
                  <th>Tanggal Pembelian</th>
                  <th>Metode Pembayaran</th>
                  <th>Status Pembayaran</th>
                  <th>Status Pengiriman</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($transaction as $transactions)
                
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{$transactions->code}}</td>
                  <td>{{$transactions->created_at}}</td>
                  <td>
                    @if ($transactions->payment_method == 'cod')
                    Cash On Delivery (COD)
                    @else
                    Transfer Bank
                    @endif
                  </td>
                  <td><span @if ($transactions->status_pembayaran == 'Lunas')
                    style="color: black"
                    @else
                    style="color: red"
                  @endif>{{$transactions->status_pembayaran}}</span></td>
                  <td>
                    @if($transactions->status == 0)
                    <a href="#" class="badge badge-danger">Belum</a>
                    @else
                    <a href="#" class="badge badge-success">Sudah</a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ url('cart/detail/'.$transactions->code) }}"
                      class="btn btn-template-outlined btn-sm">Detail</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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