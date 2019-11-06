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
<title>Transaction - Tumbas.id</title>
@endsection
@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Transaction</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="30px">No</th>
              <th>Code</th>
              <th>Member</th>
              <th>Penerima</th>
              <th>Alamat</th>
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
              <td>{{ $transactions->user->name }}</td>
              <td>{{ $transactions->name }}</td>
              <td>{{ $transactions->address['address'] }}, {{ $transactions->address['village'] }} </td>
              <td>{{ $transactions->payment_method }} </td>
              <td>
                <div class="btn-group">
                  {!! 
                    $color = '';
                      if ($transactions->status_pembayaran == 'Lunas')
                        $color = 'info';
                      else {
                        $color = 'danger';
                      }
                  !!}
                  <button type="button" class="btn btn-{{$color}}">{{$transactions->status_pembayaran}}</button>
                  <button type="button" class="btn btn-{{$color}} dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('transaction.statusbayar', [$transactions->code, 'Belum Lunas']) }}">Belum Lunas</a></li>
                    <li><a href="{{ route('transaction.statusbayar', [$transactions->code, 'Lunas']) }}">Lunas</a></li>
                  </ul>
                </div>
              </td>
              <td>
                <div class="btn-group">
                  {!! 
                    $color = '';
                      if ($transactions->status_pengiriman == 'Belum Dikirim')
                        $color = 'danger';
                      elseif ($transactions->status_pengiriman == 'Sedang Dikirim') {
                        $color = 'warning';
                      }
                      else {
                        $color = 'info';
                      }
                  !!}
                  <button type="button" class="btn btn-{{$color}}">{{$transactions->status_pengiriman}}</button>
                  <button type="button" class="btn btn-{{$color}} dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('transaction.statuskirim', [$transactions->code, 'Belum Dikirim']) }}">Belum Dikirim</a></li>
                    <li><a href="{{ route('transaction.statuskirim', [$transactions->code, 'Sedang Dikirim']) }}">Sedang Dikirim</a></li>
                    <li><a href="{{ route('transaction.statuskirim', [$transactions->code, 'Telah Diterima']) }}">Telah Diterima</a></li>
                  </ul>
                </div>
              </td>
              <td>
                <a href="{{ route('transaction.show', $transactions->code) }}" class="btn btn-sm btn-success">Detail</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

<!-- /.box -->
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