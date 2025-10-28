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
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Update Category</h1>
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
                            <h3 class="card-title">Update Category</h3>
                        </div>
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('category.update', $category->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Category Name (English)</label>
                                    <input type="text" name="name_en" value="{{ $category->name['en'] ?? '' }}"
                                        class="form-control" placeholder="e.g. Electronics">
                                    @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Category Name (Arabic)</label>
                                    <input type="text" name="name_ar" value="{{ $category->name['ar'] ?? '' }}"
                                        class="form-control" placeholder="مثال: إلكترونيات" dir="rtl">
                                    @error('name_ar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Select User</label>
                                    <select class="form-control select2" name="created_by" style="width: 100%;">
                                        @foreach ($users as $index => $user)
                                        <option value="{{ $user->id }}" {{ $category->created_by == $user->id ?
                                            'selected' : '' }}>{{
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
                                        <option value="1" {{ $category->is_active == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $category->is_active == 0 ? 'selected' : '' }}>Inactive
                                        </option>
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