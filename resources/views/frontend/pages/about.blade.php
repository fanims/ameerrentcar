@extends('frontend.layout.layout')

@section('meta_title')
Ameer RAC | About Us
@endsection

@section('style')
<style>
  .journey-section {
    text-align: center;
  }

  .timeline {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
  }

  .timeline::after {
    content: '';
    position: absolute;
    width: 6px;
    background-color: #8B4513;
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -3px;
  }

  .timeline-item {
    padding: 10px 40px;
    position: relative;
    background-color: #000002;
    border: 1px solid #ce933c;
    border-radius: 5px;
    margin-bottom: 20px;
    width: 45%;
  }

  .timeline-item:nth-child(odd) {
    left: 0;
    margin-left: 0;
    margin-right: 55%;
  }

  .timeline-item:nth-child(even) {
    left: 55%;
    margin-left: 0;
  }

  .timeline-item::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: #8B4513;
    border: 4px solid #fff;
    top: 15px;
    border-radius: 50%;
    z-index: 1;
  }

  .timeline-item:nth-child(odd)::after {
    right: -13px;
  }

  .timeline-item:nth-child(even)::after {
    left: -13px;
  }

  .timeline-item h4 {
    color: #000002;
    font-size: 20px;
    margin-bottom: 10px;
    text-transform: uppercase;
    background-color: #D2B48C;
    padding: 10px;
    display: inline-block;
    font-weight: bold;
  }

  .timeline-item p {
    color: #ce933c;
    font-size: 15px;
    margin-bottom: 5px;
  }

  .timeline-item span {
    color: #8B4513;
    font-size: 0.9rem;
  }
  .new_line{
    height: 2px;
    background-color: #ce933c;
  }
  h3{
    font-size: 24px !important;
  }

  /* Our Story Section Styles */
  .our-story-section {
    background-color: #000000;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
  }

  .our-story-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
    pointer-events: none;
  }

  .our-story-content {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 2;
  }

  .our-story-subtitle {
    color: #ffffff;
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 15px;
    letter-spacing: 1px;
  }

  .our-story-title {
    color: #ffffff;
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 30px;
    line-height: 1.2;
  }

  .our-story-description {
    color: #ffffff;
    font-size: 18px;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
  }

  .story-timeline {
    position: relative;
    margin: 0 auto;
    z-index: 2;
  }

  .story-car-image {
    text-align: center;
    margin: 60px 0;
  }

  .story-car-image img {
    max-width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  }

  .story-milestones {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 40px;
  }

  .milestone-box {
    gap: 18px;
    padding: 15px;
    display: flex;
    max-width: 424px;
    position: relative;
    border-radius: 15px;
    align-items: flex-start;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    background: rgba(0, 0, 0, 1);
    border: 1px solid rgba(101, 99, 99, 1);
  }

  .milestone-box.milestone-box-1 {
    margin-left: auto;
  }

  .milestone-box.milestone-box-2 {
    margin-top: 30px;
  }
  
  .milestone-box.milestone-box-4 {
    margin-top: 30px;
    margin-left: auto;
  }

  .milestone-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(212, 175, 55, 0.2);
  }

  .milestone-icon {
    flex:none;
    width: 60px;
    height: 60px;
    display: flex;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    background: linear-gradient(140.97deg, #131313 23.76%, #1F1D1D 61.91%, #2A2828 74.58%, #262525 85.17%);
  }

  .milestone-title {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 7px;
    color: var(--text-color);
    text-transform: uppercase;
  }

  .milestone-description {
    font-size: 18px;
    margin-bottom: 12px;
    color: rgba(101, 98, 99, 1);
  }

  .milestone-date {
    font-size: 18px;
    font-weight: 400;
    text-align: center;
    color: rgba(101, 98, 99, 1);
  }

  @keyframes pulse {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.1);
    }
    100% {
      transform: scale(1);
    }
  }

  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(-50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .story-car-image {
    animation: fadeInUp 1s ease-out 0.5s both;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .our-story-title {
      font-size: 36px;
    }
    
    .story-milestones {
      grid-template-columns: 1fr;
      gap: 20px;
    }
    
    .milestone-box {
      padding: 20px;
    }
    
    .our-story-section {
      padding: 60px 0;
    }
  }

  @media (max-width: 576px) {
    .our-story-title {
      font-size: 28px;
    }
    
    .our-story-description {
      font-size: 16px;
    }
    
    .milestone-title {
      font-size: 16px;
    }
    
    .milestone-description {
      font-size: 14px;
    }
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

  <!-- Who we are -->
  @component('components.whoWeAre', [
  'from' => 'about'
  ])
  @endcomponent
  <!-- /Who we are -->


  <div class="page-section rc-our-mission">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
            <div class="rc-our-mission-left">
              <div class="rc-mission-card first-card">
                <div class="rc-our-mission-card">
                  <h3>Luxury Car Rentals</h3>
                  <p>
                    Experience the thrill of driving the world’s top car brands. 
                    Our fleet includes models from Mercedes, BMW, sports cars, 
                    and more. Available for daily, weekly, and monthly rentals.
                  </p>
                </div>
                <img src="{{ asset('assets/img/about-card-shape.png') }}" alt="shape" class="about-card-shape">
              </div>
              <div class="rc-mission-card second-card">
                <div class="rc-our-mission-card">
                  <h3>Desert Safari Adventures</h3>
                  <p>
                    Looking for desert excitement? Join us for guided Safari 
                    tours through the golden sands of the UAE. Perfect for 
                    families, groups, and special occasions.
                  </p>
                </div>
                <img src="{{ asset('assets/img/about-card-shape.png') }}" alt="shape" class="about-card-shape">
              </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rc-our-mission-right">
              <div class="rc-section-title rc-section-title_left">
                <div class="rc-section-title-content">
                    <span>- Our Mission -</span>
                    <h2>What is Our Mission and Services</h2>
                    <p>
                      To redefine luxury and adventure by delivering top-tier car rental 
                      and tour services that exceed expectations, ensuring every customer 
                      drives away with satisfaction and unforgettable memories.
                    </p>
                </div>
              </div>
              <h4>Who We Are</h4>
              <p>
                At Amer Luxury, we believe that every journey should be more than 
                just a commute—it should be a statement. Whether you’re a tourist 
                looking to explore Dubai in style or a local in need of a reliable, 
                high-end ride, we provide an impressive fleet of luxury vehicles 
                to suit every need and occasion.
              </p>
            </div>
        </div>
      </div>
    </div>
  </div>

<!-- support section -->
@component('components.whyChoseUs')

@endcomponent
<!-- /support section -->

  <!-- Our Story Section -->
  <section class="our-story-section">
    <div class="container">
      <div class="our-story-content">
        <div class="our-story-subtitle">- Our Story -</div>
        <h2 class="our-story-title">Here is Our Journey- Redefining Luxury</h2>
        <p class="our-story-description">
          We believe that every journey should be as extraordinary as the destination. Born out of a passion for luxury and a commitment to excellence, we have redefined the car rental experience, offering a seamless blend of sophistication, comfort, and unmatched service.
        </p>
      </div>

      <div class="story-timeline">
        <div class="row">
          <div class="col-md-4">
            <div class="milestone-box milestone-box-1">
              <div class="milestone-icon">
                <img src="{{ asset('assets/img/calander.png') }}" alt="calander">
              </div>
              <div>
                <h4 class="milestone-title">Company Founded</h4>
                <p class="milestone-description">
                  Luxury Rent a Car was founded by Khaled Aki in Abu Dhabi and later expanded to Dubai, UAE.
                </p>
                <div class="milestone-date">Date: January 1, 2011</div>
                <div class="growth-icon">
                  <i class="fas fa-bolt"></i>
                </div>
              </div>
            </div>
            <div class="milestone-box milestone-box-2">
              <div class="milestone-icon">
                <img src="{{ asset('assets/img/calander.png') }}" alt="calander">
              </div>
              <div>
                <h4 class="milestone-title">Company Founded</h4>
                <p class="milestone-description">
                  Luxury Rent a Car was founded by Khaled Aki in Abu Dhabi and later expanded to Dubai, UAE.
                </p>
                <div class="milestone-date">Date: January 1, 2011</div>
                <div class="growth-icon">
                  <i class="fas fa-bolt"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="story-car-image">
              <img src="{{ asset('assets/img/story-img.png') }}" alt="Luxury Car" class="img-fluid">
            </div>
          </div>
          <div class="col-md-4">
            <div class="milestone-box milestone-box-3">
              <div class="milestone-icon">
                <img src="{{ asset('assets/img/calander.png') }}" alt="calander">
              </div>
              <div>
                <h4 class="milestone-title">Company Founded</h4>
                <p class="milestone-description">
                  Luxury Rent a Car was founded by Khaled Aki in Abu Dhabi and later expanded to Dubai, UAE.
                </p>
                <div class="milestone-date">Date: January 1, 2011</div>
                <div class="growth-icon">
                  <i class="fas fa-bolt"></i>
                </div>
              </div>
            </div>
            <div class="milestone-box milestone-box-4">
              <div class="milestone-icon">
                <img src="{{ asset('assets/img/calander.png') }}" alt="calander">
              </div>
              <div>
                <h4 class="milestone-title">Company Founded</h4>
                <p class="milestone-description">
                  Luxury Rent a Car was founded by Khaled Aki in Abu Dhabi and later expanded to Dubai, UAE.
                </p>
                <div class="milestone-date">Date: January 1, 2011</div>
                <div class="growth-icon">
                  <i class="fas fa-bolt"></i>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- /Our Story Section -->

  <!-- requirement section -->
  @component('components.requirements',[
  'from' => 'about',
  ])
  @endcomponent
  <!-- /requirement section -->


  <!-- testimonals -->
  <section class="page-section testimonials">
    <div class="container-fluid wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
      <div class="testimonials-carousel">
        <div class="owl-carousel" id="testimonials">
          <div class="testimonial">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object testimonial-avatar"
                    src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar" />
                </a>
              </div>
              <div class="media-body">
                <div class="testimonial-text">
                  Vivamus eget nibh. Etiam cursus leo vel metus. Nulla
                  facilisi. Aenean nec eros. Vestibulum ante ipsum primis
                  in faucibus orci luctus et ultrices posuere cubilia.
                </div>
                <div class="testimonial-name">
                  John Anthony Gibson
                  <span class="testimonial-position">Co- founder at Rent It</span>
                </div>
              </div>
            </div>
          </div>
          <div class="testimonial">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object testimonial-avatar"
                    src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar" />
                </a>
              </div>
              <div class="media-body">
                <div class="testimonial-text">
                  Vivamus eget nibh. Etiam cursus leo vel metus. Nulla
                  facilisi. Aenean nec eros. Vestibulum ante ipsum primis
                  in faucibus orci luctus et ultrices posuere cubilia.
                </div>
                <div class="testimonial-name">
                  John Anthony Gibson
                  <span class="testimonial-position">Co- founder at Rent It</span>
                </div>
              </div>
            </div>
          </div>
          <div class="testimonial">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object testimonial-avatar"
                    src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar" />
                </a>
              </div>
              <div class="media-body">
                <div class="testimonial-text">
                  Vivamus eget nibh. Etiam cursus leo vel metus. Nulla
                  facilisi. Aenean nec eros. Vestibulum ante ipsum primis
                  in faucibus orci luctus et ultrices posuere cubilia.
                </div>
                <div class="testimonial-name">
                  John Anthony Gibson
                  <span class="testimonial-position">Co- founder at Rent It</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /testimonals -->

  <!-- happy customers -->
  {{-- @component('components.happyCustomers')
  @endcomponent --}}
  <!-- /happy customers -->
</div>
<!-- /CONTENT AREA -->

@endsection

@push('script')
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
</script>
@endpush