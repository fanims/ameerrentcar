<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Details</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  @include('frontend.includes.style')
  <style>

    .rc-booking-details {
      padding: 50px 0;
      min-height: 100vh;
      background: rgba(0, 0, 0, 1);
    }

    a.rc-btn-theme {
      color: var(--text-dark-color) !important;
    }

    a.rc-btn-theme:hover {
      color: var(--theme-color) !important;
    }

    .form-row .form-group {
      margin-bottom: 15px;
    }

    .license-section {
      margin-top: 20px;
      font-size: 0.9rem;
      color: #ce933c;
    }

    .custom-radio {
      cursor: pointer; 
    }

    .custom-radio .custom-control-label {
      padding-left: 10px;
    }

    .custom-radio .custom-control-label::before {
      margin: 2px 0;
      width: 1.7rem;
      height: 1.7rem;
      background-color: #fff;
      border-color: var(--theme-color);
      border: 2px solid var(--theme-color);
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::before {
      background-color: #fff;
      border: 4px solid var(--theme-color);
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::after {
      background-image: none;
    }

    .custom-control-label::before,
    .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
      width: 1.5rem;
      height: 1.5rem;
    }

    .payment-logos img {
      width: 40px;
      margin-right: 10px;
    }

    .terms-section label {
      gap: 10px;
      display: flex;
      padding-left: 10px;
      flex-direction: column;
      align-items: flex-start;
    }
  </style>
</head>

<body>
  <section class="rc-booking-details">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="rc-section-title">
              <div class="rc-section-title-content">
                <span>{{ __('checkout.checkout_tagline') }}</span>
                <h2 class="modal-title" id="checkoutModalLabel">{{ __('checkout.checkout') }}</h2>
              </div>
              <a href="{{ route('checkout-form', $car->id) }}" class="rc-btn-theme btn-back"><i class="fa fa-arrow-left icon-left"></i> Back</a>
            </div>
          </div>
          <form action="{{ route('booking.store', $car->id) }}" method="POST" enctype="multipart/form-data" class="rc-add-payment-form form-horizontal">
            <div class="rc-add-payment-form-wrap">
              <div class="rc-add-payment-form-personal-info">
                <h3>{{ __('checkout.fillout_the_form') }}</h3>
                <div>
                  <h2><label for="couponCode">{{ __('checkout.have_coupon') }}</label></h2>
                  <div class="rc-add-payment-form-coupon-code">
                    <input type="text" class="form-control" id="couponCode" placeholder="COUPON CODE" />
                    <button type="button" class="rc-btn-theme" id="applyCouponBtn">{{ __('checkout.apply_coupon') }}</button>
                  </div>
                  <div id="couponFeedback" class="mt-2"></div>
                </div>
                @csrf
                <h3>{{ __('checkout.personal_details') }}</h3>
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
              <div class="rc-add-payment-form-card-info">
                <h3>Payment Method</h3>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="paymentOnline" name="payment_method" value="online" class="custom-control-input"
                    checked>
                  <label class="custom-control-label" for="paymentOnline">Zinna Pay</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="paymentCod" name="payment_method" value="cod" class="custom-control-input">
                  <label class="custom-control-label" for="paymentCod">Cash on Delivery</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="paymentTabby" name="payment_method" value="tabby" class="custom-control-input">
                  <label class="custom-control-label" for="paymentTabby">Tabby</label>
                </div>
          
                <!-- Tabby Test Payment Button (shown only when Tabby is selected and API keys are not configured) -->
                @php
                $tabbyService = new \App\Services\TabbyService();
                $isTabbyConfigured = $tabbyService->isConfigured();
                $tabbyMode = $tabbyService->getMode();
                @endphp
                
                @if(!$isTabbyConfigured)
                <div id="tabbyTestButton" class="form-section" style="display: none; background-color: #fff3cd; border-color: #ffc107;">
                  <h5 style="color: #856404;">🧪 Tabby Test Mode</h5>
                  <p style="color: #856404; font-size: 0.9rem; margin-bottom: 15px;">
                    <strong>Tabby API credentials are not configured.</strong> You can test the payment flow with this simulation button, or configure your Tabby credentials in the <code>.env</code> file to use the real Tabby payment gateway.
                  </p>
                  <a href="{{ route('tabby.payment.simulate') }}" class="btn btn-warning" style="width: 100%;">
                    Simulate Successful Tabby Payment
                  </a>
                  <small style="color: #856404; display: block; margin-top: 10px;">
                    This will create a test order with payment status "paid" without going through the actual Tabby payment gateway.
                  </small>
                </div>
                @else
                <div id="tabbyInfoButton" class="form-section" style="display: none; background-color: #d1ecf1; border-color: #0c5460;">
                  <h5 style="color: #0c5460;">ℹ️ Tabby Payment</h5>
                  <p style="color: #0c5460; font-size: 0.9rem; margin-bottom: 15px;">
                    Tabby is configured and ready. Current mode: <strong>{{ strtoupper($tabbyMode) }}</strong>
                    @if($tabbyMode === 'test')
                    <br><small>You are using Tabby Sandbox/Test mode. Configure production credentials to process real payments.</small>
                    @endif
                  </p>
                </div>
                @endif

                <div class="payment-method-section">
                  <h6>Secure Payment</h6>
                  <p>Your payment information is encrypted and secure. We accept the following payment methods:</p>
                  <div class="payment-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" />
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" />
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/American_Express_logo_%282018%29.svg" alt="American Express" />
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Discover_Card_logo.svg" alt="Discover" />
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
                <div class="pay-btn-wrap">
                  <button type="submit" class="rc-btn-theme">
                    {{ __('checkout.pay_to_proceed') }}
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>



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
    const paymentMethodSection = document.querySelector('.payment-method-section');
    const tabbyTestButton = document.getElementById('tabbyTestButton');
    const tabbyInfoButton = document.getElementById('tabbyInfoButton');

    function togglePaymentSection() {
      // Show/hide payment method section (card logos, etc.) for online/Tabby payments
      if (paymentMethodSection) {
        if (paymentOnline && paymentOnline.checked || paymentTabby && paymentTabby.checked) {
          paymentMethodSection.style.display = 'block';
        } else if (paymentCod && paymentCod.checked) {
          paymentMethodSection.style.display = 'none';
        }
      }

      // Show/hide Tabby test/info button based on Tabby selection
      if (paymentTabby && paymentTabby.checked) {
        if (tabbyTestButton) {
          tabbyTestButton.style.display = 'block';
        }
        if (tabbyInfoButton) {
          tabbyInfoButton.style.display = 'block';
        }
      } else {
        if (tabbyTestButton) {
          tabbyTestButton.style.display = 'none';
        }
        if (tabbyInfoButton) {
          tabbyInfoButton.style.display = 'none';
        }
      }
    }

    // Add event listeners
    if (paymentOnline) {
      paymentOnline.addEventListener('change', togglePaymentSection);
    }
    if (paymentCod) {
      paymentCod.addEventListener('change', togglePaymentSection);
    }
    if (paymentTabby) {
      paymentTabby.addEventListener('change', togglePaymentSection);
    }

    // Run on page load to set initial state
    togglePaymentSection();
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