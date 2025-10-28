@extends('frontend.layout.layout')
@section('meta_title')
    Ameer RAC | Faq
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

    <!-- support section -->
      @component('components.whyChoseUs',[
         'from' => 'faq'
      ])
       
     @endcomponent
    <!-- /support section -->

    <!-- FAQs -->
      @component('components.faqs')
        
      @endcomponent
    <!-- /FAQs -->

    <!-- happy customers -->
      {{-- @component('components.happyCustomers')
        
      @endcomponent --}}
    <!-- /happy customers -->


    </div>
    <!-- /CONTENT AREA -->
@endsection