<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  @section('style')
  <style>

    :root {
        --phantom-beige: #ce933c;
        --phantom-brown: #ce933c;
        --phantom-text: #ce933c;
        --phantom-border: #ce933c;
        --phantom-white: #000002;
        --text-color: #FFFFFF;
        --theme-color: #CE933C;
        --border-color: #656363;
        --text-dark-color: #000002;
        --theme-dark-color: #000002;
        --text-light-color: #A4A4A4EE;
    }

    body {
      background-color: #000000;
      color: rgba(101, 98, 99, 1);
      font-family: Arial, sans-serif;
    }
    .rc-btn-theme {
        gap: 5px;
        line-height: 1;
        font-size: 14px;
        min-width: 190px;
        font-weight: 600;
        padding: 15px 22px;
        border-radius: 25px;
        align-items: center;
        display: inline-flex;
        justify-content: center;
        text-transform: uppercase;
        color: var(--text-dark-color);
        transition: all 0.2s ease-in-out;
        font-family: "Outfit", sans-serif;
        border: 1px solid var(--theme-color);
        background-color: var(--theme-color);
        -webkit-transition: all 0.2s ease-in-out;
    }
    .rc-btn-theme:hover {
        background-color: #000002;
        border-color: #ce933c;
        color: #ce933c;
    }
    a.rc-btn-theme {
      text-decoration: none;
    }

    .rc-btn-theme .icon-left {
        margin-right: 7px;
    }

    .rc-btn-theme .icon-right {
        margin-left: 7px;
    }

    .rc-checkout-form {
        background: rgba(0, 0, 0, 1);
    }

    .rc-checkout-form .modal-dialog {
        width: 100%;
        max-width: 1300px;
    }

    .modal-content {
      border: none;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
      position: relative;
      border-bottom: none;
      justify-content: center;
      color: var(--text-color);
      background-color: rgba(0, 0, 0, 1);
    }

    .modal-header .rc-section-title {
      text-align: center;
    }

    .modal-header .btn-back {
      top: 20px;
      left: -175px;
      min-width: auto;
      position: absolute;
    }

    .modal-body {
      padding: 0 40px;
      background-color: #000000;
    }

    .car-checkout-details {
      display: flex;
      margin-top: 50px;
      align-items: self-start;
    }

    .car-checkout-details-content {
      width: 100%;
      margin-right: 64px;
      padding-right: 64px;
      border-right: 1px solid rgba(211, 211, 211, 0.6);
    }

    .car-checkout-details-content .custom-control-label {
      color: #ce933c;
      cursor: pointer;
      font-size: 0.9rem;
    }

    .car-checkout-details-content .custom-switch {
      padding: 0;
    }
    
    .car-checkout-details-content .custom-control-label::before {
      width: 54px;
      height: 26px;
      border-radius: 50px;
      border: 1px solid rgba(101, 99, 99, 1);
      background: linear-gradient(140.97deg, #131313 23.76%, #1F1D1D 61.91%, #2A2828 74.58%, #262525 85.17%);
    }

    .car-checkout-details-content .custom-switch .custom-control-label::after {
      top: 7px;
      left: -32px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: rgba(141, 141, 141, 1);
    }

    .car-checkout-details-content .custom-switch .custom-control-input:checked~.custom-control-label::after {
      transform: translateX(1.60rem);
      background-color: var(--theme-color);
    }

    .car-checkout-details-form {
      width: 100%;
    }

    .car-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 7px;
      color: var(--text-color);
    }

    .car-title ~ span {
      display: block;
      font-size: 18px;
      font-weight: 400;
      padding-bottom: 7px;
      margin-bottom: 15px;
      border-bottom: 1px solid rgba(211, 211, 211, 0.6);
    }

    .form-group label {
      font-size: 18px;
      margin-bottom: 10px;
      text-transform: capitalize;
    }

    .form-control {
      padding: 0;
      height: 46px;
      border: none;
      font-size: 18px;
      background-color: transparent !important;
      border-bottom: 1px solid rgba(101, 99, 99, 1);
    }

    .date-time-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .date-time-row .form-group {
      width: 48%;
      margin-bottom: 0;
    }

    .pricing-item {
      display: flex;
      margin-bottom: 15px;
      align-items: center;
      justify-content: space-between;
    }

    .pricing-item:has(.custom-switch) span {
      width: 90%;
    }

    .pricing-item .price {
      font-size: 14px;
      font-weight: 400;
      color: rgba(164, 164, 164, 0.93);
    }

    .pricing-item.custom-radio {
      cursor: pointer;
      margin-bottom: 0;
    }

    .radio-group {
      gap: 20px 40px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .custom-control-label {
      gap: 20px;
      display: flex;
      font-size: 18px;
      font-weight: 500;
      flex-wrap: nowrap;
      align-items: center;
      color: var(--text-color);
      justify-content: space-between;
    }

    .custom-switch {
      padding: 0;
    }
    
    .custom-control-label::before {
      background-color: #ccc;
      border: none;
    }

    .custom-switch .custom-control-input:checked~.custom-control-label::before {
      background-color: #ce933c;
    }

    .custom-switch .custom-control-label::after {
      background-color: #fff;
    }

    .total {
      display: flex;
      font-size: 18px;
      font-weight: 600;
      margin-top: 15px;
      padding-top: 15px;
      color: var(--text-color);
      justify-content: space-between;
      border-top: 1px solid rgba(211, 211, 211, 0.6);
    }

    .form-image {
      width: 100%;
      height: 225px;
      margin: 15px 0 0;
      border-radius: 15px;
    }

    .form-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 15px;
    }

    .btns-wrap {
      gap: 20px;
      display: flex;
      flex-wrap: wrap;
      margin-top: 24px;
      align-items: center;
      justify-content: center;
    }

    @media (max-width: 991px) {
      .car-checkout-details {
          flex-wrap: wrap;
      }
      .car-checkout-details-content {
        margin-right: 0;
        padding-right: 0;
        border-right: none;
      }
      .car-checkout-details-form {
        margin-top: 30px;
      }
    }
    @media (max-width: 576px) {
      .date-time-row {
        flex-wrap: wrap;
      }
      .date-time-row .form-group {
        width: 100%;
      }
      .btns-wrap .rc-btn-theme {
        width: 100%;
        padding: 12px 18px;
      }
    }
    
  </style>
</head>

<body>
  <section class="rc-checkout-form">
    <div class="container-fluid modal fade" id="checkoutModal" tabindex="-1" role="dialog"
      aria-labelledby="checkoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <div class="rc-section-title">
              <div class="rc-section-title-content">
                <span>{{ __('checkout.checkout_tagline') }}</span>
                <h2 class="modal-title" id="checkoutModalLabel">{{ __('checkout.checkout') }}</h2>
              </div>
            </div>
            <button type="button" class="rc-btn-theme btn-back" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-arrow-left icon-left"></i>
              <span aria-hidden="true" onclick="window.location.href='{{ route('checkout', $car->slug) }}'">Back</span>
            </button>
          </div>
          <form class="modal-body" method="POST" action="{{ route('store.checkout', $car->id) }}"
            data-hour-price="{{ $car->current_price_per_hour }}" data-day-price="{{ $car->current_price_per_day }}"
            data-week-price="{{ $car->current_price_per_week }}" data-month-price="{{ $car->current_price_per_month }}">
            @csrf
            <div class="car-checkout-details">
              <div class="car-checkout-details-content">
                <div class="car-title">{{ $car->base_price_per_day }} .AED/per a day</div>
                <span>Brand: {{ trans_field($car->name) }} with manufacturing year {{ $car->model_year }}</span>
                @php
                $generalPrices = get_general_prices();
                $extras = [
                ['id' => 'driver_price', 'label' => 'Driver Price', 'price' => $generalPrices->driver_price],
                ['id' => 'deposit_fee', 'label' => 'Deposit Fee (NON Refundable and Valid for only 3 days)', 'price' =>
                $generalPrices->deposit_fee],
                ['id' => 'fuel_tank_fee', 'label' => 'Fuel Tank Fee', 'price' => $generalPrices->fuel_tank_fee],
                ['id' => 'extra_km_fee', 'label' => 'Extra KM Fee', 'price' => $generalPrices->extra_km_fee],
                ['id' => 'baby_seat_fee', 'label' => 'Baby Seat Fee', 'price' => $generalPrices->baby_seat_fee],
                ['id' => 'delivery_outside_fee', 'label' => 'Delivery Outside City Fee', 'price' =>
                $generalPrices->delivery_outside_fee],
                ];
                @endphp

                @foreach ($extras as $extra)
                <div class="pricing-item">
                  <span>{{ $extra['label'] }} - {{ $extra['price'] }} AED</span>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input extra-charge" id="{{ $extra['id'] }}" name="extras[]"
                      value="{{ $extra['id'] }}" data-price="{{ $extra['price'] }}" {{ $extra['id'] === 'deposit_fee' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="{{ $extra['id'] }}"></label>
                    <input type="hidden" name="extra_prices[{{ $extra['id'] }}]" value="{{ $extra['price'] }}">
                  </div>
                </div>
                @endforeach

                <div class="pricing-item">
                  <span>Tax:</span>
                  <span class="price">{{ $generalPrices->tax }} %</span>
                </div>

                <input type="hidden" name="grand_total" id="grandTotalInput" value="">
                <input type="hidden" name="driver_price" id="driverPriceInput" value="">
                <input type="hidden" name="subtotal" id="subtotalInput" value="">
                <input type="hidden" name="tax" id="taxInput" value="{{ $generalPrices->tax }}">
                <div class="pricing-item">
                  <span>Subtotal:</span>
                  <span class="price" id="calculatedSubtotal">— AED</span>
                </div>
                <div class="pricing-item">
                    <span>*Extra charges will be charged if you don't select Self Pickup*</span>
                </div>
                <div class="total">
                  <span>{{ __('checkout.total') }}</span>
                  <span class="price" id="calculatedTotal">— AED</span>
                </div>
              </div>
              <div class="car-checkout-details-form">
                <div class="form-group">
                  <label>{{ __('checkout.pickup_date_and_time') }}</label>
                  <div class="date-time-row">
                    <div class="form-group">
                      <input type="date" class="form-control" id="pickupDate" name="pickup_date" />
                      @error('pickup_date')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="time" placeholder="HH:MM" class="form-control small-picker" id="pickupTime" name="pickup_time" />
                      @error('pickup_time')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>{{ __('checkout.dropoff_date_and_time') }}</label>
                  <div class="date-time-row">
                    <div class="form-group">
                      <input type="date" class="form-control" id="dropoffDate" name="dropoff_date" />
                      @error('dropoff_date')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="time" placeholder="HH:MM" class="form-control small-picker" id="dropoffTime" name="dropoff_time" />
                      @error('dropoff_time')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="radio-group">
                  <div class="pricing-item custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="rentPerHourRadio" name="rental_type" value="hour"
                      checked>
                    <label class="custom-control-label" for="rentPerHourRadio">
                      <span>{{ __('checkout.rent_per_hr') }}</span>
                      <span class="price" id="rentPerHour">{{ $car->current_price_per_hour }} AED</span>
                    </label>
                  </div>
                  <div class="pricing-item custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="rentPerDayRadio" name="rental_type" value="day">
                    <label class="custom-control-label" for="rentPerDayRadio">
                      <span>RENT PER DAY :</span>
                      <span class="price">{{ $car->base_price_per_day }} AED</span>
                    </label>
                  </div>
                </div>
                <figure class="form-image">
                  <img src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="Form Image">
                </figure>
              </div>
            </div>
            <div class="btns-wrap">
              <a href="{{ route('add-to-cart', $car->id) }}" class="rc-btn-theme">
                {{ __('checkout.add_to_cart') }}
              </a>
              <button class="rc-btn-theme" type="submit">
                {{ __('checkout.book_now') }}
              </button>
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
      $("#checkoutModal").modal({
        backdrop: 'static',
        keyboard: false
      }); 
        var today = new Date().toISOString().split("T")[0];
        $("#pickupDate").val(today);
        $("#dropoffDate").val(today);
      });
  </script>
<script>
  function togglePickerSize(pickerId) {
    const input = document.querySelector(pickerId);
    flatpickr(pickerId, {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true,
      onOpen: function () {
        input.classList.add("picker-open");
      },
      onClose: function () {
        input.classList.remove("picker-open");
      }
    });
  }

  togglePickerSize("#pickupTime");
  togglePickerSize("#dropoffTime");
</script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form.modal-body');
    const pickupDate = document.getElementById('pickupDate');
    const pickupTime = document.getElementById('pickupTime');
    const dropoffDate = document.getElementById('dropoffDate');
    const dropoffTime = document.getElementById('dropoffTime');
    const extras = document.querySelectorAll('.extra-charge');
    const totalDisplay = document.getElementById('calculatedTotal');
    const totalInput = document.getElementById('grandTotalInput');
    const subtotalInput = document.getElementById('subtotalInput');
    const taxRate = parseFloat(document.getElementById('taxInput').value); // Tax % (e.g., 5)

    const hourPrice = parseFloat(form.dataset.hourPrice);
    const dayPrice = parseFloat(form.dataset.dayPrice);

    const rentalTypeInputs = document.querySelectorAll('input[name="rental_type"]');

    const calculateDuration = (pickup, dropoff) => {
      const msDiff = dropoff - pickup;
      const hours = msDiff / (1000 * 60 * 60);
      const days = msDiff / (1000 * 60 * 60 * 24);
      return { hours, days };
    };

    const calculateTotal = () => {
      const pickup = new Date(`${pickupDate.value}T${pickupTime.value}`);
      const dropoff = new Date(`${dropoffDate.value}T${dropoffTime.value}`);
      const selectedType = document.querySelector('input[name="rental_type"]:checked').value;
      const subtotalDisplay = document.getElementById('calculatedSubtotal');


      if (isNaN(pickup.getTime()) || isNaN(dropoff.getTime()) || dropoff <= pickup) {
        totalDisplay.textContent = '— AED';
        totalInput.value = '';
        subtotalInput.value = '';
        return;
      }

      const { hours, days } = calculateDuration(pickup, dropoff);
      let rentalCost = 0;

      if (selectedType === 'day') {
        const wholeDays = Math.floor(hours / 24);
        const remainingHours = hours % 24;
        rentalCost = (wholeDays * dayPrice) + (remainingHours > 0 ? dayPrice : 0);
      } else {
        rentalCost = hours * hourPrice;
      }

      let extraCost = 0;
      extras.forEach(extra => {
        if (extra.checked) {
          const price = parseFloat(extra.dataset.price);
          extraCost += price;
        }
      });

      const subtotal = rentalCost + extraCost;
      const taxAmount = subtotal * (taxRate / 100);
      const grandTotal = Math.round(subtotal + taxAmount);

      // Update display & inputs
      subtotalDisplay.textContent = `${subtotal.toFixed(2)} AED`;
      totalDisplay.textContent = `${grandTotal} AED`;
      totalInput.value = grandTotal.toFixed(2);
      subtotalInput.value = subtotal.toFixed(2);
    };

    // Trigger calculation on any change
    [pickupDate, pickupTime, dropoffDate, dropoffTime, ...extras, ...rentalTypeInputs].forEach(input =>
      input.addEventListener('change', calculateTotal)
    );

    // Recalculate once on load
    calculateTotal();
  });
  </script>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months start at 0
    const dd = String(today.getDate()).padStart(2, '0');
    const todayFormatted = `${yyyy}-${mm}-${dd}`;

    const pickupDate = document.getElementById("pickupDate");
    const dropoffDate = document.getElementById("dropoffDate");

    pickupDate.setAttribute("min", todayFormatted);
    dropoffDate.setAttribute("min", todayFormatted);

    pickupDate.addEventListener("change", function () {
      dropoffDate.setAttribute("min", this.value);
    });
  });
  </script>


</body>

</html>