@extends('admin.layout.layout')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-between">
                <div class="">
                    <h1>Social Links</h1>
                </div>
                <div class="">
                    <a href="{{ route('social.create') }}" class="btn btn-primary">Add Social</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Social Links</h3>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mt-1">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>WhatsApp</th>
                                        <th>Twitter</th>
                                        <th>Telegram</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($socials as $social)
                                        <tr>
                                            <td><a href="{{ $social->facebook }}" target="_blank">Facebook</a></td>
                                            <td><a href="{{ $social->instagram }}" target="_blank">Instagram</a></td>
                                            <td><a href="{{ $social->whatsapp }}" target="_blank">WhatsApp</a></td>
                                            <td><a href="{{ $social->twitter }}" target="_blank">Twitter</a></td>
                                            <td><a href="{{ $social->telegram }}" target="_blank">Telegram</a></td>
                                            <td class="d-flex gap-2 align-items-center">
                                                <a href="{{ route('social.edit', $social->id) }}" class="btn btn-primary mx-1">Edit</a>
                                                <form action="{{ route('social.destroy', $social->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this social link?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>WhatsApp</th>
                                        <th>Twitter</th>
                                        <th>Telegram</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
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
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush
