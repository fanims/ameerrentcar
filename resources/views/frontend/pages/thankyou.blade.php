<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thank You</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  <style>
    body {
      background-color: #000002;
      font-family: Arial, sans-serif;
    }

    .modal-content {
      border-radius: 10px;
      border: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
      background-color: #ce933c;
      color: #000002;
      border-bottom: none;
      padding: 10px 20px;
    }

    .modal-title {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .modal-body {
      background-color: #000002;
      box-shadow: 0 2px 10px #ce933c;
      padding: 20px;
    }

    .thank-you-title {
      font-size: 1.5rem;
      color: #ce933c;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .order-summary-item {
      display: flex;
      justify-content: space-between;
      color: #ce933c;
      font-size: 0.95rem;
      margin-bottom: 8px;
    }

    .total {
      display: flex;
      justify-content: space-between;
      font-size: 1.2rem;
      font-weight: bold;
      color: #ce933c;
      border-top: 1px solid #ce933c;
      padding-top: 10px;
      margin-top: 20px;
    }

    .back-btn {
      width: 100%;
      background-color: #ce933c;
      border: none;
      padding: 10px;
      font-size: 1rem;
      color: #000002;
      border-radius: 5px;
      margin-top: 20px;
    }

    @media (min-width: 576px) {
      .modal-dialog {
        max-width: 800px !important;
        margin: 1.75rem auto;
      }
    }
  </style>
</head>

<body>
  <section class="page-section dark">
    <div class="container-fluid modal show" style="display: block">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">ORDER CONFIRMED</h5>
          </div>
          <div class="modal-body">
            <div class="thank-you-title text-left">Thank you for your booking!</div>

            <hr style="border-top: 2px solid #ce933c; margin: 30px 0;" />
            <div class="thank-you-title" style="text-align: start;">Car Details</div>

            <div class="row text-light">
              <div class="col-md-4 text-center mb-3">
                <img src="{{ asset('storage/' . $order->car->thumbnail_image) }}" alt="Car Image"
                  class="img-fluid rounded shadow" style="max-height: 200px;">
              </div>

              <div class="col-md-8">
                @php $car = $order->car; @endphp
                <div class="row">
                  <div class="col-md-6 order-summary-item"><strong>Car:</strong> {{ $car->name[App::getLocale()] }}</div>
                  <div class="col-md-6 order-summary-item"><strong>Brand:</strong> {{ $car->brand->name ?? 'N/A' }}</div>
                  <div class="col-md-6 order-summary-item"><strong>Model Year:</strong> {{ $car->model_year }}</div>
                  <div class="col-md-6 order-summary-item"><strong>Category:</strong> {{ $car->category->name[App::getLocale()] ?? '' }}</div>
                </div>
              </div>
            </div>

            <div class="thank-you-title text-left mt-4">Order Details</div>

            <div class="row text-light">
              <div class="col-md-6 order-summary-item"><strong>Order ID:</strong> {{ $order->order_id }}</div>
              <div class="col-md-6 order-summary-item"><strong>Pickup Date:</strong> {{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</div>
              <div class="col-md-6 order-summary-item"><strong>Pickup Time:</strong> {{ $order->pickup_time }}</div>
              <div class="col-md-6 order-summary-item"><strong>Dropoff Date:</strong> {{ \Carbon\Carbon::parse($order->dropoff_date)->format('d M Y') }}</div>
              <div class="col-md-6 order-summary-item"><strong>Dropoff Time:</strong> {{ $order->dropoff_time }}</div>
              <div class="col-md-6 order-summary-item"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</div>
            </div>

            <div class="total">
              <span>Total:</span>
              <span id="total">{{ $order->grand_total }} AED</span>
            </div>

            <button class="back-btn" onclick="window.location.href='/'">
              Back to Home
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
