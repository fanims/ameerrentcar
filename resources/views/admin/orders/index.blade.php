@extends('admin.layout.layout')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card ">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Orders</h3> --}}
                            <form method="GET" class="">
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-3">
                                        <label for="start_date">From</label>
                                        <input type="date" id="start_date" name="start_date"
                                            value="{{ request('start_date') }}" class="form-control"
                                            placeholder="Start Date">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_date">To</label>
                                        <input type="date" id="end_date" name="end_date"
                                            value="{{ request('end_date') }}" class="form-control"
                                            placeholder="End Date">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        {{-- <a href="{{ route('orders.index') }}" class="btn btn-secondary">Reset</a>
                                        --}}
                                    </div>
                                </div>
                            </form>
                        </div>


                        @if(session('success'))
                        <div class="alert alert-success mt-1">
                            {{ session('success') }}
                        </div>

                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Customer</th>
                                        <th>Payment Method</th>
                                        <th>Car</th>
                                        <th>Grand Total</th>
                                        <th>Order At</th>
                                        <th>Change Status</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr class="{{ !$order->is_read ? 'table-secondary' : '' }}">
                                        <td>{{ $order->order_id }}</td>
                                        <td>
                                            <small>
                                                <b>Name:</b> {{ $order->full_name }}
                                            </small>
                                            <br>
                                            <small>
                                                <b>Email:</b> {{ $order->email }}
                                            </small>
                                            <br>
                                            <small>
                                                <b>Phone:</b> {{ $order->phone }}

                                            </small>
                                        </td>

                                        <td>
                                            <span class="badge {{ $order->payment_method == 'cod' ? 'badge-warning' : 'badge-success' }}">
                                                {{  $order->payment_status.'/'.$order->payment_method }}
                                            </span>
                                        </td>

                                        <td>{{ trans_field(optional($order->car)->name) ?? 'N/A' }}</td>

                                        <td><strong>{{ number_format($order->grand_total, 2) }} AED</strong></td>
                                        <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                        <td>

                                            <form class="d-inline" method="POST"
                                                action="{{ route('orders.update-status', $order->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-control form-control-sm"
                                                    onchange="this.form.submit()">
                                                    @foreach(['pending', 'confirmed', 'cancelled', 'completed']
                                                    as $status)
                                                    <option value="{{ $status }}" {{ $order->status == $status ?
                                                        'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>

                                            <form class="d-inline" method="POST"
                                                action="{{ route('orders.update-payment-status', $order->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="payment_status" class="form-control form-control-sm"
                                                    onchange="this.form.submit()">
                                                    @foreach(['paid', 'unpaid']
                                                    as $status)
                                                    <option value="{{ $status }}" {{ $order->payment_status == $status ?
                                                        'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="d-flex gap-2">

                                            {{-- View Button --}}
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-sm btn-info view-order-btn d-inline mx-1">
                                                View
                                            </a>

                                            {{-- Delete Button --}}
                                            <form class="d-inline" method="POST"
                                                action="{{ route('orders.destroy', $order->id) }}"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>

                                        </td>


                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Customer</th>
                                        <th>Payment Method</th>
                                        <th>Car</th>
                                        <th>Grand Total</th>
                                        <th>Order At</th>
                                        <th>Change Status</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@push('script')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


{{-- modal script --}}



{{-- end modal script --}}

<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "ordering": false // Disable ordering
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false, // Disable ordering
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



<script>
    $(document).ready(function () {
        $(document).on('click', '.view-order-btn', function () {
            $('#modalName').text($(this).data('name'));
            $('#modalEmail').text($(this).data('email'));
            $('#modalPhone').text($(this).data('phone'));
            $('#modalDOB').text($(this).data('dob'));
            $('#modalNationality').text($(this).data('nationality'));
            $('#modalCar').text($(this).data('car'));
            $('#modalPickup').text($(this).data('pickup'));
            $('#modalDropoff').text($(this).data('dropoff'));
            $('#modalDelivery').text($(this).data('delivery'));
            $('#modalReceiving').text($(this).data('receiving'));
            $('#modalLicense').text($(this).data('license'));
            $('#modalSpecial').text($(this).data('special'));
            $('#modalTotal').text($(this).data('total'));
        });

});
</script>

@endpush