<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
      @section('meta_title')
          Ameer RAC | Add to Cart
      @endsection
  </title>
  @include('frontend.includes.style')
</head>
<body>
<!-- CONTENT AREA -->
<section class="rc-add-to-cart rc-bg-shape">
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
                <div class="rc-add-to-cart-cars-content-wrap">
                    <div class="rc-add-to-cart-content">
                        <form>
                            @forelse($cartCars ?? [] as $c)
                            <div class="form-group">
                                <input type="checkbox"
                                       class="js-cart-car"
                                       id="car-{{ $c->id }}"
                                       data-id="{{ $c->id }}"
                                       data-name="{{ trans_field($c->name) }}"
                                       data-model="{{ $c->model_year }}"
                                       data-category="{{ $c->category->name[App::getLocale()] ?? $c->category->name['en'] ?? 'N/A' }}"
                                       data-image="{{ asset('storage/'. $c->thumbnail_image) }}"
                                       data-price="{{ $c->current_price_per_day ?? 0 }}"
                                       checked>
                                <label for="car-{{ $c->id }}">
                                    <div class="rc-add-to-cart-cars-details">
                                        <figure>
                                            <img src="{{ asset('storage/'. $c->thumbnail_image) }}" alt="Car Image">
                                        </figure>
                                        <div class="rc-add-to-cart-cars-info">
                                            <span>{{ trans_field($c->name) }}</span>
                                            <span>Modal: {{ $c->model_year }}</span>
                                            <span>Category: {{ $c->category->name[App::getLocale()] ?? $c->category->name['en'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="rc-add-to-cart-cars-price">
                                          <span>AED {{ $c->current_price_per_day ?? 0 }} </span>
                                          <a class="rc-btn-theme" href="{{ route('checkout', $c->slug) }}">View Details</a>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @empty
                            <p class="text-warning">Your cart is empty. Go back and select a car.</p>
                            @endforelse
                        </form>
                    </div>
                    <div class="rc-add-to-cart-order-summary" id="summaryContainer">
                        <h3>Order Summary</h3>
                        <div id="orderSummaryList"></div>
                        <div id="orderSummaryTotals" class="rc-add-to-cart-order-info" style="display:none">
                            <ul>
                                <li>
                                    <span>Subtotal</span>
                                    :
                                    <span id="summary-subtotal">AED 0.00</span>
                                </li>
                                <li>
                                    <span>Tax (2.00%)</span>
                                    :
                                    <span id="summary-tax">AED 0.00</span>
                                </li>
                                <li>
                                    <span>Total</span>
                                    <span id="summary-total">AED 0.00</span>
                                </li>
                            </ul>
                        </div>
                        <button class="rc-btn-theme" id="checkoutBtn" onclick="window.location.href='{{ route('checkout', ($car->slug ?? '') ) }}'">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/img/bg-shape-2.png') }}" alt="Shape" class="rc-bg-shape">
</section>

<script>
  (function(){
    const AED = val => `AED ${Number(val).toFixed(2)}`;
    const taxRate = 0.02;
    const checkboxes = document.querySelectorAll('.js-cart-car');
    const list = document.getElementById('orderSummaryList');
    const totalsBox = document.getElementById('orderSummaryTotals');
    const summaryContainer = document.getElementById('summaryContainer');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const elSubtotal = document.getElementById('summary-subtotal');
    const elTax = document.getElementById('summary-tax');
    const elTotal = document.getElementById('summary-total');

    function render(){
      list.innerHTML = '';
      let subtotal = 0;
      const selected = document.querySelectorAll('.js-cart-car:checked');
      
      selected.forEach(cb => {
        const price = parseFloat(cb.dataset.price || '0');
        subtotal += price;

        // wrapper line item
        const item = document.createElement('div');

        // left: car details
        const details = document.createElement('div');
        details.className = 'rc-add-to-cart-cars-details';
        details.innerHTML = `
          <figure>
            <img src="${cb.dataset.image}" alt="Car Image">
          </figure>
          <div class="rc-add-to-cart-cars-info">
            <span>${cb.dataset.name}</span>
            <span>Model: ${cb.dataset.model}</span>
            <span>Category: ${cb.dataset.category}</span>
          </div>`;

        // right: order info (ul) – sibling of details
        const orderInfo = document.createElement('div');
        orderInfo.className = 'rc-add-to-cart-order-info';
        orderInfo.style.marginLeft = 'auto';
        orderInfo.innerHTML = `
          <ul>
            <li><span>Price (daily)</span> : <span>${AED(price)}</span></li>
          </ul>`;

        item.appendChild(details);
        item.appendChild(orderInfo);
        list.appendChild(item);
      });

      const tax = subtotal * taxRate;
      const total = subtotal + tax;
      if (selected.length > 0 && subtotal > 0) {
        summaryContainer.style.display = '';
        totalsBox.style.display = '';
        elSubtotal.textContent = AED(subtotal);
        elTax.textContent = AED(tax);
        elTotal.textContent = AED(total);
        if (checkoutBtn) checkoutBtn.style.display = '';
      } else {
        totalsBox.style.display = 'none';
        if (checkoutBtn) checkoutBtn.style.display = 'none';
        summaryContainer.style.display = 'none';
      }
    }

    checkboxes.forEach(cb => cb.addEventListener('change', render));
    render();
  })();
</script>
</body>
</html>