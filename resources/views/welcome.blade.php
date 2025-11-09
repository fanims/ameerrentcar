@extends('frontend.layout.layout')

@section('meta_title')
Ameer RAC
@endsection
@section('content')
<style>
    .slider-container {
        position: relative;
        width: 100%;
        max-height: 90vh;
        overflow: hidden;
    }

    #rental_fleet_pagination {
        display: flex;
        flex-wrap: nowrap;
        overflow: auto;
        max-width: 100%;
    }

    .testimonial-rating i {
        font-size: 16px;
        margin-right: 2px;
    }

    .slider-wrapper {
        display: flex;
        transition: transform 0.5s ease-in-out;
        /* width: 300%; */
        /* 3 slides */
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }

    .slider-controls {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }

    .slider-controls button {
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        font-size: 18px;
    }

    .slider-indicators {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
    }

    .slider-indicators span {
        display: inline-block;
        width: 12px;
        height: 12px;
        background-color: #aaa;
        border-radius: 50%;
        cursor: pointer;
    }

    .slider-indicators .active {
        background-color: #333;
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
@php
$sliders = \App\Models\Slider::where('status', 1)->get();
@endphp
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
    <!-- brands section -->
    <section class="page-section rc-brands dark">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rc-section-title rc-section-title_left" data-wow-offset="70" data-wow-delay="100ms">
                        <div class="rc-section-title-content">
                            <span>{{ __('home.select_what_you_want') }}</span>
                            <h2>{{ __('home.select_your_brand') }}</h2>
                        </div>
                        <p>{{ __('home.select_your_brand_desc') }}</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="swiper brandsSlider">
                        <div class="swiper-wrapper">
                            @foreach($brands as $key => $brand)
                                <div class="swiper-slide">
                                    <a href="{{ route('vehicle', ['id' => $brand->id, 'name' => Str::slug($brand->name_en)]) }}"
                                    class="">
                                        <img loading="lazy" src="{{ $brand->image }}"
                                        alt="{{ app()->getLocale() == 'en' ? $brand->name_en : $brand->name_ar  }}"
                                        class="img-fluid" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Navigation buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- brands section -->

    <!-- car items -->
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
                            <li class="{{ $key + 1 == 1 ? 'active' : '' }}">
                                <a class="{{ $key + 1 == 1 ? 'active' : '' }}" href="#tab-{{ $key + 1 }}"
                                    data-toggle="tab">{{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name_en }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Best Offers (default active) -->
                        <div class="tab-pane fade active in" id="tab-1">
                            <div class="row g-4">
                                @foreach($cars as $key => $car)
                                    @if($car->car_type == 'Best Offer' && $key < 9) 
                                        <div class="col-md-4 col-lg-3 dark">
                                            @component('components.car',[
                                            'car' => $car
                                            ])
                                            @endcomponent
                                        </div>
                                    @endif
                                @endforeach
                            </div>
            
                            <!-- View All Button -->
                            <div class="col-12 rc-view-all-btn">
                                <a href="{{ route('vahicles') }}" class="rc-btn-theme">{{
                                    __('home.view_all')
                                    }}</a>
                            </div>
                        </div>
            
                        <!-- Popular Cars -->
                        <div class="tab-pane fade" id="tab-2">
                            <div class="row g-4">
                                @foreach($cars as $key => $car)
                                    @if($car->car_type == 'Popular' && $key < 9) 
                                    <div class="col-md-4 col-lg-3 dark">
                                        @component('components.car',[
                                        'car' => $car
                                        ])
                                        @endcomponent
                                    </div>
                                    @endif
                                @endforeach
                            </div>
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
                                    @if($car->car_type == 'New' && $key < 9) 
                                        <div class="col-md-4 col-lg-3 dark">
                
                                            @component('components.car',[
                                            'car' => $car
                                            ])
                                            @endcomponent
                                        </div>
                                    @endif
                                @endforeach
                            </div>
        
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
    <!-- car items -->

<!-- support section -->


@component('components.whyChoseUs')
@endcomponent
<!-- /support section -->

<!-- Who we are -->

@component('components.whoWeAre',[
'from' => 'home'
])
@endcomponent
<!-- /Who we are -->

<!-- Rental Fleet cars -->
<section class="page-section rc-rental-fleet">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rc-section-title">
                    <div class="rc-section-title-content">
                        <span>{{ __('home.our_fleet_car_tagline') }}</span>
                        <h2>{{ __('home.our_fleet_car') }}</h2>
                        <p>{{ __('home.our_fleet_car_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rc-tabs tabs" dir="ltr" data-wow-offset="70" data-wow-delay="500ms">
            <ul id="tabs1" class="rc-tabs-list nav">
                @foreach($categories as $index => $category)
                <li class="{{ $index === 1 ? 'active' : '' }}">
                    <a href="#tab-x{{ $index+1 }}" data-toggle="tab">{{ $category->getTranslatedName(30) }}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            @foreach($categories as $catIndex => $category)
            <div class="tab-pane fade {{ $catIndex === 1 ? 'active in' : '' }}" id="tab-x{{ $catIndex+1 }}">
                <div class="car-big-card">
                    <div class="rc-car-card-content">
                        <div class="rc-tabs-vtwo tabs awesome-sub">
                            <ul id="tabs{{ $catIndex+1 }}" class="rc-tabs-list-vtwo nav">
                                @foreach($category->cars->take(5) as $carIndex => $car)
                                <li class="{{ $carIndex === 1 ? 'active' : '' }}">
                                    <a href="#tab-x{{ $catIndex+1 }}x{{ $carIndex+1 }}" data-toggle="tab">{{
                                        trans_field($car->name) }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @foreach($category->cars->take(5) as $carIndex => $car)
                                <div class="tab-pane fade {{ $carIndex+1 === 1 ? 'active in' : '' }}"
                                    id="tab-x{{ $catIndex+1 }}x{{ $carIndex+1 }}">
                                    <div class="rc-inner-tab-content">
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
                                <div class="car-details">
                                    <div class="price">
                                        <span>{{ $car->base_price_per_hour }} .AED/per a day</span>
                                        <span class="brand">Brand: {{ $car->brand ? (app()->getLocale() == 'en' ? $car->brand->name_en : $car->brand->name_ar) : '' }} with manufacturing Year {{ $car->model_year }}</span>
                                        <span class="fuel">Fuel: {{ $car->fuel }} / Engine: {{ $car->engine }}</span>
                                    </div>
                                    <div class="list">
                                        <ul>
                                            <li>
                                                <span>Bags</span> 
                                                <em>{{ $car->number_of_bags }}</em>
                                            </li>
                                            <li>
                                                <span>Seats</span> 
                                                <em>{{ $car->persons_can_sit }}</em>
                                            </li>
                                            <li>
                                                <span>Seats Available</span> 
                                                <em>{{ $car->seats_available }}</em>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li>
                                                <span>Gear</span> 
                                                <em>{{ $car->gear }}</em>
                                            </li>
                                            <li>
                                                <span>Service</span> 
                                                <em>{{ $car->service_included ? '2 Year Service Included' : 'No' }}</em>
                                            </li>
                                            <li>
                                                <span>Seats Available</span> 
                                                <em>{{ $car->doors }} Doors and Panorama View</em>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="button">
                                        <a href="{{ route('checkout', $car->slug) }}" class="rc-btn-theme">Reservation Now</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Rental Fleet cars -->


@component('components.requirements',[
'from' => 'home',
])

@endcomponent
<!-- /requirement section -->

<!-- testimonals -->
<section class="page-section testimonials" dir='ltr'>
    <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
        <div class="testimonials-carousel">
            <div class="owl-carousel" id="testimonials">
                @forelse($reviews as $review)
                <div class="testimonial">
                    <div class="media">
                        <div class="media-left">
                            <div class="media-left">
                                <a href="#">
                                    @if(!empty($review['profile_photo_url']))
                                    <img loading="lazy" class="media-object testimonial-avatar"
                                        src="{{ $review['profile_photo_url'] }}" alt="{{ $review['author_name'] }}" />
                                    @else
                                    <div class="media-object testimonial-avatar avatar-fallback">
                                        {{ strtoupper(substr($review['author_name'], 0, 1)) }}
                                    </div>
                                    @endif
                                </a>
                            </div>

                        </div>
                        <div class="media-body">
                            <div class="testimonial-text">
                                {{ $review['text'] }}
                            </div>
                            <div class="testimonial-name">
                                {{ $review['author_name'] }}
                                <div class="testimonial-rating">
                                    @php
                                    $rating = round($review['rating']);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating) <i
                                        class="bi bi-star-fill text-warning"></i>
                                        @else
                                        <i class="bi bi-star"></i>
                                        @endif
                                        @endfor
                                        <small class="text-light">— {{ $review['relative_time_description'] }}</small>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">No reviews found.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- /testimonals -->

<!-- happy customers -->
<section class="page-section image dark" hidden>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-heart"></i></div>
                        <div class="caption-number">5657</div>
                        <h4 class="caption-title">Happy costumers</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-car"></i></div>
                        <div class="caption-number">657</div>
                        <h4 class="caption-title">Total car count</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-flag"></i></div>
                        <div class="caption-number">1.255.657</div>
                        <h4 class="caption-title">Total KM/MIL</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon">
                            <i class="fa fa-comments-o"></i>
                        </div>
                        <div class="caption-number">1255</div>
                        <h4 class="caption-title">Call Center Solutions</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /happy customers -->

<!-- Instagram Section -->
<section class="page-section rc-instagram">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rc-section-title">
                    <div class="rc-section-title-content">
                        <span>{{ __('home.instagram_section_tagline') }}</span>
                        <h2>{{ __('home.instagram_section') }}</h2>
                        <p>{{ __('home.instagram_section_desc') }}</p>
                    </div>
                    <div class="rc-instagram-profile">
                        <img loading="lazy" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Instagram Logo" />
                        <h3 class="insta">
                            @ameerluxury
                        </h3>
                    </div>
                    <a href="#" class="rc-btn-theme">{{ __('home.follow_us') }}</a>
                </div>
            </div>
            <div class="col-12">
                <div class="rc-gallery">
                    <img loading="lazy" src="./assets/img/insta/gallery-img-1.png" alt="Post" />
                    <img loading="lazy" src="./assets/img/insta/gallery-img-2.png" alt="Post" />
                    <img loading="lazy" src="./assets/img/insta/gallery-img-3.png" alt="Post" />
                </div>
                <div class="rc-gallery-two">
                    <img loading="lazy" src="./assets/img/insta/gallery-img-4.png" alt="Post" />
                    <img loading="lazy" src="./assets/img/insta/gallery-img-5.png" alt="Post" />
                    <img loading="lazy" src="./assets/img/insta/gallery-img-6.png" alt="Post" />
                    <img loading="lazy" src="./assets/img/insta/gallery-img-7.png" alt="Post" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQs -->
@component('components.faqs')

@endcomponent
<!-- /FAQs -->

<!-- google api -->
<section class="page-section rc-map-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="rc-faqs-titleside">
                    <div class="rc-section-title rc-section-title_left">
                        <div class="rc-section-title-content">
                            <span>{{ __('home.faqs') }}</span>
                            <h2>{{ __('home.see_people_ask_about_us') }}</h2>
                            <p>{{ __('home.faqs_desc') }}</p>
                        </div>
                    </div>
                    <div class="card car-item">
                        <!-- Image -->
                        <div class="position-relative image-hover-wrapper">
                            <a href="{{ route('checkout', $car->slug) }}">
                                <img loading="lazy" src="{{ asset('storage/' . $car->thumbnail_image) }}" class="card-img-top"
                                    alt="{{ trans_field($car->name) }}" />
                        
                                <!-- Overlay -->
                                <div class="image-overlay"></div>
                        
                                <!-- Details Button -->
                                <span"
                                    class="btn btn-theme btn-theme-transparent item-btn details-btn">
                                    {{ __('home.details') }}
                                </span>
                            </a>
                        </div>
                        <div class="card-body custom-card-body">
                            <div class="custom-card-body-heading">
                                <div class="custom-card-body-heading-title">
                                    <!-- Category -->
                                    <span class="item-manufacturer">
                                        {{ $car->category->name[App::getLocale()] ?? $car->category->name['en'] ?? '' }}
                                    </span>
                                    <!-- Title -->
                                    <h5 class="item-model">
                                        {{ trans_field($car->name) }} - {{ $car->model_year }}
                                    </h5>
                                </div>
                                <!-- Buttons -->
                                <div class="item-buttons">
                                    <a href="#" class="rc-btn-theme">Rent it</a>
                                </div>
                            </div>

                            <!-- Price Section -->
                            <div class="item-prices">
                                @if ($car->base_price_per_month != $car->current_price_per_month)
                                    <div class="item-price">
                                        <div class="text-muted text-decoration-line-through small">
                                            {{ getCurrencySymbol() }} {{ $car->base_price_per_month }}
                                        </div>
                                    </div>
                                @endif
                                <div class="item-price">
                                    <span class="duration">{{ __('home.monthly') }}</span>
                                </div>
                                @if ($car->base_price_per_week != $car->current_price_per_week)
                                    <div class="item-price">
                                        <div class="text-muted text-decoration-line-through small">
                                            {{ getCurrencySymbol() }} {{ $car->base_price_per_week }}
                                        </div>
                                    </div>
                                @endif
                                <div class="item-price">
                                    <span class="duration">{{ __('home.weekly') }}</span>
                                </div>
                                @if ($car->base_price_per_day != $car->current_price_per_day)
                                    <div class="item-price">
                                        <div class="text-muted text-decoration-line-through small">
                                            {{ getCurrencySymbol() }} {{ $car->base_price_per_day }}
                                        </div>
                                    </div>
                                @endif
                                <div class="item-price">
                                    <span class="duration">{{ __('home.daily') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Google map -->
                <div class="google-map">
                    <div id="map-canvas"></div>
                </div>
                <!-- /Google map -->
            </div>
        </div>
    </div>
    {{-- <div id="map" style="height: 400px; width: 100%;"></div> --}}

</section>
<!-- / google api  -->

<!-- Subscrıbe -->
<section class="page-section rc-subscribe" dir="ltr">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rc-section-title">
                    <div class="rc-section-title-content">
                        <span>{{ __('home.you_can_follow') }}</span>
                        <h2>{{ __('home.subscribe') }}</h2>
                        <p>{{ __('home.subscribe_desc') }}</p>
                    </div>
                </div>
                <!-- Subscribe form -->
                <form action="{{ route('subscribe') }}" method="POST" class="form-subscribe">
                    @csrf
                    <div class="form-group">
                        <label for="formSubscribeEmail" class="sr-only"> {{ __('home.enter_email') }}</label>
                        <input type="email" name="email" class="form-control" id="formSubscribeEmail"
                            placeholder=" {{ __('home.enter_email') }}" required />
                    </div>
                    <button type="submit" class="rc-btn-theme">
                        {{__('home.subscribe_btn') }}
                    </button>
                </form>
                <!-- Subscribe form -->
            </div>
        </div>
    </div>
</section>
<!-- /Subscrıbe -->

</div>
@endsection

@push('script')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


<!-- <script>
    let currentSlide = 0;
    const totalSlides = @json(count($sliders));
    const sliderWrapper = document.getElementById('sliderWrapper');
    const indicators = document.querySelectorAll('#sliderIndicators span');

    function updateSlider() {
        sliderWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
        indicators.forEach((el, i) => el.classList.toggle('active', i === currentSlide));
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlider();
    }

    // Optional: autoplay every 5 seconds
    // setInterval(nextSlide, 5000);
</script> -->
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
<script>
    var swiper = new Swiper(".bannerSlider", {
        loop: true,                // Infinite loop
        autoplay: {                // Auto play
        delay: 3000,
        disableOnInteraction: false,
        },
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
    });

    var swiper = new Swiper(".brandsSlider", {
        slidesPerView: 6,
        spaceBetween: 30,
        loop: true,                // Infinite loop
        autoplay: {                // Auto play
        delay: 3000,
        disableOnInteraction: false,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
    });

    var swiper = new Swiper(".fleetSlider", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".fleetSlider2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
</script>
@endpush