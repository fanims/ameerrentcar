<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Details</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  <style>
    body {
      background-color: #000002;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 600px;
      margin-top: 20px;
    }

    .header {
      color: #8b4513;
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .back-btn {
      color: #ce933c;
      font-size: 1rem;
      text-decoration: none;
    }

    .subheader {
      font-size: 0.9rem;
      color: #ce933c;
      margin-bottom: 20px;
    }

    .coupon-section {
      margin-bottom: 20px;
    }

    .coupon-section label {
      font-size: 0.9rem;
      color: #ce933c;
      display: block;
      margin-bottom: 5px;
    }

    .coupon-section .input-group {
      display: flex;
      align-items: center;
    }

    .coupon-section .form-control {
      height: 40px;
      font-size: 0.9rem;
      background-color: #f1f1f1;
      border: 1px solid #ced4da;
      border-radius: 5px 0 0 5px;
      flex-grow: 1;
    }

    .coupon-section .btn {
      background-color: #8b4513;
      color: white;
      border: none;
      padding: 0 20px;
      height: 40px;
      font-size: 0.9rem;
      line-height: 40px;
      white-space: nowrap;
      border-radius: 0 5px 5px 0;
      margin-left: -1px;
      /* Align with input border */
    }

    .form-section {
      background-color: #000002;
      padding: 20px;
      border: #ce933c;
      box-shadow: 0 2px 10px #ce933c;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .form-section h5 {
      font-size: 1.25rem;
      font-weight: bold;
      color: #8b4513;
      background-color: #d2b48c;
      padding: 10px;
      margin-bottom: 20px;
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

    .form-row .form-group {
      margin-bottom: 15px;
    }

    .license-section {
      margin-top: 20px;
      font-size: 0.9rem;
      color: #ce933c;
    }

    .custom-control-label {
      font-size: 0.9rem;
      color: #495057;
    }

    .custom-radio .custom-control-label::before {
      background-color: #fff;
      border: 2px solid #8b4513;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::before {
      background-color: #8b4513;
      border-color: #8b4513;
    }

    .payment-section {
      background-color: #fff;
      padding: 20px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .payment-section h5 {
      font-size: 1.25rem;
      font-weight: bold;
      color: #8b4513;
      background-color: #d2b48c;
      padding: 10px;
      margin-bottom: 20px;
    }

    .payment-section p {
      font-size: 0.9rem;
      color: #495057;
    }

    .payment-logos img {
      width: 40px;
      margin-right: 10px;
    }

    .terms-section {
      font-size: 0.8rem;
      color: #ff8c00;
      margin-bottom: 20px;
    }

    .pay-button {
      width: 100%;
      background-color: #8b4513;
      color: white;
      border: none;
      padding: 10px;
      font-size: 1rem;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <form action="{{ route('booking.store', $car->id) }}" method="POST" enctype="multipart/form-data" class="container">
    <div>
      <a href="{{ route('checkout-form', $car->id) }}" class="back-btn">&lt; Back</a>
    </div>
    <div class="header">{{ __('checkout.your_booking_details') }}</div>
    <div class="subheader">
      {{ __('checkout.fillout_the_form') }}
    </div>
    <div class="coupon-section container">
      <label for="couponCode">{{ __('checkout.have_coupon') }}</label>
      <div class="input-group">
        <input type="text" class="form-control" id="couponCode" placeholder="COUPON CODE" />
        <button type="button" class="btn" id="applyCouponBtn">{{ __('checkout.apply_coupon') }}</button>
      </div>
      <div id="couponFeedback" class="mt-2"></div>
    </div>

    <div class="form-section">
      @csrf
      <h5>{{ __('checkout.personal_details') }}</h5>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="fullName">{{ __('checkout.full_name') }}</label>
          <input type="text" class="form-control" id="fullName"
            value="{{ old('full_name', auth()->user() ? auth()->user()->name : '') }}" name="full_name" />
          @error('full_name')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="nationality">{{ __('checkout.nationality') }}</label>
          <input type="text" class="form-control" value="{{ old('nationality') }}" id="nationality"
            name="nationality" />
          @error('nationality')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="dob">{{ __('checkout.date_of_birth') }}</label>
          <input type="date" class="form-control" value="{{ old('date_of_birth') }}" id="dob" name="date_of_birth" />
          @error('date_of_birth')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="email">{{ __('checkout.email') }}</label>
          <input type="email" class="form-control" id="email" value="{{ auth()->user() ? auth()->user()->email : '' }}"
            name="email" />
          @error('email')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="deliveryLocation">{{ __('checkout.delivery_location') }}</label>
          <input type="text" class="form-control" value="{{ old('delivery_location') }}" id="deliveryLocation"
            name="delivery_location" />
          @error('delivery_location')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="receivingLocation">{{ __('checkout.receiving_location') }}</label>
          <input type="text" class="form-control" value="{{ old('receiving_location') }}" id="receivingLocation"
            name="receiving_location" />
          @error('receiving_location')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="phone">{{ __('checkout.phone') }}</label>
          <input type="tel" class="form-control" value="{{ old('phone') }}" id="phone" name="phone" />
          @error('phone')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="whatsapp">{{ __('checkout.whatsapp') }}</label>
          <input type="text" class="form-control" value="{{ old('whatsapp') }}" id="whatsapp" name="whatsapp" />
          @error('whatsapp')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="license-section">
        <label>{{ __('checkout.have_international_license') }}</label>
        <div class="form-group">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="licenseYes" name="license" value="yes" class="custom-control-input" />
            <label class="custom-control-label" for="licenseYes">{{ __('checkout.yes') }}</label>
          </div>

          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="licenseNo" name="license" value="no" class="custom-control-input" checked />
            <label class="custom-control-label" for="licenseNo">{{ __('checkout.no') }}</label>
          </div>

          @error('license')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      {{-- Hidden by default --}}
      <div id="licenseUploadWrapper" class="form-group" style="display: none;">
        <label for="licenseFiles">Upload License</label>
        <input type="file" name="license_files[]" id="licenseFiles"
          class="form-control @error('license_files') is-invalid @enderror" multiple accept=".jpg,.jpeg,.png,.pdf" />
        @error('license_files')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="form-group">
        <label for="specialRequests">{{ __('checkout.special_request') }}</label>
        <textarea name="special_requests" class="form-control" id="specialRequests"
          rows="3">{{ old('special_requests') }}</textarea>
        @error('special_requests')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="form-section">
      <h5>Payment Method</h5>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="paymentOnline" name="payment_method" value="online" class="custom-control-input"
          checked>
        <label class="custom-control-label" for="paymentOnline">Zinna Pay</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="paymentCod" name="payment_method" value="cod" class="custom-control-input">
        <label class="custom-control-label" for="paymentCod">Cash on Delivery</label>
      </div>
      {{-- <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="paymentTabby" name="payment_method" value="tabby" class="custom-control-input">
        <label class="custom-control-label" for="paymentTabby">Tabby</label>
      </div> --}}
    </div>

    <div class="payment-section">
      <h5>{{ __('checkout.payment_method') }}</h5>
      <p>
        {{ __('checkout.secure_payment') }}
      </p>
      <div class="payment-logos">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" />
        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" />
        <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Discover_Card_logo.svg" alt="Discover" />
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/American_Express_logo_%282018%29.svg"
          alt="American Express" />
      </div>
    </div>
    <div class="terms-section">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" required class="custom-control-input" id="terms" />
        <label class="custom-control-label" for="terms">{{ __('checkout.terms_message') }}
          <a href="{{ route('terms-and-conditions') }}" style="color: #ff8c00">{{ __('checkout.click_here')
            }}</a></label>
      </div>
    </div>
    <button type="submit" class="pay-button">
      {{ __('checkout.pay_to_proceed') }}
    </button>
  </form>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function () {
        // Set default date of birth to a sample date
        var sampleDob = new Date("1990-01-01").toISOString().split("T")[0];
        $("#dob").val(sampleDob);
      });
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right", // or toast-top-right
        "timeOut": "10000"
    };
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const yesRadio = document.getElementById('licenseYes');
    const noRadio = document.getElementById('licenseNo');
    const uploadWrapper = document.getElementById('licenseUploadWrapper');
    const uploadInput = document.getElementById('licenseFiles');

    function toggleUploadField() {
      if (yesRadio.checked) {
        uploadWrapper.style.display = 'block';
        uploadInput.setAttribute('required', 'required');
      } else {
        uploadWrapper.style.display = 'none';
        uploadInput.removeAttribute('required');
        uploadInput.value = ''; // Clear file input
      }
    }

    yesRadio.addEventListener('change', toggleUploadField);
    noRadio.addEventListener('change', toggleUploadField);

    // On page load check
    toggleUploadField();
  });
  </script>

  <script>
    document.getElementById('applyCouponBtn').addEventListener('click', function () {
    const code = document.getElementById('couponCode').value;
    const feedback = document.getElementById('couponFeedback');

    if (!code) {
      feedback.innerHTML = `<div class="text-warning">Please enter a coupon code.</div>`;
      return;
    }

    fetch('{{ route('apply.coupon') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ code })
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        feedback.innerHTML = `<div class="text-success">${data.message}</div>`;
      } else {
        feedback.innerHTML = `<div class="text-danger">${data.message}</div>`;
      }
    })
    .catch(() => {
      feedback.innerHTML = `<div class="text-danger">Something went wrong.</div>`;
    });
  });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const paymentOnline = document.getElementById('paymentOnline');
    const paymentCod = document.getElementById('paymentCod');
    const paymentTabby = document.getElementById('paymentTabby');
    const paymentSection = document.querySelector('.payment-section');

    function togglePaymentSection() {
      if (paymentOnline.checked || paymentTabby.checked) {
        paymentSection.style.display = 'block';
      } else {
        paymentSection.style.display = 'none';
      }
    }

    paymentOnline.addEventListener('change', togglePaymentSection);
    paymentCod.addEventListener('change', togglePaymentSection);
    paymentTabby.addEventListener('change', togglePaymentSection);

    togglePaymentSection(); // Run on load
  });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const requiredFields = [
      'date_of_birth',
      'email',
      'delivery_location',
      'receiving_location',
      'phone',
      'whatsapp'
    ];

    form.addEventListener('submit', function (e) {
      let isValid = true;

      requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        const parent = field.closest('.form-group');

        // Remove previous error message if any
        const existingError = parent.querySelector('.text-danger.js-required');
        if (existingError) existingError.remove();

        if (!field.value.trim()) {
          isValid = false;
          const error = document.createElement('small');
          error.classList.add('text-danger', 'js-required');
          error.innerText = 'This field is required';
          parent.appendChild(error);
        }
      });

      if (!isValid) {
        e.preventDefault(); // Stop form submission
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Optional scroll to top
      }
    });
  });
  </script>


</body>

</html>