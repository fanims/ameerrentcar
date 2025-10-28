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
                    <h1>Cars</h1>
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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Cars</h3>
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
                                        <th>Thumbnail</th>
                                        <th>Car Name</th>
                                        <th>Brand</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Model Year</th>
                                        <th>Seats</th>
                                        <th>Sitting Capacity</th>
                                        {{-- <th>Interior Colors</th>
                                        <th>Exterior Colors</th> --}}
                                        {{-- <th>KM/hr</th>
                                        <th>KM/day</th>
                                        <th>KM/week</th>
                                        <th>KM/month</th> --}}
                                        {{-- <th>Gear</th> --}}
                                        {{-- <th>Bags</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                    <tr>
                                        <td>
                                            @if($car->thumbnail_image)
                                            <img src="{{ asset('storage/' . $car->thumbnail_image) }}" alt="Thumbnail"
                                                width="80" height="50">
                                            @endif
                                        </td>
                                        <td>{{ trans_field($car->name) }}</td>
                                        <td>{{ $car->brand->name_en ?? '-' }}</td>
                                        <td>{{ $car->car_type }}</td>
                                        <td>{{ $car->category->name[App::getLocale()] ?? '-' }}</td>
                                        <td>{{ $car->model_year }}</td>
                                        <td>{{ $car->seats_available }}</td>
                                        <td>{{ $car->persons_can_sit }}</td>

                                        {{-- <td>
                                            <div class="d-flex">
                                                @foreach(json_decode($car->interior_colors, true) ?? [] as $color)
                                                <div style="height: 20px; width:20px; background-color: {{ $color }};"
                                                    title="{{ $color }}"></div>
                                                @endforeach
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                @foreach(json_decode($car->exterior_colors, true) ?? [] as $color)
                                                <div style="height: 20px; width:20px; background-color: {{ $color }};"
                                                    title="{{ $color }}"></div>
                                                @endforeach
                                            </div>
                                        </td> --}}

                                        {{-- <td>{{ $car->km_per_hour }}</td>
                                        <td>{{ $car->km_per_day }}</td>
                                        <td>{{ $car->km_per_week }}</td>
                                        <td>{{ $car->km_per_month }}</td> --}}
                                        {{-- <td>{{ $car->gear }}</td> --}}
                                        {{-- <td>{{ $car->number_of_bags }}</td> --}}
                                        <td>{{ $car->is_active == '1' ? 'Active' : 'Inactive' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('cars.show', $car->id) }}"
                                                class="btn btn-success btn-sm mx-1">View</a>
                                            <a href="{{ route('cars.edit', $car->id) }}"
                                                class="btn btn-primary btn-sm mx-1">Edit</a>

                                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this car?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Car Name</th>
                                        <th>Brand</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Model Year</th>
                                        <th>Seats</th>
                                        <th>Sitting Capacity</th>
                                        {{-- <th>Interior Colors</th>
                                        <th>Exterior Colors</th> --}}
                                        {{-- <th>KM/hr</th>
                                        <th>KM/day</th>
                                        <th>KM/week</th>
                                        <th>KM/month</th> --}}
                                        {{-- <th>Gear</th> --}}
                                        {{-- <th>Bags</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
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