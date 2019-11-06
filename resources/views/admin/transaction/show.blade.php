@extends('admin.layout.master')
@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('static/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style type="text/css">
  .table_list {
    list-style: none;
    padding: 4px;
    margin-left: -30px;
  }
</style>
<title>Detail Transaksi - Tumbas.id</title>
@endsection
@section('body')
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

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="{{ route('transaction.print', $transaction->code) }}" target="_blank" class="btn btn-default"><i
          class="fa fa-print"></i> Print</a>
    </div>
  </div>

  @endsection
  @section('footer')
  <!-- DataTables -->
  <script src="{{ asset('static/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('static/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  </script>
  @endsection
  @show