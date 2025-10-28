@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>{{ isset($coupon) ? 'Edit' : 'Add' }} Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumbs />
                </div>
            </div>
        </div>

    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($coupon) ? 'Edit' : 'Add' }} Coupon</h3>
                </div>

                <form action="{{ isset($coupon) ? route('coupons.update', $coupon->id) : route('coupons.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($coupon)) @method('PUT') @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control"
                                value="{{ old('code', $coupon->code ?? '') }}">
                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-control">
                                <option value="fixed" {{ old('type', $coupon->type ?? '') == 'fixed' ? 'selected' : ''
                                    }}>Fixed</option>
                                <option value="percent" {{ old('type', $coupon->type ?? '') == 'percent' ? 'selected' :
                                    '' }}>Percent</option>
                            </select>
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Value</label>
                            <input type="number" step="0.01" name="value" class="form-control"
                                value="{{ old('value', $coupon->value ?? '') }}">
                            @error('value') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Minimum Order Amount</label>
                            <input type="number" step="0.01" name="min_order_amount" class="form-control"
                                value="{{ old('min_order_amount', $coupon->min_order_amount ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Usage Limit</label>
                            <input type="number" name="usage_limit" class="form-control"
                                value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="date" name="expires_at" class="form-control"
                                value="{{ old('expires_at', isset($coupon->expires_at) ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d') : '') }}" />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">{{ isset($coupon) ? 'Update' : 'Add' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection