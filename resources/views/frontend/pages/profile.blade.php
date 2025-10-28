<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        body {
            background-color: #000002;
            font-family: Arial, sans-serif;
            color: #ce933c;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        h2 {
            font-weight: 700;
            letter-spacing: 2px;
            /* margin-bottom: 2rem; */
            text-align: center;
        }

        /* Container with flex row for tabs + content */
        .profile-container {
            display: flex;
            background-color: #111111;
            border-radius: 8px;
            box-shadow: 0 0 15px #ce933c44;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
            min-height: 480px;
        }

        /* Left vertical nav */
        .nav-pills.flex-column {
            background-color: #1a1a1a;
            padding: 1rem 0;
            min-width: 180px;
            border-right: 2px solid #ce933c;
        }

        .nav-pills .nav-link {
            color: #ce933c;
            font-weight: 600;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            margin: 0 1rem 0 1.5rem;
            border-radius: 0 25px 25px 0;
        }

        .nav-pills .nav-link:hover {
            background-color: #ce933c22;
            color: #fff;
            border-left-color: #ce933c;
            text-decoration: none;
        }

        .nav-pills .nav-link.active {
            background-color: #ce933c;
            color: #000;
            border-left-color: #b3842c;
            font-weight: 700;
            box-shadow: 0 0 15px #ce933caa;
        }

        /* Right content area */
        .tab-content {
            flex-grow: 1;
            padding: 2rem 2.5rem;
            color: #ce933c;
            overflow-y: auto;
            background-color: #000000;
        }

        label {
            font-weight: bold;
            color: #ce933c;
        }

        .form-control {
            background-color: #111111;
            border: 1px solid #ce933c;
            color: #ce933c;
        }

        .form-control:focus {
            background-color: #222;
            color: #fff;
            border-color: #ce933c;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #ce933c;
            border-color: #ce933c;
            color: #000;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b3842c;
            border-color: #b3842c;
            color: #000;
        }

        .table thead th {
            border-bottom: 2px solid #ce933c;
            color: #ce933c;
        }

        .table tbody td {
            color: #ce933c;
            border-top: 1px solid #444;
        }

        .table {
            background-color: #111111;
            border-radius: 6px;
        }

        .btn-gold {
            background-color: #ce933c;
            color: #000;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1.5px solid #b3842c;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .btn-gold:hover,
        .btn-gold:focus {
            background-color: #b3842c;
            color: #000;
            text-decoration: none;
            border-color: #92732a;
            box-shadow: 0 0 8px #b3842caa;
            outline: none;
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }


        /* Responsive for small screens */
        @media (max-width: 767.98px) {
            .profile-container {
                flex-direction: column;
                min-height: auto;
            }

            .nav-pills.flex-column {
                flex-direction: row !important;
                border-right: none;
                border-bottom: 2px solid #ce933c;
                min-width: 100%;
                margin-bottom: 1rem;
                padding: 0.5rem;
                overflow-x: auto;
            }

            .nav-pills .nav-link {
                border-left: none;
                border-radius: 25px;
                margin: 0 0.5rem;
            }

            .tab-content {
                padding: 1rem 1rem 2rem;
            }
        }
                .baton {
            border-radius: 20px;
            border: none;
            background-color: #ce933c;
            color: #000002;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }
    </style>
</head>

<body>
    <div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 40px;" class="me-2">
                <h2 class="mb-0">My Account</h2>
            </div>

            <div class="action-buttons">
                <a href="{{ url('/') }}" class="btn btn-gold btn-sm me-2 mx-2" title="Back to Home">
                    <i class="fa fa-home"></i> Home
                </a>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-gold btn-sm" title="Logout">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="profile-container">
            <!-- Left side vertical nav pills -->
            <ul class="nav nav-pills flex-column" id="profileTabs" role="tablist" aria-orientation="vertical">
                <li class="nav-item">
                    <a class="nav-link active" id="details-tab" data-toggle="pill" href="#details" role="tab"
                        aria-controls="details" aria-selected="true">Profile Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab"
                        aria-controls="settings" aria-selected="false">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="orders-tab" data-toggle="pill" href="#orders" role="tab"
                        aria-controls="orders" aria-selected="false">Orders</a>
                </li>
            </ul>

            <!-- Right side content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Profile Details Tab -->
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="{{ route('web.user.update') }}" method="POST" enctype="multipart/form-data"
                        class="mt-0">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required />
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input id="dob" type="date" name="dob" class="form-control"
                                value="{{ old('dob', $user->dob) }}" />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}" />
                        </div>

                        <div class="form-group">
                            <label for="license_files">License (PDF or Images)</label>
                            <input id="license_files" type="file" name="license_files[]" class="form-control"
                                accept=".pdf,image/*" multiple />
                            @if($user->license)
                            @php $licenses = json_decode($user->license, true); @endphp
                            <small class="text-muted d-block mt-2">Uploaded files:</small>
                            <ul>
                                @foreach($licenses as $file)
                                <li><a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-warning">{{
                                        basename($file) }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>

                <!-- Settings Tab -->
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <form action="{{ route('user.update.password', $user->id) }}" method="POST" class="mt-0">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password" name="password" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" required />
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>

                <!-- Orders Tab -->
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <div class="table-responsive mt-0">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Car</th>
                                    <th>Pickup</th>
                                    <th>Dropoff</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Details</th> <!-- New column -->

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->car->name[App::getLocale()] ?? $order->car->name ?? 'N/A' }}</td>
                                    <td>{{ $order->pickup_date }} at {{ $order->pickup_time }}</td>
                                    <td>{{ $order->dropoff_date }} at {{ $order->dropoff_time }}</td>
                                    <td>{{ number_format($order->grand_total, 2) }} AED</td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                    <td>
                                        <button class="baton view-order-details"
                                            data-order='@json($order)'>
                                            View
                                        </button>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-warning">No orders found.</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Order Detail Modal -->
    <div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailModalLabel">Order Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close" onclick="$('#orderDetailModal').modal('hide')"></button>
                </div>
                <div class="modal-body" id="orderDetailContent">
                    <!-- Filled dynamically by JavaScript -->
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const locale = '{{ app()->getLocale() }}';

        $(document).on('click', '.view-order-details', function () {
        const order = $(this).data('order');
        const car = order.car ?? {};
        const category = car.category ?? {};
        const brand = car.brand ?? {};

        const formatField = (label, value) => `
            <div class="col-md-4 mb-3">
            <strong>${label}:</strong><br><span>${value ?? 'N/A'}</span>
            </div>
        `;

        const orderInfo = `
            <h5 class="mb-3">Order Information</h5>
            <div class="row">
            ${formatField('Order ID', order.order_id)}
            ${formatField('Order Status', order.status)}
            ${formatField('Payment Status', order.payment_status)}
            ${formatField('Payment Method', order.payment_method)}
            ${formatField('Delivery Location', order.delivery_location)}
            ${formatField('Receive Location', order.receiving_location)}
            ${formatField('Order Date', new Intl.DateTimeFormat(locale, { year: 'numeric', month: 'long', day: 'numeric' }).format(new Date(order.created_at)))}
            ${formatField('Pickup Date', `${order.pickup_date} at ${order.pickup_time}`)}
            ${formatField('Dropoff Date', `${order.dropoff_date} at ${order.dropoff_time}`)}
            ${formatField('Total Amount (AED)', parseFloat(order.grand_total).toFixed(2))}
            </div>
            <hr>
        `;

  const carInfo = `
  <h5 class="mb-3">Car Details</h5>
  <div class="d-flex flex-wrap mb-4">
    <div class="me-4 mb-3" style="min-width: 250px;">
      <img src="/storage/${car.thumbnail_image}" class="img-fluid rounded shadow" style="max-width: 100px; max-height: 100px;" alt="Thumbnail">
    </div>
    <div class="flex-grow-1">
      <div class="row">
        ${formatField('Name', car.name?.[locale] ?? car.name)}
        ${formatField('Type', car.car_type)}
        ${formatField('Category', category.name?.[locale] ?? category.name)}
        ${formatField('Brand', brand.name?.[locale] ?? brand.name)}
        ${formatField('Model Year', car.model_year)}
        ${formatField('Seats', car.persons_can_sit)}
        ${formatField('Available Seats', car.seats_available)}
        ${formatField('Service Included', car.service_included)}
      </div>
    </div>
  </div>
  <div class="mb-3">
    <strong>Short Description:</strong>
    <p>${car.short_description?.[locale] ?? 'N/A'}</p>
  </div>
  <div class="mb-3">
    <strong>Description:</strong>
    <p>${car.description?.[locale] ?? 'N/A'}</p>
  </div>
`;


  $('#orderDetailContent').html(orderInfo + carInfo);
  $('#orderDetailModal').modal('show');
});
    </script>


</body>

</html>