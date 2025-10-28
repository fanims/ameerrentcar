@extends('admin.layout.layout')

@push('css')
<!-- (Select2 removed since it's not needed here) -->
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>General Pricing</h1>
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
                            <h3 class="card-title">Manage General Price Settings</h3>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success m-3">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger m-3">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.general-price.update') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    @php
                                    $fields = [
                                    'driver_price' => 'Driver Price (AED)',
                                    'deposit_fee' => 'Deposit Fee (AED)',
                                    'fuel_tank_fee' => 'Fuel Tank Fee (AED)',
                                    'extra_km_fee' => 'Extra KM Fee (AED)',
                                    'baby_seat_fee' => 'Baby Seat Fee (AED)',
                                    'delivery_outside_fee' => 'Delivery Outside City Fee (AED)',
                                    'tax' => 'Tax (%)',
                                    ]
                                     @endphp 
                                     @foreach($fields as $field=>
                                        $label)
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="{{ $field }}">{{ $label }}</label>
                                                <input type="number" step="0.01" min="0" name="{{ $field }}"
                                                    class="form-control" value="{{ old($field, $price->$field ?? '') }}"
                                                    placeholder="Enter {{ strtolower($label) }}">
                                                @error($field)
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Prices</button>
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
<!-- No JS needed for this form -->
@endpush