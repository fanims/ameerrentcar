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
                    <h1>Update Brand</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Brand</h3>
                        </div>

                        {{-- Flash Messages --}}
                        @if (session('error'))
                            <div class="alert alert-danger mt-1">{{ session('error') }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success mt-1">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-1">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form -->
                        <form method="POST" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Brand Name (English)</label>
                                    <input type="text" name="name_en" value="{{ old('name_en', $brand->name_en) }}" class="form-control" placeholder="Brand Name in English">
                                    @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Brand Name (Arabic)</label>
                                    <input type="text" name="name_ar" value="{{ old('name_ar', $brand->name_ar) }}" class="form-control" placeholder="Brand Name in Arabic">
                                    @error('name_ar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Brand Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    <div class="mt-2">
                                        <img src="{{ asset($brand->image) }}" alt="Brand Image" width="100px" height="100px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Select User</label>
                                    <select class="form-control select2" name="created_by" style="width: 100%;">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $brand->created_by == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('created_by') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control" style="width: 100%;">
                                        <option value="1" {{ $brand->is_active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $brand->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $(".select2").select2();
    });
</script>
@endpush
