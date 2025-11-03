<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Payment Method</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  @include('frontend.includes.style')
  <style>
    body {
      background-color: #000002;
      font-family: Arial, sans-serif;
      color: #fff;
    }

    .rc-add-payment {
      padding: 50px 0;
      min-height: 100vh;
      background: rgba(0, 0, 0, 1);
    }

    .rc-add-payment-form.form-horizontal {
      padding: 0;
      margin: 70px 0 0;
    }

    .rc-add-payment-form.form-horizontal .form-group-wrap + .form-group-wrap {
      margin-top: 45px;
    }

    .rc-add-payment-form-wrap {
      gap: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .rc-add-payment-form-personal-info,
    .rc-add-payment-form-card-info {
      width: 100%;
      max-width: 600px;
    }

    .rc-add-payment-form-personal-info :where(h2, h3),
    .rc-add-payment-form-card-info :where(h3) {
      font-size: 18px;
      font-weight: 600;
      margin: 0 0 15px;
      color: var(--text-color);
    }

    .rc-add-payment-form-coupon-code {
      gap: 20px;
      display: flex;
      margin: 0 0 30px;
      align-items: center;
    }

    .rc-add-payment-form-coupon-code .form-control {
      width: 100%;
      height: 46px;
      padding: 0 15px;
      font-size: 18px;
      border-radius: 25px;
      color: var(--theme-color);
      border: 1px solid var(--theme-color);
      background-color: rgb(var(--theme-color), 0.2);
    }

    .rc-add-payment-form-coupon-code .form-control::placeholder {
      color: var(--theme-color);
    }

    .rc-add-payment-form-coupon-code .rc-btn-theme {
      margin-top: 0;
    }

    .license-section {
      margin: 30px 0 0;
    }

    .license-section > label {
      font-size: 12px;
      font-weight: 500;
      margin: 0 0 10px;
      color: rgba(141, 141, 141, 1);
    }

    .license-section .form-group {
      gap: 40px;
      display: flex;
      align-items: center;
      flex-direction: row;
      justify-content: space-between;
    }

    .license-section .form-group:before,
    .license-section .form-group:after {
      display: none;
    }

    .license-section .custom-radio {
      width: 100%;
    }

    .license-section .custom-radio input[type="radio"] {
      margin: 0;
    }

    .payment-method-wrap {
      gap: 40px;
      display: flex;
    }

    .rc-add-payment-form-card-info .radio-group label {
      font-size: 12px;
      font-weight: 500;
      color: rgba(141, 141, 141, 1);
    }

    .payment-method-wrap .payment-method {
      width: 100%;
      max-width: 220px;
    }

    .payment-method label {
      font-size: 14px;
      font-weight: 500;
      color: rgba(141, 141, 141, 1);
      justify-content: space-between;
    }

    .payment-method input[type="radio"]:checked ~ label {
      color: var(--text-color);
    }

    .card-input-wrapper {
      position: relative;
    }

    .card-logo {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      width: 40px;
      height: auto;
    }

    .expiry-security {
      display: flex;
      justify-content: space-between;
      gap: 15px;
    }

    .expiry-security .form-group {
      flex: 1;
    }

    .payment-method-section {
      padding: 15px;
      border-radius: 20px;
      margin: 40px 0 20px;
      border: 1px solid rgba(101, 99, 99, 1);
      background: linear-gradient(140.97deg, #131313 23.76%, #1F1D1D 61.91%, #2A2828 74.58%, #262525 85.17%);
    }

    .payment-method-section h6 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 7px;
      color: var(--text-color);
    }

    .payment-method-section p {
      font-size: 14px;
      margin-bottom: 15px;
      color: rgba(101, 98, 99, 1);
    }

    .payment-logos {
      gap: 8px;
      display: flex;
      align-items: center;
    }

    .payment-logos img {
      width: auto;
      height: 16px;
    }

    .checkbox-group {
      margin: 20px 0;
    }

    .custom-checkbox {
      display: flex;
      align-items: center;
    }

    .custom-checkbox input[type="checkbox"] {
      width: 20px;
      height: 20px;
      cursor: pointer;
      border-radius: 5px;
      margin-right: 10px;
    }

    .custom-checkbox label {
      margin: 0;
      cursor: pointer;
      font-size: 12px;
      font-weight: 500;
      color: rgba(141, 141, 141, 1);
    }

    .custom-checkbox label a {
      color: #ce933c;
      text-decoration: underline;
    }

    .custom-checkbox label a:hover {
      color: #b8822a;
    }

    .pay-btn-wrap {
      display: flex;
      justify-content: flex-start;
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid;
    }

    .alert-danger {
      background-color: rgba(220, 53, 69, 0.1);
      border-color: #dc3545;
      color: #f8d7da;
    }

    .alert-success {
      background-color: rgba(40, 167, 69, 0.1);
      border-color: #28a745;
      color: #d4edda;
    }

    @media (max-width: 768px) {
      .expiry-security {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
<section class="rc-add-payment rc-bg-shape-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rc-section-title">
                    <div class="rc-section-title-content">
                        <span>{{ __('checkout.checkout_tagline') }}</span>
                        <h2 class="modal-title" id="addToCartModalLabel">{{ __('checkout.checkout') }}</h2>
                    </div>
                    <button type="button" class="rc-btn-theme btn-back" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('vahicles') }}'">
                        <i class="fa fa-chevron-left icon-left"></i>Back
                    </button>
                </div>

                @if(session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('payment.method.store') }}" id="paymentForm" class="rc-add-payment-form form-horizontal" enctype="multipart/form-data">
                  @csrf

                  <div class="rc-add-payment-form-wrap">
                    <div class="rc-add-payment-form-personal-info">
                      <h2>Do You Have A Coupon Code ?</h2>
                      <div class="rc-add-payment-form-coupon-code">
                        <input type="text" class="form-control" id="coupon_code" placeholder="Coupon Code" name="coupon_code" value="" required="" data-original-title="" title="">
                        <button type="button" class="rc-btn-theme">Apply</button>
                      </div>
                      <h3>Personal Information</h3>
                      <div class="form-group-wrap">
                        <div class="form-group form-group-half">
                          <label for="name">Full Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" value="" required="" data-original-title="" title="">
                        </div>
                        <div class="form-group form-group-half">
                          <label for="name">Nationality</label>
                          <input type="text" class="form-control" id="name" placeholder="Nationality" name="name" value="" data-original-title="" title="">
                        </div>
                      </div>
                      <div class="form-group-wrap">
                        <div class="form-group form-group-half">
                          <label for="name">Email</label>
                          <input type="text" class="form-control" id="name" placeholder="Email" name="name" value="" required="" data-original-title="" title="">
                        </div>
                        <div class="form-group form-group-half">
                          <label for="name">Phone Number</label>
                          <input type="text" class="form-control" id="name" placeholder="Phone Number" name="name" value="" data-original-title="" title="">
                        </div>
                      </div>
                      <div class="form-group-wrap">
                        <div class="form-group form-group-half">
                          <label for="name">Date of Birth</label>
                          <input type="text" class="form-control" id="name" placeholder="Date of Birth" name="name" value="" required="" data-original-title="" title="">
                        </div>
                        <div class="form-group form-group-half">
                          <label for="name">Whats app</label>
                          <input type="text" class="form-control" id="name" placeholder="Whats app" name="name" value="" data-original-title="" title="">
                        </div>
                      </div>
                      <div class="form-group-wrap">
                        <div class="form-group form-group-half">
                          <label for="name">Delivery Location</label>
                          <input type="text" class="form-control" id="name" placeholder="Delivery Location" name="name" value="" required="" data-original-title="" title="">
                        </div>
                        <div class="form-group form-group-half">
                          <label for="name">Receiving Location</label>
                          <input type="text" class="form-control" id="name" placeholder="Receiving Location" name="name" value="" data-original-title="" title="">
                        </div>
                      </div>
                      <div class="license-section">
                        <label>{{ __('checkout.have_international_license') }}</label>
                        <div class="form-group">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="licenseYes" name="license" value="yes" class="custom-control-input" checked>
                            <label class="custom-control-label" for="licenseYes" style="color: #fff; cursor: pointer;">{{ __('checkout.yes') }}</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="licenseNo" name="license" value="no" class="custom-control-input">
                            <label class="custom-control-label" for="licenseNo" style="color: #fff; cursor: pointer;">{{ __('checkout.no') }}</label>
                          </div>
                        </div>
                        <!-- <div id="licenseUploadWrapper" class="form-group" style="display: none; margin-top: 15px;">
                          <label for="licenseFiles" style="color: #ce933c;">Upload License</label>
                          <input type="file" name="license_files[]" id="licenseFiles"
                            class="form-control" multiple accept=".jpg,.jpeg,.png,.pdf" />
                          <small style="color: #888;">Accepted formats: JPG, PNG, PDF</small>
                        </div> -->
                      </div>
                      <textarea class="form-control" rows="10" placeholder="Special Requests" name="message"></textarea>
                    </div>
                    <div class="rc-add-payment-form-card-info">
                      <h3>Payment Method</h3>
                      <div class="radio-group">
                        <label>Select Payment Method</label>
                        <div class="payment-method-wrap">
                          <div class="payment-method custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="cardRadio" name="payment_method" value="card" checked="">
                            <label class="custom-control-label" for="cardRadio">
                              <span>Card</span>
                            </label>
                          </div>
                          <div class="payment-method custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="cashOnDeliveryRadio" name="payment_method" value="cash_on_delivery">
                            <label class="custom-control-label" for="cashOnDeliveryRadio">
                              <span>Cash on Delivery</span>
                            </label>
                          </div>
                        </div>
                      </div>

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

                      <div class="form-section">
                        <h3>Card Information</h3>
                        
                        <div class="form-group">
                          <label for="card_number">Card Number</label>
                          <div class="card-input-wrapper">
                            <input type="text" 
                                  class="form-control" 
                                  id="card_number" 
                                  name="card_number" 
                                  placeholder="1234 5678 9012 3456"
                                  maxlength="19"
                                  required
                                  pattern="[0-9\s]{13,19}">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" 
                                alt="Card" 
                                class="card-logo" 
                                id="cardLogo"
                                style="display: none;">
                          </div>
                          <small class="text-muted" style="color: #888;">Enter 13-19 digits</small>
                        </div>

                        <div class="form-group">
                          <label for="cardholder_name">Cardholder Name</label>
                          <input type="text" 
                                class="form-control" 
                                id="cardholder_name" 
                                name="cardholder_name" 
                                placeholder="Full Name"
                                required
                                pattern="[A-Za-z\s]{3,50}">
                        </div>

                        <div class="expiry-security">
                          <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="text" 
                                  class="form-control" 
                                  id="expiry_date" 
                                  name="expiry_date" 
                                  placeholder="MM/YY"
                                  maxlength="5"
                                  required
                                  pattern="(0[1-9]|1[0-2])\/\d{2}">
                            <small class="text-muted" style="color: #888;">MM/YY format</small>
                          </div>

                          <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" 
                                  class="form-control" 
                                  id="cvv" 
                                  name="cvv" 
                                  placeholder="123"
                                  maxlength="4"
                                  required
                                  pattern="\d{3,4}">
                            <small class="text-muted" style="color: #888;">3-4 digits</small>
                          </div>
                        </div>
                      </div>

                      <div class="checkbox-group">
                        <div class="custom-checkbox">
                          <input type="checkbox" id="save_card" name="save_card" value="1">
                          <label for="save_card">Save this card for future payments</label>
                        </div>
                      </div>

                      <div class="checkbox-group">
                        <div class="custom-checkbox">
                          <input type="checkbox" id="terms" name="terms" required>
                          <label for="terms">
                            By processing payment, you agree to our 
                            <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms and Conditions</a>
                          </label>
                        </div>
                      </div>

                      <div class="pay-btn-wrap">
                        <button type="submit" class="rc-btn-theme" id="submitBtn">
                          Pay to Proceed
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/img/bg-shape-2.png') }}" alt="Shape" class="rc-bg-shape">
</section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      // Format card number with spaces
      $('#card_number').on('input', function() {
        let value = $(this).val().replace(/\s/g, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        $(this).val(formattedValue);
        
        // Show card logo based on first digit
        if (value.length > 0) {
          $('#cardLogo').show();
          const firstDigit = value[0];
          if (firstDigit === '4') {
            $('#cardLogo').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg');
          } else if (firstDigit === '5') {
            $('#cardLogo').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg');
          } else if (firstDigit === '3') {
            $('#cardLogo').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/f/fa/American_Express_logo_%282018%29.svg');
          } else {
            $('#cardLogo').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/7/72/Discover_Card_logo.svg');
          }
        } else {
          $('#cardLogo').hide();
        }
      });

      // Format expiry date MM/YY
      $('#expiry_date').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length >= 2) {
          value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        $(this).val(value);
      });

      // Only allow numbers for CVV
      $('#cvv').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
      });

      // Form submission
      $('#paymentForm').on('submit', function(e) {
        const submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true).text('Processing...');
        
        // Note: In production, this should use a payment gateway API (like Stripe, PayPal, etc.)
        // For now, this is just the frontend form structure
      });

      // License upload toggle
      const licenseYes = $('#licenseYes');
      const licenseNo = $('#licenseNo');
      const licenseUploadWrapper = $('#licenseUploadWrapper');
      const licenseFiles = $('#licenseFiles');

      function toggleLicenseUpload() {
        if (licenseYes.is(':checked')) {
          licenseUploadWrapper.show();
          licenseFiles.attr('required', 'required');
        } else {
          licenseUploadWrapper.hide();
          licenseFiles.removeAttr('required');
          licenseFiles.val('');
        }
      }

      licenseYes.on('change', toggleLicenseUpload);
      licenseNo.on('change', toggleLicenseUpload);
      
      // Initialize on page load
      toggleLicenseUpload();
    });
  </script>
</body>
</html>

