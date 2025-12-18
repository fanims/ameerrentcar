<header class="header">
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rc-header-content">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="Rent It" /></a>
                        </div>
                        <!-- /Logo -->
                        <!-- Mobile menu toggle button -->
                        <a href="#" class="menu-toggle ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                        <!-- /Mobile menu toggle button -->
                        <!-- Navigation -->
                        <nav class="navigation closed clearfix">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <!-- navigation menu -->
                                    <a href="#" class="menu-toggle-close"><i class="fa fa-times"></i></a>
                                    <ul class="nav sf-menu">
                                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">{{ __('navigation.home') }}</a></li>
                                        <li class="{{ request()->routeIs('vahicles') || request()->routeIs('vehicle') || request()->routeIs('search') || request()->routeIs('car.search') ? 'active' : '' }}"><a href="{{ route('vahicles') }}">{{ __('navigation.vehicles') }}</a></li>
                                        <li class="{{ request()->routeIs('about-us') ? 'active' : '' }}"><a href="{{ route('about-us') }}">{{ __('navigation.about-us') }}</a></li>
                                        <li class="{{ request()->routeIs('faq') ? 'active' : '' }}"><a href="{{ route('faq') }}">{{ __('navigation.faq') }}</a></li>
                                        <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">{{ __('navigation.contact-us') }}</a></li>
                                        <li class="{{ request()->routeIs('privacy-policy') ? 'active' : '' }}"><a href="{{ route('privacy-policy') }}">{{ __('navigation.privacy-policy') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Add Scroll Bar -->
                            <div class="swiper-scrollbar"></div>
                        </nav>
                        <!-- /Navigation -->
                        <!-- Search icon toggle -->
                        {{-- <div class="nav-item search-wrapper" id="searchWrapper">
                            <button class="search-toggle" id="searchToggle">
                                <i class="bi bi-search"></i>
                            </button>
                            <div class="search-bar" id="searchBar">
                                <i class="bi bi-search"></i>
                                <input type="text" placeholder="SEARCH" />
                            </div>
                        </div> --}}
                        <div class="nav-item rc-search-wrapper" id="searchWrapper">
                            <button class="rc-btntwo" id="searchToggle">
                                <i class="bi bi-search"></i>
                                Search
                            </button>
                            <div class="search-bar" id="searchBar">
                                <i class="bi bi-search"></i>
                                <input type="text" id="carSearchInput" placeholder="SEARCH" autocomplete="off" />
                                <!-- Results Dropdown -->
                                <ul id="carSearchResults" class="list-group position-absolute mt-2 w-100"
                                    style="z-index: 9999; display: none; max-height: 300px; overflow-y: auto;">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
