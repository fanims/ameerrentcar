@extends('admin.layout.layout')

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-between">
                <div>
                    <h1>Update Currency</h1>
                </div>
                <div>
                    <a href="{{ route('currencies.index') }}" class="btn btn-primary">All Currency</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- form column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Currency</h3>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('currencies.update', $currency->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Currency Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', $currency->name) }}" placeholder="e.g. US Dollar" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="code">Currency Code</label>
                                    <input type="text" class="form-control" name="code" id="code"
                                        value="{{ old('code', $currency->code) }}" placeholder="e.g. USD" required>
                                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="symbol">Symbol</label>
                                    <input type="text" class="form-control" name="symbol" id="symbol"
                                        value="{{ old('symbol', $currency->symbol) }}" placeholder="e.g. $" required>
                                    @error('symbol') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" name="is_active" id="is_active">
                                        <option value="1" {{ $currency->is_active ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$currency->is_active ? 'selected' : '' }}>Inactive</option>
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
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });
    });
</script>
@endpush
