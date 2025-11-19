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
    max-width: 1200px;
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
    background: transparent;
    border: 2px solid #D4AF37;
    border-radius: 15px;
    padding: 30px;
    position: relative;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
  }

  .milestone-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(212, 175, 55, 0.2);
  }

  .milestone-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #D4AF37, #FFD700);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #000000;
  }

  .milestone-title {
    color: #ffffff;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .milestone-description {
    color: #ffffff;
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 15px;
  }

  .milestone-date {
    color: #D4AF37;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
  }

  .growth-icon {
    position: absolute;
    bottom: 20px;
    right: 20px;
    width: 30px;
    height: 30px;
    color: #D4AF37;
    font-size: 20px;
    animation: pulse 2s infinite;
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

  .milestone-box:nth-child(1) {
    animation: slideInLeft 0.8s ease-out;
  }

  .milestone-box:nth-child(2) {
    animation: slideInRight 0.8s ease-out 0.2s both;
  }

  .milestone-box:nth-child(3) {
    animation: slideInLeft 0.8s ease-out 0.4s both;
  }

  .milestone-box:nth-child(4) {
    animation: slideInRight 0.8s ease-out 0.6s both;
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
                <span></span>
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
                <span></span>
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
        <div class="story-car-image">
          <img src="{{ asset('storage/sliders/banner-img-1.png') }}" alt="Luxury Car" class="img-fluid">
        </div>

        <div class="story-milestones">
          <!-- Left Column -->
          <div class="milestone-box">
            <div class="milestone-icon">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <h4 class="milestone-title">Company Founded</h4>
            <p class="milestone-description">
            Luxury Rent a Car was founded by Khaled Aki in Abu Dhabi and later expanded to Dubai, UAE.
            </p>
            <div class="milestone-date">Date: January 1, 2011</div>
            <div class="growth-icon">
              <i class="fas fa-bolt"></i>
            </div>
          </div>

          <div class="milestone-box">
            <div class="milestone-icon">
              <i class="fas fa-globe"></i>
            </div>
            <h4 class="milestone-title">Expansion to Global Markets</h4>
            <p class="milestone-description">
              Opened branches in Abu Dhabi, Dubai, expanding our services across the UAE.
            </p>
            <div class="milestone-date">Date: January 1, 2020</div>
            <div class="growth-icon">
              <i class="fas fa-bolt"></i>
            </div>
          </div>

          <!-- Right Column -->
          <div class="milestone-box">
            <div class="milestone-icon">
              <i class="fas fa-users"></i>
            </div>
            <h4 class="milestone-title">Reached 40,000 Customers</h4>
            <p class="milestone-description">
              Celebrated a milestone of serving 40,000 satisfied customers with our luxury car rental services.
            </p>
            <div class="milestone-date">Date: June 1, 2024</div>
            <div class="growth-icon">
              <i class="fas fa-bolt"></i>
            </div>
          </div>

          <div class="milestone-box">
            <div class="milestone-icon">
              <i class="fas fa-trophy"></i>
            </div>
            <h4 class="milestone-title">Industry Recognition</h4>
            <p class="milestone-description">
              Received the "Best Luxury Car Rental Company in UAE" award at the Middle East Business Awards.
            </p>
            <div class="milestone-date">Date: November 1, 2023</div>
            <div class="growth-icon">
              <i class="fas fa-bolt"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Our Story Section -->

  <!-- support section -->
  @component('components.whyChoseUs')

  @endcomponent
  <!-- /support section -->

  <!-- Who we are -->
  @component('components.whoWeAre', [
  'from' => 'about'
  ])
  @endcomponent
  <!-- /Who we are -->

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