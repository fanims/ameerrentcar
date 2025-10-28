@extends('admin.layout.layout')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Add Car Type</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Car Type</h3>
                        </div>

                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('car-types.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Car Type (English)</label>
                                    <input type="text" name="name_en" class="form-control" placeholder="e.g. Popular" value="{{ old('name_en') }}">
                                    @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Car Type (Arabic)</label>
                                    <input type="text" name="name_ar" class="form-control" placeholder="مثال: شائع" dir="rtl" value="{{ old('name_ar') }}">
                                    @error('name_ar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
 
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        $('.select2').select2();
    });
</script>
@endpush
