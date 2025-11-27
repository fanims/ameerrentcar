<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  @include('frontend.includes.style')
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