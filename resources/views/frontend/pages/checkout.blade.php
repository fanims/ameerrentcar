@extends('frontend.layout.layout')

@section('meta_title')
Ameer RAC | Checkout
@endsection

@section('style')
<style>
  :root {
    --phantom-beige: #8e7e6a;
    --phantom-brown: #ce933c;
    --phantom-light-brown: #c4af91;
    --phantom-text: #7a6a54;
    --phantom-light-bg: #f8f8f8;
    --phantom-white: #000002;
    --phantom-light-gray: #f5f5f5;
    --phantom-gray: #888888;
    --phantom-dark-text: #888888;
    --phantom-discount: #cd7f32;
  }

  body {
    font-family: 'Arial', sans-serif;
    background-color: var(--phantom-light-bg);
  }

  .car-detail-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
  }

  .car-images-container {
    position: relative;
    /* margin-bottom: 20px; */
  }

  .car-main-image {
    width: 100%;
    height: 267px;
    object-fit: cover;
    border-radius: 15px;
  }

  .car-thumbnail-container {
    gap: 5px;
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
    justify-content: center;
  }

  .car-thumbnail {
    width: 80px;
    height: 60px;
    cursor: pointer;
    object-fit: cover;
    border-radius: 8px;
    transition: opacity 0.3s;
    border: 2px solid rgba(164, 164, 164, 1);
  }
  
  .car-thumbnail:hover {
    opacity: 0.9;
    border: 2px solid rgba(206, 147, 60, 1);
  }

  .car-info-container {
    background-color: var(--phantom-white);
    border-radius: 8px;
    border: #ce933c;
    box-shadow: 0 2px 10px;
    padding: 0;
    overflow: hidden;
  }

  .car-title-banner {
    background-color: var(--phantom-brown);
    color: var(--phantom-white);
    text-align: center;
    padding: 15px;
    position: relative;
    overflow: hidden;
  }

  .car-title-banner h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .car-title-banner::before,
  .car-title-banner::after {
    content: '';
    position: absolute;
    top: 0;
    width: 100px;
    height: 100%;
    background: repeating-linear-gradient(45deg,
        var(--phantom-brown),
        var(--phantom-brown) 10px,
        var(--phantom-light-brown) 10px,
        var(--phantom-light-brown) 20px);
  }

  .car-title-banner::before {
    left: -50px;
    transform: skew(-20deg);
  }

  .car-title-banner::after {
    right: -50px;
    transform: skew(-20deg);
  }

  .car-specs {
    display: flex;
    justify-content: space-around;
    text-align: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
  }

  .car-spec-item {
    display: flex;
    align-items: center;
    width: calc(100% / 3);
    flex-direction: column;
  }

  .car-spec-icon {
    display: flex;
    font-size: 24px;
    margin-bottom: 5px;
    color: var(--phantom-brown);
  }

  .car-spec-value {
    font-size: 18px;
    font-weight: 500;
    color: rgba(164, 164, 164, 1);
  }

  .car-spec-label {
    font-size: 14px;
    color: var(--phantom-gray);
  }

  .price-section {
    margin: 0 0 15px;
    padding: 0 0 15px;
    border-bottom: 1px solid rgba(211, 211, 211, 0.6);
  }

  .price-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
  }
  
  .price-row + .price-row {
    margin-top: 15px;
  }

  .price-label {
    gap: 6px;
    display: flex;
    align-items: center;
  }

  .price-icon {
    font-size: 18px;
    color: var(--phantom-brown);
  }

  .price-value {
    font-size: 18px;
    font-weight: 500;
    color: rgba(164, 164, 164, 1);
  }

  .discount-price {
    width: 100%;
    display: flex;
    margin: 5px 0 0;
    align-items: center;
  }

  .price-unit {
    font-size: 14px;
    margin-left: 5px;
    color: rgba(164, 164, 164, 1);
  }

  .original-price {
    text-decoration: line-through;
    color: var(--phantom-gray);
    margin-right: 10px;
  }

  .discount-tag {
    color: var(--phantom-discount);
    font-weight: 500;
  }

  .mileage-value {
    gap: 6px;
    display: flex;
    align-items: center;
  }

  .divider {
    height: 1px;
    background-color: #eee;
    margin: 15px 0;
  }

  .color-section {
    gap: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .color-options {
    gap: 10px;
    display: flex;
    align-items: center;
  }

  .color-title {
    font-size: 18px;
    font-weight: 500;
    color: var(--text-color);
  }

  .color-icon {
    font-size: 18px;
    color: var(--phantom-brown);
  }

  .color-swatch {
    width: 16px;
    height: 16px;
    cursor: pointer;
    border-radius: 50%;
    transition: transform 0.2s;
  }

  .color-swatch:hover {
    transform: scale(1.1);
  }

  .color-swatch.active {
    border: 1px solid var(--phantom-brown);
  }

  .white-swatch {
    background-color: white;
  }

  .black-swatch {
    background-color: black;
  }

  .blue-swatch {
    background-color: #0066cc;
  }

  .gold-swatch {
    background-color: #daa520;
  }

  .action-buttons {
    gap: 6px;
    display: flex;
  }

  .action-btn {
    width: 34px;
    border: none;
    background: transparent;
    color: var(--text-color);
  }

  .action-btn i {
    font-size: 24px;
  }

  .book-btn {
    background-color: var(--phantom-brown);
    color: #000002;
  }

  .action-btn:hover {
    opacity: 0.9;
    transform: translateY(-2px);
  }

  .not-included-section {
    padding: 15px;
    margin-top: 20px;
    border-radius: 20px;
    border: 1px solid rgba(101, 99, 99, 1);
    background: linear-gradient(140.97deg, #131313 23.76%, #1F1D1D 61.91%, #2A2828 74.58%, #262525 85.17%);
  }

  .not-included-header {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-color);
    text-transform: uppercase;
  }

  .not-included-item {
    font-size: 14px;
    margin-top: 7px;
    color: rgba(101, 98, 99, 1);
  }

  .car-description-content {
    margin-top: 20px;
  }
  .car-description-content p {
    margin: 0;
    font-size: 18px;
    text-align: center;
    color: rgba(101, 98, 99, 1);
  }

    .car-main-image {
    transition: opacity 0.4s ease-in-out;
    opacity: 1;
  }

  .car-main-image.fade-out {
    opacity: 0;
  }
</style>
@endsection
    @php
    use App\Models\WebsiteSetting;
    $setting = WebsiteSetting::first();
    @endphp
@section('content')
<section class="page-section rc-detail-page">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="rc-section-title">
          <div class="rc-section-title-content">
            <span>{{ __('home.our_fleet_car_tagline') }}</span>
            <h2>{{ __('home.rent_luxury') }}</h2>
          </div>
        </div>
        <div class="rc-detail-content-wrap">
          <div class="rc-car-imgs-slider">
            <img id="mainCarImage" src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="{{ trans_field($car->name) }}"
              class="car-main-image">
            <div class="car-thumbnail-container">
              @foreach($car->images as $index => $image)
              <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ trans_field($car->name) }}"
                class="car-thumbnail" style="cursor: pointer;" onclick="changeMainImage(this)">
              @endforeach
            </div>
          </div>
          <div class="rc-car-details-content">
            <div class="rc-car-details-content-heading">
              <div class="rc-car-details-content-title">
                <h2>{{ trans_field($car->name) }}</h2>
                <span>
                  Brand: {{ trans_field($car->name) }} with manufacturing year {{ $car->model_year }}
                </span>
              </div>
              <div class="action-buttons">
                <button onclick="window.open('https://wa.me/{{ $setting->phone }}', '_blank')" class="action-btn whatsapp-btn">
                  <i class="fab fa-whatsapp"></i>
                </button>
                <button onclick="window.location.href='tel:{{ $setting->phone }}'" class="action-btn call-btn">
                  <i class="fa fa-phone"></i>
                </button>
                <button class="action-btn share-btn" onclick="share()">
                  <i class="fa fa-share-alt"></i>
                </button>
                <script>
                  function share() {
                    if (navigator.share) {
                      navigator.share({
                        title: '{{ trans_field($car->name) }} | Ameer Rental',
                        text: '{{ __('home.rent_with_crypto') }} - {{ trans_field($car->name) }}',
                        url: '{{ route('checkout', $car->slug) }}',
                      })
                      .then(() => console.log('Successful share'))
                      .catch((error) => console.log('Error sharing:', error));
                    } else {
                      console.log('Web Share API not supported');
                    }
                  }
                </script>
              </div>
            </div>
            <ul class="rc-car-features">
              <li class="car-spec-item">
                <div class="car-spec-icon">
                  <i class="fa fa-gears"></i>
                </div>
                <div class="car-spec-value">{{ $car->gear }}</div>
              </li>
              <li class="car-spec-item">
                <div class="car-spec-icon">
                  <i class="fa fa-users"></i>
                </div>
                <div class="car-spec-value">{{ $car->seats_available }}</div>
              </li>
              <li class="car-spec-item">
                <div class="car-spec-icon">
                  <i class="fa fa-suitcase"></i>
                </div>
                <div class="car-spec-value">{{ $car->number_of_bags }}</div>
              </li>
            </ul>
            <!-- Pricing Section -->
            <div class="price-section">
              <!-- Daily Price -->
              <div class="price-row">
                <div class="price-label">
                  <div class="price-icon">
                    <span class="" style="">AED</span>
                  </div>
                  <div class="price-value">
                    {{ $car->current_price_per_day }} <span class="price-unit">{{ getCurrencySymbol() }} / {{
                      __('home.day') }}</span>
                  </div>
                </div>
                <div class="mileage-value">
                  <i class="fa fa-road price-icon"></i>
                  <div class="price-value">
                    {{ $car->km_per_day }} <span class="price-unit">KM/{{ __('home.day') }}</span>
                  </div>
                </div>
                <div class="discount-price">
                  <span class="original-price">{{ $car->base_price_per_day }}</span> <span class="discount-tag">( {{
                    round( ( ($car->base_price_per_day - $car->current_price_per_day) / $car->base_price_per_day ) * 100 )
                    }}% OFF )</span>
                  {{-- <span class="float-end me-5 original-price">250 KM/DAY</span> --}}
                </div>
              </div>
              <!-- Weekly Price -->
              <div class="price-row">
                <div class="price-label">
                  <div class="price-icon">
                    
                    <span class="" style="">AED</span>
                  </div>
                  <div class="price-value">
                    {{ $car->current_price_per_week }} <span class="price-unit">{{ getCurrencySymbol() }} / {{
                      __('home.week') }}</span>
                  </div>
                </div>
                <div class="mileage-value">
                  <i class="fa fa-road price-icon"></i>
                  <div class="price-value">
                    {{ $car->km_per_week }} <span class="price-unit">KM/{{ __('home.week') }}</span>
                  </div>
                </div>
                <div class="discount-price">
                  <span class="original-price">{{ $car->base_price_per_week }}</span> <span class="discount-tag">( {{
                    round( ( ($car->base_price_per_week - $car->current_price_per_week) / $car->base_price_per_week ) *
                    100 ) }}% OFF )</span>
                  {{-- <span class="float-end me-5 original-price">1,750 KM/WEEK</span> --}}
                </div>
              </div>
              <!-- Monthly Price -->
              <div class="price-row">
                <div class="price-label">
                  <div class="price-icon">
                    
                    <span class="" style="">AED</span>
                  </div>
                  <div class="price-value">
                    {{ $car->current_price_per_month }} <span class="price-unit">{{ getCurrencySymbol() }} / {{
                      __('home.month') }}</span>
                  </div>
                </div>
                <div class="mileage-value">
                  <i class="fa fa-road price-icon"></i>
                  <div class="price-value">
                    {{ $car->km_per_month }} <span class="price-unit">KM/{{ __('home.month') }}</span>
                  </div>
                </div>
                <div class="discount-price">
                  <span class="original-price">{{ $car->base_price_per_month }}</span> <span class="discount-tag">( {{
                    round( ( ($car->base_price_per_month - $car->current_price_per_month) / $car->base_price_per_month ) *
                    100 ) }}% OFF )</span>
                  {{-- <span class="float-end me-5 original-price">4,000 KM/MONTH</span> --}}
                </div>
              </div>
              <!-- Hourly Rate -->
              <div class="price-row">
                <div class="price-label">
                  <div class="price-icon">
                    
                    <span class="" style="">AED</span>
                  </div>
                  <div class="price-value">
                    {{ $car->current_price_per_hour }} <span class="price-unit">{{ getCurrencySymbol() }}/{{
                      __('home.hour') }}</span>
                  </div>
                </div>
                <div class="mileage-value">
                  <i class="fa fa-road price-icon"></i>
                  <div class="price-value">
                    {{ $car->km_per_hour }} <span class="price-unit">{{ getCurrencySymbol() }}/{{ __('home.extra') }}
                      KM</span>
                  </div>
                </div>
              </div>
              <!-- Crypto Payment -->
              <div class="price-row">
                <div class="price-label">
                  <div class="price-icon">
                    <i class="fa fa-bitcoin"></i>
                  </div>
                  <div class="price-value">
                    {{ __('home.rent_with_crypto') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="total-amount">
              <span>Total:</span>
              <span>-AED</span>
            </div>
          </div>
          <div class="rc-car-details-description-area">
            <!-- Color Selection Section -->
            <div class="color-section">
              <!-- Exterior Color -->
              <div class="color-options">
                <i class="fa fa-car color-icon"></i>
                <div class="color-title">{{ __('home.exterior_color') }}</div>
                @foreach(json_decode($car->exterior_colors, true) ?? [] as $color)
                <div class="color-swatch" style="background-color: {{ $color }};"></div>
                @endforeach
              </div>
              <!-- Interior Color -->
              <div class="color-options">
                <i class="fa fa-paint-brush color-icon"></i>
                <div class="color-title">{{ __('home.interior_color') }}</div>
                @foreach(json_decode($car->interior_colors, true) ?? [] as $color)
                <div class="color-swatch" style="background-color: {{ $color }};"></div>
                @endforeach
              </div>
            </div>
            <!-- Not Included Section -->
            <div class="not-included-section">
              <div class="not-included-header">
                {{ __('home.not_included') }}
              </div>
              @php
              $generalPrices = get_general_prices();
              @endphp
              <div class="not-included-content">
                <div class="not-included-item">{{ __('home.tax_included') }} {{ $generalPrices->tax }} % </div>
                <div class="not-included-item">{{ __('home.dubai_date_crossing_fee') }}</div>
                <div class="not-included-item">{{ __('home.abu_dhabi_date_crossing_fee') }}</div>
              </div>
            </div>
            <div class="car-description-content">
              <p>{!! trans_field($car->short_description) !!}</p>
              <p>{!! trans_field($car->description) !!}</p>
            </div>
          </div>
        </div>
        <div class="book-now-button">
          <button class="rc-btn-theme"
            onclick="window.location.href='{{ route('checkout-form', $car->id) }}'">
            <i class="fa fa-calendar-check"></i>{{ __('home.book_now')}}
          </button>
        </div>
      </div>
    </div>
  </div>

</section>

@endsection

@push('script')
<script>
  function changeMainImage(thumbnail) {
    const mainImage = document.getElementById('mainCarImage');

    // Step 1: fade out
    mainImage.classList.add('fade-out');

    // Step 2: after transition, change src and fade back in
    mainImage.addEventListener('transitionend', function handler() {
      mainImage.src = thumbnail.src;
      mainImage.classList.remove('fade-out');
      mainImage.removeEventListener('transitionend', handler);
    });
  }
</script>

@endpush
