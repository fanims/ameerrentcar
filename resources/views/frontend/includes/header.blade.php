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

<style>
    /* Ensure the wrapper is relative so absolute positioning works within it */
    .rc-search-wrapper {
        position: relative;
    }

    /* Input field container styling */
    #searchBar {
        display: none; /* Hidden by default */
        position: absolute;
        top: 100%; /* Position it directly below the button */
        right: 0;
        z-index: 1000;
        border-radius: 4px;
        min-width: 250px;
        margin-top: 10px;
    }

    /* Show state class */
    #searchBar.active {
        display: block;
    }

    /* Style the input inside */
    #searchBar input {
        width: 100%;
        outline: none;
        min-height: 40px;
        color: #ce933c;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #ce933c;
    }
    
    /* Style search icon if inside */
    #searchBar i {
        display: none; /* Hide icon inside input container if desired, or style it */
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchToggle = document.getElementById('searchToggle');
    const searchBar = document.getElementById('searchBar');

    if (searchToggle && searchBar) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent event from bubbling
            searchBar.classList.toggle('active');
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchToggle.contains(e.target) && !searchBar.contains(e.target)) {
                searchBar.classList.remove('active');
            }
        });

        // Prevent closing when clicking inside the search bar
        searchBar.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});
</script>
