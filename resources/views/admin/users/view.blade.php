@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
           <div class="row mb-2 justify-content-between">
                <div class="col-sm-6">
                    <h1>Profile</h1>
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
            @if(session('success'))
            <div class="alert alert-success mt-1">
                {{ session('success') }}
            </div>

            @endif
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">    
                            <h3 class="profile-username text-center">{{ $user->name ?? '-' }}</h3>

                            <p class="text-muted text-center">{{ $user->email ?? '-' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>DOB</b> <a class="float-right">{{ $user->dob ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>phone</b> <a class="float-right">{{ $user->phone ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Order</b> <a class="float-right">{{ $orderCount }}</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
               
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Activity</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#timeline"
                                        data-toggle="tab">Timeline</a> --}}
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- User Details -->
                                <div class="active tab-pane" id="activity">
                                    <form action="{{ route('user.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" name="dob" value="{{ $user->dob }}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ $user->phone }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>License (PDF or Images)</label>
                                            <input type="file" name="license_files[]" class="form-control"
                                                accept=".pdf,image/*" multiple>
                                        </div>

                                        @if($user->license)
                                        @php $licenses = json_decode($user->license, true); @endphp

                                        <div class="mt-3">
                                            <label>Uploaded License Files:</label>
                                            <ul>
                                                @foreach($licenses as $file)
                                                <li>
                                                    <a href="{{ asset('storage/' . $file) }}" target="_blank">View
                                                        File</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif




                                        <!-- Add more fields as needed -->

                                        <button type="submit" class="btn btn-primary">Update User</button>
                                    </form>
                                </div>

                                <!-- Timeline (Optional, leave empty or add activity feed here) -->
                                {{-- <div class="tab-pane" id="timeline">
                                    <!-- You can use this for showing user activity logs -->
                                </div> --}}

                                <!-- Settings: Change Password & Status -->
                                <div class="tab-pane" id="settings">

                                    <!-- Change Password Form -->
                                    <h5>Change Password</h5>
                                    <form action="{{ route('user.update.password', $user->id) }}" method="POST"
                                        class="mb-4">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>

                                        <button type="submit" class="btn btn-danger">Update Password</button>
                                    </form>

                                    <hr>

                                    <!-- Update Status Form -->
                                    <h5>Account Status</h5>
                                    <form action="{{ route('user.update.status', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{ $user->status == 'active' ? 'selected' : ''
                                                    }}>Active</option>
                                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' :
                                                    '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-warning">Update Status</button>
                                    </form>

                                </div>

                            </div>

                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection