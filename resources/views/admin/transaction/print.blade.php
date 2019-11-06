<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice #{{ $transaction->code }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('static/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('static/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('static/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('static/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('static/dist/css/skins/_all-skins.min.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Toko Lestari.
            <small class="pull-right">Tanggal: {{ $transaction->created_at }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Pengirim
          <address>
            <strong>Toko Lestari</strong><br>
            JL. PROVINSI KOTA, PAAL, NANGA PINOH<br>
            KABUPATEN MELAWI<br>
            KALIMANTAN BARAT 79672<br>
            Phone : 0812-5404-4616
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Penerima
          <address>
            <strong>{{ $transaction->name}}</strong><br>
            {{ $transaction->address['address'] }}<br>
            {{ $transaction->address['village'] }}<br>
            Phone : {{ $transaction->phone}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #{{ $transaction->code }}</b><br>
          <br>
          <b>Status Pembayaran:</b> {{strtoupper($transaction->status_pembayaran)}}<br>
          <b>Nama Member:</b> {{$transaction->user->name}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nama Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tbody>
              @php
              $gt = 0;
              @endphp
              @foreach($transactiondetail as $td)
              <tr>
                <td> {{ $td->product->name }}</td>
                <td>{{ $td->qty }}</td>
                <td>Rp.{{ number_format($td->product->price,2,",",".") }}</td>
                <td>Rp.{{ number_format($td->subtotal,2,",",".") }}</td>
              </tr>
              <?php $gt = $gt + $td->subtotal;?>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Metode Pembayaran: <i>{{ $transaction->payment_method }}</i></p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Jumlah Tagihan</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rp.{{ number_format($gt,2,",",".") }}</td>
              </tr>
              <tr>
                <th>Ongkir:</th>
                <td>Rp.{{ number_format($transaction->ongkir) }}</td>
              </tr>
              <tr>
                <th>Grand Total:</th>
                <td>Rp.{{ number_format($gt + $transaction->ongkir, 2, ",", ".") }}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
</body>

</html>