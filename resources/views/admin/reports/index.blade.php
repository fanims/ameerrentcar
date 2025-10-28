@extends('admin.layout.layout')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form method="GET" action="{{ route('admin.reports.orders') }}" class="row g-3">
                <div class="col-md-3">
                    <label>Car</label>
                    <select name="car_id" class="form-control">
                        <option value="">All</option>
                        @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ request('car_id')==$car->id ? 'selected' : '' }}>{{
                            $car->name['en'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">All</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id')==$brand->id ? 'selected' : '' }}>{{
                            $brand->name
                            }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Customer</label>
                    <select name="user_id" class="form-control">
                        <option value="">All</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id')==$user->id ? 'selected' : '' }}>{{
                            $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Order Status</label>
                    <select name="status" class="form-control">
                        <option value="">Completed (default)</option>
                        <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Completed
                        </option>
                        <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="">All</option>
                        <option value="paid" {{ request('payment_status')=='paid' ? 'selected' : '' }}>Paid</option>
                        <option value="cod" {{ request('payment_status')=='unpaid' ? 'selected' : '' }}>Unpaid</option>
                        {{-- <option value="cancelled" {{ request('payment_status')=='cancelled' ? 'selected' : '' }}>
                            Cancelled</option>
                        <option value="failed" {{ request('payment_status')=='failed' ? 'selected' : '' }}>Failed
                        </option> --}}
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>

                <div class="col-md-3">
                    <label>Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>

                <div class="col-md-3 align-self-end mt-1">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <hr>

            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Car</th>
                                {{-- <th>Brand</th> --}}
                                <th>Customer</th>
                                <th>Order Status</th>
                                <th>Booking Date</th>
                                <th>Payment Status</th> <!-- New -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->car->name['en'] ?? '-' }}</td>
                                <td>{{ $order->user->name ?? $order->user_id }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'danger' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M, Y') }}</td>
                                {{-- <td>{{ number_format($order->grand_total, 2) }} AED</td> --}}
                                <td>
                                    <span
                                        class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No orders found for this filter.</td>
                            </tr>
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Car</th>
                                {{-- <th>Brand</th> --}}
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Booking Date</th>
                                <th>Payment Status</th> <!-- New -->
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            @if($orders->count())
            <p style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="5" class="text-right">Total Grand Amount:</td>
                <td>{{ number_format($totalGrand, 2) }} AED</td>
                <td></td>
            </p>
            @endif
        </div>
    </section>
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

<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush