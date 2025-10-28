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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <img style="height: 80px; width: 80px; border-radius:10px"
                                        src="{{ asset('assets/img/logo.png') }}" alt="">
                                    <small class="float-right">Date: {{ date('d-m-Y') }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>Ameer Luxury Rend Cars</strong><br>
                                    @php
                                    use App\Models\WebsiteSetting;
                                    $setting = WebsiteSetting::first();
                                    @endphp

                                    <br>
                                    {{ $setting->address ?? 'No Address' }}<br>
                                    Phone: {{ $setting->phone ?? 'No Phone' }}<br>
                                    Email: {{ $setting->email ?? 'No Email' }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{ $order->user ? $order->user->name : $order->full_name}}</strong><br>
                                    {{ $order->billing_address }}<br>
                                    {{-- San Francisco, CA 94107<br> --}}
                                    Phone: {{ $order->phone }}<br>
                                    Email: {{ $order->user ? $order->user->email : $order->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                {{-- <b>Invoice #007612</b><br> --}}
                                <br>
                                <b>Order ID:</b> {{ $order->order_id }}<br>
                                <b>Order Date:</b> {{ date('d-m-Y', strtotime($order->created_at)) }}<br>
                                <b>Nationality:</b> {{ $order->nationality }}<br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3"><strong>Customer Details</strong></h5>
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Status</th>
                                        <td>
                                            <span
                                                class="badge {{ $order->status == 'confirmed' ? 'badge-primary' : ($order->status == 'cancelled' ? 'badge-danger' : ($order->status == 'completed' ? 'badge-success' : 'badge-warning')) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status</th>
                                        <td>
                                            <span
                                                class="badge {{ $order->payment_status == 'pending' ? 'badge-warning' : ($order->payment_status == 'paid' ? 'badge-success' : 'badge-danger') }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nationality</th>
                                        <td>{{ $order->nationality }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ optional($order->date_of_birth)->format('d M Y') ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3"><strong>Rental & Vehicle Details</strong></h5>
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <th>Car</th>
                                        <td>{{ trans_field(optional($order->car)->name) ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Date</th>
                                        <td>{{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Time</th>
                                        <td>{{ $order->pickup_time }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dropoff Date</th>
                                        <td>{{ \Carbon\Carbon::parse($order->dropoff_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dropoff Time</th>
                                        <td>{{ $order->dropoff_time }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Location</th>
                                        <td>{{ $order->delivery_location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Receiving Location</th>
                                        <td>{{ $order->receiving_location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Has License</th>
                                        <td>{{ $order->has_international_license ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ordered At</th>
                                        <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">

                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td><strong>{{ number_format($order->grand_total, 2) }} AED</strong></td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>$5.80</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Total:</th>
                                            <td><strong>{{ number_format($order->grand_total, 2) }} AED</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button type="button" onclick="window.print();" class="btn btn-default">
                                    <i class="fas fa-print"></i> Print
                                </button>

                                {{-- <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button> --}}
                                {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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