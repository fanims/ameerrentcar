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
                    <button type="button" class="rc-btn-theme btn-back" data-dismiss="modal" aria-label="Close" onclick="window.location.href='{{ route('checkout', $car->slug) }}'">
                        <i class="fa fa-chevron-left icon-left"></i>Back
                    </button>
                </div>
                <div class="rc-add-to-cart-cars-content-wrap">
                    <div class="rc-add-to-cart-content">
                        <form>
                            <div class="form-group">
                                <input type="checkbox" id="html">
                                <label for="html">
                                    <div class="rc-add-to-cart-cars-details">
                                        <figure>
                                            <img src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="Car Image">
                                        </figure>
                                        <div class="rc-add-to-cart-cars-info">
                                            <span>{{ trans_field($car->name) }}</span>
                                            <span>Modal: {{ $car->model_year }}</span>
                                            <span>Category: {{ $car->category->name[App::getLocale()] ?? $car->category->name['en'] ?? 'N/A' }}</span>
                                        </div>
                                        <button class="rc-btn-theme">View Details</button>
                                    </div>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="css">
                                <label for="css">
                                    <div class="rc-add-to-cart-cars-details">
                                        <figure>
                                            <img src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="Car Image">
                                        </figure>
                                        <div class="rc-add-to-cart-cars-info">
                                            <span>{{ trans_field($car->name) }}</span>
                                            <span>Modal: {{ $car->model_year }}</span>
                                            <span>Category: {{ $car->category->name[App::getLocale()] ?? $car->category->name['en'] ?? 'N/A' }}</span>
                                        </div>
                                        <button class="rc-btn-theme">View Details</button>
                                    </div>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="javascript">
                                <label for="javascript">
                                    <div class="rc-add-to-cart-cars-details">
                                        <figure>
                                            <img src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="Car Image">
                                        </figure>
                                        <div class="rc-add-to-cart-cars-info">
                                            <span>{{ trans_field($car->name) }}</span>
                                            <span>Modal: {{ $car->model_year }}</span>
                                            <span>Category: {{ $car->category->name[App::getLocale()] ?? $car->category->name['en'] ?? 'N/A' }}</span>
                                        </div>
                                        <button class="rc-btn-theme">View Details</button>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="rc-add-to-cart-order-summary">
                        <h3>Order Summary</h3>
                        <div class="rc-add-to-cart-cars-details">
                            <figure>
                                <img src="{{ asset('storage/'. $car->thumbnail_image) }}" alt="Car Image">
                            </figure>
                            <div class="rc-add-to-cart-cars-info">
                                <span>{{ trans_field($car->name) }}</span>
                                <span>Modal: {{ $car->model_year }}</span>
                                <span>Category: {{ $car->category->name[App::getLocale()] ?? $car->category->name['en'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="rc-add-to-cart-order-info">
                            <ul>
                                <li>
                                    <span>Brand</span>
                                    :
                                    <span>Null</span>
                                </li>
                                <li>
                                    <span>Booking From  </span>
                                    :
                                    <span>22 Sep 2025 , 12:00 pM</span>
                                </li>
                                <li>
                                    <span>Booking To</span>
                                    :
                                    <span>22 Sep 2025 , 02:00 pM</span>
                                </li>
                                <li>
                                    <span>Car Booking Price</span>
                                    :
                                    <span>AED 7623.00</span>
                                </li>
                                <li>
                                    <span>Sub Total (Without tax)</span>
                                    :
                                    <span>AED 7623.00</span>
                                </li>
                                <li>
                                    <span>Tax (2.00%)</span>
                                    :
                                    <span>AED 152.46</span>
                                </li>
                                <li>
                                    <span>Total</span>
                                    <span>AED 7765.00</span>
                                </li>
                            </ul>
                        </div>
                        <button class="rc-btn-theme">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/img/bg-shape-2.png') }}" alt="Shape" class="rc-bg-shape">
</section>