 <section class="page-section rc-who-we-are">
        <div class="{{ $from == 'home' ? 'container' : '' }}">
            <div class="row">
                <div class="col-md-6" data-wow-offset="200" data-wow-delay="300ms">
                    <div class="rc-section-title rc-section-title_left">
                        <div class="rc-section-title-content">
                            <span>{{ __('home.about_us') }}</span>
                            <h2>{{ __('home.who_we_are') }}</h2>
                        </div>
                    </div>
                    <a href="assets/img/preview/slider/slide-775x500x1.jpg" data-gal="prettyPhoto" class="rc-who-we-are-image">
                        <img src="assets/img/preview/slider/slide-775x500x1.jpg" alt="" />
                        <span class="rc-who-we-are-image-shape-1"></span>
                        <span class="rc-who-we-are-image-shape-2"></span>
                    </a>
                </div>
                <div class="col-md-6" data-wow-offset="200" data-wow-delay="100ms">
                    <div class="rc-who-we-are-content">
                        <p>{{ __('home.who_we_are_details') }}</p>
                        <ul>
                            <li>Premium Vehicle Selection</li>
                            <li>Competitive Pricing</li>
                            <li>Flexible Booking & Delivery</li>
                            <li>Professional Chauffeur Services</li>
                            <li>Authentic Desert Safari Packages</li>
                        </ul>
                        <a href="{{ route('vahicles') }}" class="rc-btn-theme">{{ __('home.read_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>