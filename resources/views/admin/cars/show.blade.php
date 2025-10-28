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
                    <h1>Car Detail</h1>
                </div>
             
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
           <div class="row">
    <!-- Rental & Vehicle Details -->
    <div class="col-md-6">
        <h5 class="mb-3"><strong>Rental & Vehicle Details</strong></h5>
        <table class="table table-sm table-bordered">
            <tr><th>Car</th><td>{{ trans_field(optional($car)->name) ?? 'N/A' }}</td></tr>
            <tr><th>Car Type</th><td>{{ $car->car_type ?? 'N/A' }}</td></tr>
            <tr><th>Brand</th><td>{{ optional($car->brand)->name ?? 'N/A' }}</td></tr>
            <tr><th>Category</th><td>{{ optional($car->category)->getTranslatedName(30) ?? 'N/A' }}</td></tr>
            <tr><th>Model Year</th><td>{{ $car->model_year ?? 'N/A' }}</td></tr>
            <tr><th>Slug</th><td>{{ $car->slug ?? 'N/A' }}</td></tr>
            <tr><th>Base Price / Hour</th><td>{{ $car->base_price_per_hour }} AED</td></tr>
            <tr><th>Current Price / Hour</th><td>{{ $car->current_price_per_hour }} AED</td></tr>
            <tr><th>Base Price / Day</th><td>{{ $car->base_price_per_day }} AED</td></tr>
            <tr><th>Current Price / Day</th><td>{{ $car->current_price_per_day }} AED</td></tr>
            <tr><th>Base Price / Week</th><td>{{ $car->base_price_per_week }} AED</td></tr>
            <tr><th>Current Price / Week</th><td>{{ $car->current_price_per_week }} AED</td></tr>
            <tr><th>Base Price / Month</th><td>{{ $car->base_price_per_month }} AED</td></tr>
            <tr><th>Current Price / Month</th><td>{{ $car->current_price_per_month }} AED</td></tr>
            <tr><th>KM per Hour</th><td>{{ $car->km_per_hour }}</td></tr>
            <tr><th>KM per Day</th><td>{{ $car->km_per_day }}</td></tr>
            <tr><th>KM per Week</th><td>{{ $car->km_per_week }}</td></tr>
            <tr><th>KM per Month</th><td>{{ $car->km_per_month }}</td></tr>
            <tr><th>Persons Can Sit</th><td>{{ $car->persons_can_sit }}</td></tr>
            <tr><th>Seats Available</th><td>{{ $car->seats_available }}</td></tr>
            <tr><th>Number of Bags</th><td>{{ $car->number_of_bags }}</td></tr>
            <tr><th>Doors</th><td>{{ $car->doors }}</td></tr>
            <tr><th>Gear</th><td>{{ $car->gear }}</td></tr>
            <tr><th>Fuel</th><td>{{ $car->fuel }}</td></tr>
            <tr><th>Engine</th><td>{{ $car->engine }}</td></tr>
            <tr><th>Service Included</th><td>{{ $car->service_included ? 'Yes' : 'No' }}</td></tr>
        </table>
    </div>

    <!-- Images & Descriptions -->
    <div class="col-md-6">
        <h5 class="mb-3"><strong>Images & Descriptions</strong></h5>

        <!-- Thumbnail -->
        <div class="mb-3">
            <label><strong>Thumbnail Image:</strong></label><br>
            @if($car->thumbnail_image)
                <img src="{{ asset('storage/' . $car->thumbnail_image) }}" class="img-fluid img-thumbnail mb-2" width="300" alt="Thumbnail">
            @else
                <p>No thumbnail image available.</p>
            @endif
        </div>

        <!-- Other Images -->
        <div class="mb-3">
            <label><strong>Other Images:</strong></label>
            <div class="d-flex flex-wrap gap-2">
                @if($car->images)
                    @foreach($car->images as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid img-thumbnail mr-2 mb-2" width="100" alt="Other Image">
                    @endforeach
                @else
                    <p>No additional images uploaded.</p>
                @endif
            </div>
        </div>

        <!-- Colors -->
        <div class="mb-3">
            <label><strong>Interior Colors:</strong></label><br>
            @if($car->interior_colors)
                @foreach(json_decode($car->interior_colors) as $color)
                    <span class="badge rounded-pill" style="background-color: {{ $color }}; color: #fff;">&nbsp;&nbsp;&nbsp;</span>
                @endforeach
            @else
                <p>No interior colors defined.</p>
            @endif
        </div>

        <div class="mb-3">
            <label><strong>Exterior Colors:</strong></label><br>
            @if($car->exterior_colors)
                @foreach(json_decode($car->exterior_colors) as $color)
                    <span class="badge rounded-pill" style="background-color: {{ $color }}; color: #fff;">&nbsp;&nbsp;&nbsp;</span>
                @endforeach
            @else
                <p>No exterior colors defined.</p>
            @endif
        </div>

        <!-- Descriptions -->
        <div class="mb-3">
            <label><strong>Short Description (EN):</strong></label>
            <p>{{ $car->short_description['en'] ?? 'N/A' }}</p>

            <label><strong>Short Description (AR):</strong></label>
            <p>{{ $car->short_description['ar'] ?? 'N/A' }}</p>

            <label><strong>Description (EN):</strong></label>
            <p>{!! nl2br($car->description['en'] ?? 'N/A') !!}</p>

            <label><strong>Description (AR):</strong></label>
            <p>{!! nl2br($car->description['ar'] ?? 'N/A') !!}</p>
        </div>
    </div>
</div>


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