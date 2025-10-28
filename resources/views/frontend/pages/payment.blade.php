<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  <style>
    body {
      background-color: #000002;
      font-family: Arial, sans-serif;
    }

    .container {
      background-color: #000002;
      max-width: 900px;
      margin-top: 20px;
      border: #ce933c;
      box-shadow: 0 2px 10px #ce933c;
    }

    .header {
      background-color: #000002;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header .back-btn {
      color: #ce933c;
      font-size: 1rem;
      text-decoration: none;
    }

    .header .secure-checkout {
      font-size: 0.8rem;
      color: #ce933c;
    }

    .form-section,
    .order-summary {
      background-color: #000002;
      padding: 20px;
      border: 1px solid #ce933c;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .form-section h5,
    .order-summary h5 {
      font-size: 1.25rem;
      margin-bottom: 15px;
      color: #ce933c;
    }

    .order-summary p {
      color: #ce933c;
    }

    .form-group label {
      font-size: 0.9rem;
      color: #ce933c;
    }

    .form-control {
      height: 40px;
      font-size: 0.9rem;
      background-color: #f1f1f1;
      border: 1px solid #ced4da;
    }

    .card-logo {
      width: 50px;
      margin-left: 10px;
    }

    .expiry-security {
      display: flex;
      justify-content: space-between;
    }

    .expiry-security .form-group {
      width: 48%;
    }

    .billing-address {
      margin-top: 20px;
    }

    .car-image {
      width: 100%;
      height: auto;
      margin-top: 20px;
    }

    .order-summary {
      min-height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .order-summary .total {
      font-size: 1.2rem;
      font-weight: bold;
      color: red;
    }

    .pay-button {
      width: 100%;
      background-color: #ce933c;
      border: none;
      padding: 10px;
      font-size: 1.1rem;
      color: #000002;
      border-radius: 5px;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <section class="page-section dark">
    <div class="container">
      <div class="header">
        <div>
          <a href="{{ route('booking-details', $car->id) }}" class="back-btn">&lt; Back</a>
        </div>
        <div class="secure-checkout">{{ __('checkout.secure_checkout') }}</div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <form method="POST" action="{{ route('order.store') }}" class="form-section">
            @csrf
            <h5>{{ __('checkout.customer_information') }}</h5>
            @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
            @endif

            <!-- ✅ No Billing Address Checkbox -->
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="noBillingAddress" checked>
              <label class="form-check-label text-white" for="noBillingAddress">
                {{ __('checkout.no_billing_address') }}
              </label>
            </div>

            <!-- ✅ Billing Address Fields -->
            <div class="billing-address" id="billingFields">
              <h5>{{ __('checkout.billing_address_optional') }}</h5>

              <div class="form-group">
                <label for="country">{{ __('checkout.country') }}</label>
                <select class="form-control billing-input" id="country" name="billing_country">
                  <option>{{ __('checkout.select_country') }}</option>
                  <option value="UAE">UAE</option>
                </select>
              </div>

              <div class="form-group">
                <label for="address">{{ __('checkout.address') }}</label>
                <input type="text" value="{{ old('billing_address') }}" class="form-control billing-input" id="address"
                  name="billing_address" placeholder="Add Apt #, floor, unit, suite, etc." />
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="city">{{ __('checkout.city') }}</label>
                  <input type="text" value="{{ old('billing_city') }}" class="form-control billing-input" id="city"
                    name="billing_city" />
                </div>
                <div class="form-group col-md-6">
                  <label for="zipcode">{{ __('checkout.postcode') }}</label>
                  <input type="text" value="{{ old('billing_zip') }}" class="form-control billing-input" id="zipcode"
                    name="billing_zip" />
                </div>
              </div>

              <div class="form-group">
                <label for="state">{{ __('checkout.state') }}</label>
                <input type="text" value="{{ old('billing_state') }}" class="form-control billing-input" id="state"
                  name="billing_state" />
              </div>
            </div>

            <!-- ✅ Car Summary -->
            <div class="car-summary mb-3" style="display: flex; align-items: flex-start; gap: 15px;">
              <img src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="{{ trans_field($car->name) }}"
                style="width: 100px; height: auto; border-radius: 5px; border: 1px solid #ce933c;" />
              <div style="color: #ce933c;">
                <p><strong>Name:</strong> {{ trans_field($car->name) }}</p>
                <p><strong>Model:</strong> {{ $car->model_year }}</p>
                <p><strong>Category:</strong> {{ $car->category->name[App::getLocale()] ?? 'N/A' }}</p>
                <p><strong>Brand:</strong> {{ $car->brand->name ?? 'N/A' }}</p>

                @php
                use Carbon\Carbon;
                $order = session()->get('order_data');
                @endphp

                @if($order)
                <p><strong>Booking From:</strong>
                  {{ Carbon::parse(trim($order['pickup_date']) . ' ' . trim($order['pickup_time']))->format('d M Y h:i A')
                  }}
                </p>
                <p><strong>Booking To:</strong>
                  {{ Carbon::parse(trim($order['dropoff_date']) . ' ' . trim($order['dropoff_time']))->format('d M Y h:i A')
                  }}
                </p>
                @endif
              </div>
            </div>

            <button class="pay-button">Pay AED {{ session()->get('order_data')['grand_total'] }}</button>
          </form>
        </div>

        <!-- ✅ Order Summary -->
        <div class="col-md-4">
          <div class="order-summary">
            <h5>{{ __('checkout.order_summary') }}</h5>
            <p>{{ trans_field($car->name) }}</p>

            @php
            $order = session()->get('order_data');
            $applied_coupon = session()->get('applied_coupon');
            $subtotal = $order['car_price'] ?? 0;
            $taxRate = $order['tax'] ?? 0;
            $taxAmount = ($subtotal * $taxRate) / 100;
            $grandTotal = $order['grand_total'] ?? ($subtotal + $taxAmount);
            @endphp

            <p>Car Booking Price: AED {{ number_format($order['car_price'] ?? 0, 2) }}</p>

            @if(!empty($order['extras']))
            @foreach ($order['extras'] as $key => $price)
            <p>{{ ucwords(str_replace(['_', '-'], ' ', $key)) }}: AED {{ number_format($price, 2) }}</p>
            @endforeach
            @endif

            <p><strong>Subtotal (without tax):</strong> AED {{ number_format($subtotal, 2) }}</p>
            @if(!empty($applied_coupon))
            <p> Coupon Discount: AED {{ number_format($applied_coupon['discount'], 2) }}</p>
            @endif
            <p><strong>Tax ({{ $taxRate }}%):</strong> AED {{ number_format($taxAmount, 2) }}</p>
            <p class="total">{{ __('checkout.total') }}: <span>AED {{ number_format($grandTotal, 2) }}</span></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ✅ Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "timeOut": "10000"
    };
    @if(session('success')) toastr.success("{{ session('success') }}"); @endif
    @if(session('error')) toastr.error("{{ session('error') }}"); @endif
    @if(session('warning')) toastr.warning("{{ session('warning') }}"); @endif
    @if(session('info')) toastr.info("{{ session('info') }}"); @endif
  </script>

  <!-- ✅ Toggle Required Billing Fields -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const noBillingCheckbox = document.getElementById("noBillingAddress");
      const billingInputs = document.querySelectorAll(".billing-input");

      function toggleBillingFields() {
        if (noBillingCheckbox.checked) {
          billingInputs.forEach(input => input.removeAttribute("required"));
        } else {
          billingInputs.forEach(input => input.setAttribute("required", "required"));
        }
      }

      toggleBillingFields(); // Run once
      noBillingCheckbox.addEventListener("change", toggleBillingFields);
    });
  </script>
</body>
</html>
