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
        <h1 class="h2">Order # {{ $transaction->code}}</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('cart/myorder')}}">My Orders</a></li>
          <li class="breadcrumb-item active">Order # 1735</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar">
      <div id="customer-order" class="col-lg-12">
        @if ($transaction->status_pembayaran != 'Lunas')
          <p class="text-center">Silahkan lakukan pembaran melalui no Rekening 0232434. <br>Apabila sudah melakukan
            pembayaran, silahkan lakukan konfirmasi melalui link di bawah ini</p>
          <br>
          <div class="text-center">
              <a href="https://api.whatsapp.com/send?phone=6288227666697&text=Konfirmasi%20Pembayaran%20%28%23{{$transaction->code}}%29%0ATransfer%20Melalui%20Bank%20%3A%20%0ANama%20Rekening%20%3A%0ANomor%20Rekening%20%3A%0AJumlah%20Transfer%20%3A"
              class="btn btn-success">Konfirmasi (Whatsapp)</a>
              
          </div>
        @endif
        <div class="box">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2" class="border-top-0">Product</th>
                  <th class="border-top-0">Qty</th>
                  <th class="border-top-0">Price</th>
                  <th class="border-top-0">Sub Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                $gt = 0;
                @endphp
                @foreach($transactiondetail as $td)
                <tr>
                  <td> <img src="{{ url($td->product->photo) }}" alt="Black Blouse Armani" class="img-fluid"> </td>
                  <td> {{ $td->product->name }}</td>
                  <td>{{ $td->qty }}</td>
                  <td>{{ number_format($td->product->price,2,",",".") }}</td>
                  <td>{{ number_format($td->subtotal,2,",",".") }}</td>
                </tr>
                <?php $gt = $gt + $td->subtotal;?>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4" class="text-right ">Order Subtotal</th>
                  <th>{{ number_format($gt,2,",",".") }}</th>
                </tr>
                <tr>
                  <th colspan="4" class="text-right">Ongkir</th>
                  <th>{{ number_format($td->ongkir,2,",",".") }}</th>
                </tr>
                <tr>
                  <th colspan="4" class="text-right">Grand Total</th>
                  <th>{{ number_format($gt + $td->ongkir,2,",",".") }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
          {{-- <div class="row addresses">
            <div class="col-md-6 text-right">
              <h3 class="text-uppercase">Pengirim</h3>
              <p>
                {{ $transaction->product->user->name }}<br>
                {{ $transaction->product->user->address }}<br>
                {{ $transaction->ekspedisi['name'] }} <br>
                {{ $transaction->ekspedisi['etd'] }} day <br>
              </p>
            </div>
            <div class="col-md-6 text-right">
              <h3 class="text-uppercase">Penerima</h3>
              <p> {{ $transaction->name }}(<strong>{{ $transaction->user->name}})</strong><br>
                {{ $transaction->address }}<br>
                {{ $transaction->portal_code }}<br>
                @if($transaction->status == 0)
                Belum
                @else
                Lunas
                @endif
              </p>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')

@endsection
@show