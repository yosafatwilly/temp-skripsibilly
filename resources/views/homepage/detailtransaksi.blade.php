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
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('cart/myorder')}}">My Orders</a></li>
          <li class="breadcrumb-item active">Order #{{ $transaction->code}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row bar">
      <div id="customer-order" class="col-lg-12">
        {{-- @if ($transaction->status_pembayaran != 'Lunas')
          <p class="text-center">Silahkan lakukan pembaran melalui no Rekening 0232434. <br>Apabila sudah melakukan
            pembayaran, silahkan lakukan konfirmasi melalui link di bawah ini</p>
          <br>
          <div class="text-center"> --}}
        {{-- <a href="https://api.whatsapp.com/send?phone=6288227666697&text=Konfirmasi%20Pembayaran%20%28%23{{$transaction->code}}%29%0ATransfer%20Melalui%20Bank%20%3A%20%0ANama%20Rekening%20%3A%0ANomor%20Rekening%20%3A%0AJumlah%20Transfer%20%3A"
        class="btn btn-success">Konfirmasi (Whatsapp)</a> --}}
        {{-- <form action="{{ route('cart.confirm', $transaction->code)}}" method="POST">
        @csrf
        <button type="submit">Konfirmasi</button>
        </form>
      </div>
      @endif --}}

      <div>
        <div class="heading">
          <h3 class="text-uppercase">Detail Pembelian</h3>
        </div>
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
        <div class="row addresses">
          <div class="col-md-6">
            <h3>Penerima</h3>
            <p> {{ $transaction->name }}<br>
              {{ $transaction->address['address'] }},
              {{ $transaction->address['village'] }}<br>
              Status Pembayaran : {{$transaction->status_pembayaran}}
            </p>
          </div>
        </div>
        <hr>
        <div class="row bar" style="margin-top: -50px">
          <div id="customer-account" class="col-lg-12 clearfix">
            <p class="lead">Terimakasih sudah belanja di toko kami. Setelah melakukan pembayaran pada salah satu bank
              dibawah ini, segera lakukan konfirmasi pembayaran dengan mengisi form dibawah ini, paling lambat 1 x 24
              jam setelah pemesanan.</p>
            <div class="bo3">
              <div class="heading">
                <h3 class="text-uppercase">Rekening</h3>
              </div>
              <div class="row services text-center">
                <div class="col-md-4">
                  <div class="box-simple">
                    <div class="icon-outlined"><i> <img src="{{ asset('static/bank/bri.jpg')}}" alt=""></i></div>
                    <h3 class="h4">BRI</h3>
                    <p>a/n Toko Lestari</p>
                    <p>0000.0000.0000.0000</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-simple">
                    <div class="icon-outlined"><i><img src="{{ asset('static/bank/bca.jpg')}}" alt=""></i></div>
                    <h3 class="h4">BCA</h3>
                    <p>a/n Toko Lestari</p>
                    <p>0000.0000.0000.0000</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-simple">
                    <div class="icon-outlined"><i><img src="{{ asset('static/bank/mandiri.jpg')}}" alt=""></i></div>
                    <h3 class="h4">MANDIRI</h3>
                    <p>a/n Toko Lestari</p>
                    <p>0000.0000.0000.0000</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row bar" style="margin-top: -90px">
          <div id="customer-account" class="col-lg-12 clearfix">
            <div class="bo3">
              <div class="heading">
                <h3 class="text-uppercase">Konfirmasi Pembayaran</h3>
              </div>
              <form>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="firstname">ORDER ID</label>
                      <input id="firstname" type="text" class="form-control" value="{{ $transaction->code}}" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lastname">Tanggal Pembayaran</label>
                      <input id="lastname" type="date" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company">Rekening a/n</label>
                      <input id="company" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="street">No. Rekening</label>
                      <input id="street" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company">Jumlah Transfer</label>
                      <input id="company" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company">Transfer ke Bank</label>
                      <select name="" id="" class="form-control">
                        <option value="">BCA (a/n Toko Lestari)</option>
                        <option value="">BRI (a/n Toko Lestari)</option>
                        <option value="">Mandiri (a/n Toko Lestari)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company">Catatan</label>
                      <textarea id="company" type="text" class="form-control"> </textarea>
                    </div>
                  </div>
                  <div class="col-md-6  col-lg-3">
                    <div class="form-group">
                      <label for="company">Upload Bukti Transfer</label>
                      <input id="company" type="file" class="form-control">
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i>
                      Konfirmasi Pembayaran</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
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