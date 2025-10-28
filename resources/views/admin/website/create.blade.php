@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Website Settings</h1>
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
                    <h3 class="card-title">Website Settings</h3>
                </div>
                <form action="{{ route('website.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                value="{{ $settings->phone ?? '' }}" placeholder="+971-12345678">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $settings->email ?? '' }}" placeholder="info@example.com">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3"
                                placeholder="Enter business address">{{ $settings->address ?? '' }}</textarea>
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Opening Schedule</label>
                            @php
                            $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                            $schedule = $settings->opening_schedule ?? [];
                            @endphp
                            @foreach($days as $day)
                            <div class="border p-2 mb-2">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="active_{{ $day }}"
                                        name="schedule[{{ $day }}][active]" {{ !empty($schedule[$day]['active'])
                                        ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active_{{ $day }}">{{ $day }}</label>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label>From</label>
                                        <input type="time" class="form-control" name="schedule[{{ $day }}][from]"
                                            value="{{ $schedule[$day]['from'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>To</label>
                                        <input type="time" class="form-control" name="schedule[{{ $day }}][to]"
                                            value="{{ $schedule[$day]['to'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection