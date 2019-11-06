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
  <title>Product - Tumbas.id</title>
	@endsection
	@section('body')
  <div class="row">
    <div class="col-md-12">
       <div class="box">
    <div class="box-header">
      <h3 class="box-title">Product</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th width="30px">No</th>
          <th>Photo</th>
          <th>Product</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Price</th>
          <th>Supplier</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          @php
           $no = 1;
          @endphp
          @foreach($product as $item)
          <tr>
              <td>{{$no ++ }}</td>
              <td><img src="{{ url($item->photo) }}" width="50px"></td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->category->name }}</td>
              <td>{{ $item->stock }}</td>
              <td>{{ $item->price }}</td>
              @if (!$item->supplier == null)
                <td>{{ $item->supplier->name }}</td>
                @else
                <td>-</td>
              @endif
              <td>
                 <form action="{{ route('product.destroy',$item->id) }}" method="POST">
                <a href="{{ url('admin/product/'.$item->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>

                   {{ csrf_field() }}
                   {{ method_field("DELETE")}}
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
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
