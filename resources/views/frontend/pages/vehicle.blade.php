@extends('frontend.layout.layout')

@section('meta_title')
Ameer RAC | Vehicle
@endsection

@section('style')
<style>
  .page-section {
    overflow: visible;
  }

  .thumbnail .media-link {
    overflow: visible;
    z-index: 0;
  }

  .thumbnail.thumbnail-featured .caption.hovered {
    opacity: 1;
    z-index: 0;
    background-color: #ce933c;
  }

  .image-hover-wrapper {
    position: relative;
    overflow: hidden;
  }

  .image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    /* semi-transparent dark overlay */
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
  }

  .details-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: inline-block;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
    text-decoration: none;
  }

  .image-hover-wrapper:hover .image-overlay {
    opacity: 1;
  }

  .image-hover-wrapper:hover .details-btn {
    opacity: 1;
  }
</style>
@endsection

@section('content')
<!-- CONTENT AREA -->
<div class="content-area">
  <!-- banner section -->
  <section class="page-section rc-banner">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="rc-banner-content">
                      <span>{{ __('home.welcome_tagline') }}</span>
                      <h1>{{ __('home.welcome_title') }}</h1>
                      <p>{{ __('home.welcome_desc') }}</p>
                  </div>
                  <div class="swiper bannerSlider">
                      <div class="swiper-wrapper">
                          <div class="swiper-slide">
                              <img loading="lazy" src="{{ asset('storage/sliders/Uw4Ed2Pd3D0hMWxhhhVAJJFMinucLfVRXVYXKdIC.png') }}" class="rc-banner-image" alt="banner image">
                          </div>
                          <div class="swiper-slide">
                              <img loading="lazy" src="{{ asset('storage/sliders/banner-img-1.png') }}" class="rc-banner-image" alt="banner image">
                          </div>
                          <div class="swiper-slide">
                              <img loading="lazy" src="{{ asset('storage/sliders/banner-img-2.png') }}" class="rc-banner-image" alt="banner image">
                          </div>
                          <div class="swiper-slide">
                              <img loading="lazy" src="{{ asset('storage/sliders/banner-img-3.png') }}" class="rc-banner-image" alt="banner image">
                          </div>
                      </div>
                      <!-- Navigation buttons -->
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                      <!-- Pagination dots -->
                      <div class="swiper-pagination"></div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- banner section -->
  @php
  use App\Models\WebsiteSetting;
  $setting = WebsiteSetting::first();
  @endphp
  <!-- Filter Section -->
  <section class="page-section rc-cars">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="rc-section-title">
                      <div class="rc-section-title-content">
                          <span>{{ __('home.greate_rental_tag') }}</span>
                          <h2>{{ __('home.greate_rental_offer') }}</h2>
                          <p>{{ __('home.greate_rental_offer_desc') }}</p>
                      </div>
                  </div>
              </div>
              <div class="col-12" dir="ltr">
                  <!-- Tabs Navigation -->
                  <div class="rc-tabs tabs wow fadeInUp" data-wow-offset="70" data-wow-delay="300ms">
                      <ul id="tabs" class="nav rc-tabs-list">
                          @foreach($car_types as $key => $type)
                          <li class="{{ $key + 1 == 2 ? 'active' : '' }}">
                              <a class="{{ $key + 1 == 2 ? 'active' : '' }}" href="#tab-{{ $key + 1 }}"
                                  data-toggle="tab">{{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}</a>
                          </li>
                          @endforeach
                      </ul>
                  </div>
                  <!-- Tab Content -->
                  <div class="tab-content">
                      <!-- Best Offers -->
                      <div class="tab-pane fade" id="tab-1">
                          <div class="row g-4">
                              @foreach($cars as $key => $car)
                              @if($car->car_type == 'Popular' && $key < 9) <div class="col-md-4 col-lg-3 dark">
                                  @component('components.car',[
                                  'car' => $car
                                  ])
                                  @endcomponent
                          </div>
                          @endif
                          @endforeach
          
                          <!-- View All Button -->
                          <div class="col-12 rc-view-all-btn">
                              <a href="{{ route('vahicles') }}" class="rc-btn-theme">{{
                                  __('home.view_all')
                                  }}</a>
                          </div>
                      </div>
          
                      <!-- Popular Cars (default active) -->
                      <div class="tab-pane fade active in" id="tab-2">
                          <div class="row g-4">
                              @foreach($cars as $key => $car)
                              @if($car->car_type == 'Best Offer' && $key < 9) <div class="col-md-4 col-lg-3 dark">
                                  @component('components.car',[
                                  'car' => $car
                                  ])
                                  @endcomponent
                          </div>
                          @endif
                          @endforeach
                          <!-- View All Button -->
                          <div class="col-12 rc-view-all-btn">
                              <a href="{{ route('vahicles') }}" class="rc-btn-theme">{{
                                  __('home.view_all')
                                  }}</a>
                          </div>
                      </div>
                      
                      <!-- Economic Cars -->
                      <div class="tab-pane fade" id="tab-3">
                          <div class="row g-4">
                              @foreach($cars as $key => $car)
                              @if($car->car_type == 'New' && $key < 9) <div class="col-md-4 col-lg-3 dark">
      
                                  @component('components.car',[
                                  'car' => $car
                                  ])
                                  @endcomponent
                          </div>
                          @endif
                          @endforeach
      
                          <!-- View All Button -->
                          <div class="col-12 rc-view-all-btn">
                              <a href="{{ route('vahicles') }}" class="rc-btn-theme">{{
                                  __('home.view_all')
                                  }}</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- /Filter Section -->

  <!-- brands section -->


  <!-- support section -->
  @component('components.whyChoseUs',[
  'from' => 'vehicle'
  ])
  @endcomponent
  <!-- /support section -->


  <!-- requirement section -->
  @component('components.requirements',[
  'from' => 'vehicle',
  ])
  @endcomponent
  <!-- /requirement section -->


</div>
<!-- /CONTENT AREA -->
@endsection


@push('script')

<script>
  window.currentLocale = "{{ app()->getLocale() }}";
    const locale = window.currentLocale || 'en'; // fallback to 'en' if not defined

</script>
<script>
  const categories = @json($categories); // Array of 12 numbers

  $(document).ready(function() {
      // Initialize selected filters object
      let selectedFilters = {
        brand: null,
        car_type: null,
        price: null,
        year: null,
        category: null,
        range: null
      };

      // Set up event listeners for all dropdowns
      $('.custom-dropdown').each(function() {
        const dropdown = $(this);
        const header = dropdown.find('.dropdown-header span').text().trim().toLowerCase().replace(' ', '_');
        
        dropdown.on('click', 'li', function() {
          const value = $(this).text().trim();
          
          // Update the selected filters
          if (header === 'car_brand') {
            selectedFilters.brand = value;
          } else if (header === 'car_type') {
            selectedFilters.car_type = value;
          } else if (header === 'car_price') {
            selectedFilters.price = value;
          } else if (header === 'car_year') {
            selectedFilters.year = value;
          } else if (header === 'category') {
            selectedFilters.category = value;
          } else if (header === 'car_range') {
            selectedFilters.range = value;
          }
          
          // Update UI to show selected filter
          dropdown.find('.dropdown-header span').text(value);
          
          // Trigger search
          performSearch();
        });
      });

          // Clear filter button functionality
    $('#clear-filters').on('click', function () {
      // Reset selectedFilters object
      selectedFilters = {
        brand: null,
        car_type: null,
        price: null,
        year: null,
        category: null,
        range: null
      };

      // Reset dropdown headers to original labels
      $('.custom-dropdown').each(function () {
        const dropdown = $(this);
        const originalLabel = dropdown.find('.dropdown-header').data('original');
        dropdown.find('.dropdown-header span').text(originalLabel);
      });

      // Trigger search with cleared filters
      performSearch();
    });

      // Function to perform the search
      function performSearch() {
        $.ajax({
          url: '{{ route("search") }}',
          method: 'GET',
          data: selectedFilters,
          success: function(response) {
            // Update the car listings
            updateCarListings(response);
          },
          error: function(xhr) {
            console.error('Search error:', xhr.responseText);
          }
        });
      }

      // Function to update car listings
    function updateCarListings(cars) {
  const container = $('.car-list'); // Assuming your car listings are in a row
  container.empty();

  if (!cars || cars.length === 0) {
    container.html('<div class="col-12 text-center py-5"><h4>No cars found matching your criteria</h4></div>');
    return;
  }

  cars.forEach(function (car) {
    const category = categories.find(cat => cat.id === car.category_id)?.name?.[locale] || '';

    // Check for line-through visibility
    const monthlyBase = car.base_price_per_month !== car.current_price_per_month 
        ? `<div class="text-muted text-decoration-line-through small">AED ${car.base_price_per_month}</div>` 
        : '';
    const weeklyBase = car.base_price_per_week !== car.current_price_per_week 
        ? `<div class="text-muted text-decoration-line-through small">AED ${car.base_price_per_week}</div>` 
        : '';
    const dailyBase = car.base_price_per_day !== car.current_price_per_day 
        ? `<div class="text-muted text-decoration-line-through small">AED ${car.base_price_per_day}</div>` 
        : '';

    const carHtml = `
      <div class="col-md-4 col-lg-3 dark">
        <div class="card shadow-sm rounded-3 overflow-hidden position-relative h-100 car-item">
          <div class="position-absolute top-0 start-0 m-2 d-flex gap-2">
            <span class="badge rounded-pill bg-white text-dark px-3 py-1 shadow-sm">🔥</span>
            <span class="badge rounded-pill bg-gray px-3 py-1 shadow-sm">${car.car_type}</span>
          </div>
          
          <div class="position-relative image-hover-wrapper">
            <img src="/storage/${car.thumbnail_image}" class="card-img-top" alt="${car.name[locale]}" onclick="window.location.href='/checkout/${car.slug}';" />
            <div class="image-overlay"></div>
            <a href="/checkout-form/${car.id}" class="btn btn-theme btn-theme-transparent item-btn details-btn">
              Details
            </a>
          </div>
          
          <div class="card-body custom-card-body">
            <span class="text-dark small mb-2 item-manufacturer">${category}</span>
            <h5 class="fw-semibold text-dark mb-3 item-model">${car.name[locale]} - ${car.model_year}</h5>
            
            <div class="d-flex text-center overflow-hidden mb-3 item-prices">
              <div class="flex-fill py-2 px-2">
                ${monthlyBase}
                <div class="fw-bold text-dark">AED ${car.current_price_per_month}</div>
                <div class="text-muted small">Monthly</div>
              </div>
              <div class="vr my-2"></div>
              <div class="flex-fill py-2 px-2">
                ${weeklyBase}
                <div class="fw-bold text-dark">AED ${car.current_price_per_week}</div>
                <div class="text-muted small">Weekly</div>
              </div>
              <div class="vr my-2"></div>
              <div class="flex-fill py-2 px-2">
                ${dailyBase}
                <div class="fw-bold text-dark">AED ${car.current_price_per_day}</div>
                <div class="text-muted small">Daily</div>
              </div>
            </div>

            <div class="d-flex gap-2 item-buttons">
              <a href="/checkout/${car.slug}" class="btn btn-theme btn-theme-transparent item-btn">Book Now</a>
              <a href="https://wa.me/{{ $setting->phone }}" class="btn btn-theme btn-theme-transparent item-btn">WhatsApp</a>
              <a href="tel:{{ $setting->phone }}" class="btn btn-theme btn-theme-transparent item-btn">Call</a>
            </div>
          </div>
        </div>
      </div>
    `;

    container.append(carHtml);
  });
}

    });

</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const allCars = document.querySelectorAll('.car-list .dark');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    let visibleCount = 1; // Initial visible count
    const increment = 1;  // Load this many on each click

    loadMoreBtn.addEventListener('click', function (e) {
      e.preventDefault();
      let count = 0;
      for (let i = 0; i < allCars.length; i++) {
        if (allCars[i].style.display === "none" && count < increment) {
          allCars[i].style.display = "block";
          count++;
        }
      }

      // Hide button if no more cars to show
      const hiddenLeft = Array.from(allCars).filter(el => el.style.display === 'none');
      if (hiddenLeft.length === 0) {
        loadMoreBtn.style.display = 'none';
      }
    });

    // Hide button if all cars already visible
    const initiallyHidden = Array.from(allCars).filter(el => el.style.display === 'none');
    if (initiallyHidden.length === 0) {
      loadMoreBtn.style.display = 'none';
    }
  });
</script>


@endpush