<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    @include('frontend.includes.style')
</head>

<body>
    <section class="rc-profile-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
            
                    <div class="rc-profile-header">
                        <div class="rc-section-title rc-section-title_left">
                            <div class="rc-section-title-content">
                                <span>- My Account -</span>
                                <h2>Manage your personal details and bookings all in one place.</h2>
                            </div>
                        </div>
            
                        <div class="action-buttons">
                            <a href="{{ url('/') }}" class="rc-btn rc-btntwo" title="Back to Home">
                                Home
                            </a>
            
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="rc-btn rc-btn-theme" title="Logout">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
            
                    <div class="profile-container">
                        <!-- Left side vertical nav pills -->
                        <ul class="nav nav-pills rc-profile-tabs" id="profileTabs" role="tablist" aria-orientation="vertical">
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
                                    class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group-wrap">
                                        <div class="form-group form-group-half">
                                            <label for="name">Name</label>
                                            <input id="name" type="text" name="name" class="form-control"
                                                value="{{ old('name', $user->name) }}" required />
                                        </div>
                                        <div class="form-group form-group-half">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" name="email" class="form-control"
                                                value="{{ old('email', $user->email) }}" required />
                                        </div>
                                    </div>
                                    <div class="form-group-wrap">
                                        <div class="form-group form-group-half">
                                            <label for="dob">Date of Birth</label>
                                            <input id="dob" type="date" name="dob" class="form-control"
                                                value="{{ old('dob', $user->dob) }}" />
                                        </div>
                                        <div class="form-group form-group-half">
                                            <label for="phone">Phone</label>
                                            <input id="phone" type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $user->phone) }}" />
                                        </div>
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
                                    
                                    <div class="rc-update-btn">
                                        <button type="submit" class="rc-btn rc-btntwo">Update</button>
                                    </div>
                                </form>
                            </div>
            
                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <form action="{{ route('user.update.password', $user->id) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group-wrap">
                                        <div class="form-group form-group-half">
                                            <label for="password">New Password</label>
                                            <input id="password" type="password" name="password" class="form-control" required />
                                        </div>
                                        <div class="form-group form-group-half">
                                            <label for="password_confirmation">Confirm New Password</label>
                                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required />
                                        </div>
                                    </div>
            
                                    <div class="rc-update-btn">
                                        <button type="submit" class="rc-btn rc-btntwo">Update</button>
                                    </div>
                                </form>
                            </div>
            
                            <!-- Orders Tab -->
                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="table-responsive">
                                    <table class="table table-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Car</th>
                                                <th>Pickup</th>
                                                <th>Dropoff</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                            <tr>
                                                <td data-label="Order ID">{{ $order->order_id }}</td>
                                                <td data-label="Car">{{ $order->car->name[App::getLocale()] ?? $order->car->name ?? 'N/A' }}</td>
                                                <td data-label="Pickup">{{ $order->pickup_date }} at {{ $order->pickup_time }}</td>
                                                <td data-label="Dropoff">{{ $order->dropoff_date }} at {{ $order->dropoff_time }}</td>
                                                <td data-label="Total">{{ number_format($order->grand_total, 2) }} AED</td>
                                                <td data-label="Status">{{ ucfirst($order->status) }}</td>
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
            </div>
        </div>
    </section>


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