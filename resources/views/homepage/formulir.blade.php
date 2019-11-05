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
        <h1 class="h2">Shopping Cart</h1>
      </div>
      <div class="col-md-5">
        <ul class="breadcrumb d-flex justify-content-end">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Shopping Cart</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row">
      <div id="checkout" class="col-lg-8">
        <p class="text-muted lead" style="margin-top: 30px; margin-bottom: -50px">You currently have {{ Cart::count() }}
          item(s) in your cart.</p>
        <div class="box border-bottom-0">
          <form action="{{ url('cart/transaction') }}" method="POST">
            {{ @csrf_field() }}
            <input id="ongkoskirim" type="hidden" name="ongkoskirim">
            <div class="content">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="firstname">Nama(Member)</label>
                    <input id="firstname" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="lastname">Email(Member)</label>
                    <input id="lastname" type="text" class="form-control" value="{{ Auth::user()->email }}" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama Penerima</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Penerima"
                      value="{{ Auth::user()->name }}" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>No. Handphone Penerima</label>
                    <input type="text" name="phone" class="form-control" placeholder="Masukkan No Handphone"
                      value="{{ Auth::user()->phone }}" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" name="address" class="form-control" required
                      placeholder="Masukkan Alamat">{{ Auth::user()->address['address'] }}</textarea>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="firstname">Daerah</label>
                    <select class="form-control" onchange="check()" id="city" name="village" required>
                      <option value="">Pilih Daerah</option>
                      @php
                      $daerah = daerah();
                      @endphp
                      @foreach($daerah as $d)
                      <option @if(Auth::user()->address['village'] == $d['tujuan'])
                        selected="selected"
                        @endif value="{{ $d['tujuan'] }}">{{ $d['tujuan'] }} </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <select class="form-control" name="payment" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="cod">Cash On Delivery (COD)</option>
                        <option value="bank_transfer">Transfer Bank</option>
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
              <div class="left-col"><a href="shop-basket.html" class="btn btn-secondary mt-0"><i
                    class="fa fa-chevron-left"></i>Back to basket</a></div>
              <div class="right-col">
                <button type="submit" class="btn btn-template-main">Continue to Delivery Method<i
                    class="fa fa-chevron-right"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-4">
        <div id="order-summary" class="box mb-4 p-0">
          <div class="box-header mt-0">
            <h3>Order summary</h3>
          </div>
          <p class="text-muted text-small">Shipping and additional costs are calculated based on the values you have
            entered.</p>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Order subtotal</td>
                  <th>{{ number_format(Cart::total(null, null, ''),2,",",".") }}</th>
                </tr>
                <tr>
                  <td>Ongkos Kirim</td>
                  <th id="ong">-</th>
                </tr>
                <tr class="total">
                  <td>Total</td>
                  <th id="total">{{ number_format(Cart::total(null, null, ''),2,",",".") }}</th>
                </tr>
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
<script type="text/javascript">
  function check (){
      var tujuan = $("#city").val();
      $.ajax({
        type: "GET",
        url : "{{ url('checkongkir/') }}/"+tujuan,
        dataType : "JSON",
        success:function(data){
          $("#ong").text(currencyFormat(data));
          $("#ongkoskirim").val(data);
          console.log();
          $('#total').text(currencyFormat({{Cart::total(null,null,'')}}+data));
        }
      });
    }
    function currencyFormat(num) {
      return  num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }
    $(window).on('load', check());
</script>
@endsection
@show