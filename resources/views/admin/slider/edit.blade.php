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
                    <h1>Update Slider</h1>
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
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Slider</h3>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title (English)</label>
                                    <input type="text" name="title_en" value="{{ $slider->title['en'] ?? '' }}" class="form-control" placeholder="e.g. Luxury Ride">
                                    @error('title_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Title (Arabic)</label>
                                    <input type="text" name="title_ar" value="{{ $slider->title['ar'] ?? '' }}" class="form-control" placeholder="مثال: سيارة فاخرة" dir="rtl">
                                    @error('title_ar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Slider Link (optional)</label>
                                    <input type="text" name="link" value="{{ $slider->link }}" class="form-control" placeholder="https://example.com">
                                    @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Slider Image</label><br>
                                    @if ($slider->image)
                                        <img src="{{ asset('storage/' . $slider->image) }}" width="150" class="mb-2">
                                    @endif
                                    <input type="file" name="image" class="form-control-file">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Select User</label>
                                    <select class="form-control select2" name="created_by" style="width: 100%;">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $slider->created_by == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('created_by') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Slider</button>
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
