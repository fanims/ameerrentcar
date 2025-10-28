@extends('admin.layout.layout')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            {{-- <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Brand</h1>
                </div>
            </div> --}}

            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Add Brand</h1>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Brand</h3>
                        </div>
                        {{-- Flash error message --}}
                        @if (session('error'))
                        <div class="alert alert-danger mt-1">
                            {{ session('error') }}
                        </div>
                        @endif

                        {{-- Success message (optional) --}}
                        @if (session('success'))
                        <div class="alert alert-success mt-1">
                            {{ session('success') }}
                        </div>
                        @endif

                        {{-- Validation errors --}}
                        @if ($errors->any())
                        <div class="alert alert-danger mt-1">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Brand Name (English)</label>
                                    <input type="text" value="{{ old('name_en') }}" name="name_en" class="form-control"
                                        placeholder="Brand in English">
                                    @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Brand Name (Arabic)</label>
                                    <input type="text" value="{{ old('name_ar') }}" name="name_ar" class="form-control"
                                        placeholder="Brand in Arabic">
                                    @error('name_ar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputPassword1"
                                        placeholder="Brand Image">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Select User</label>
                                    <select class="form-control select2" name="created_by" style="width: 100%;">
                                        @foreach ($users as $index => $user)
                                        <option value="{{ $user->id }}">{{
                                            $user->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('created_by')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control" style="width: 100%;">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@push('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $(".select2").select2();

        $(".select2bs4").select2({
          theme: "bootstrap4",
        });
      });
</script>
@endpush