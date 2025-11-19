<footer class="page-section rc-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Ameer Logo" class="rc-footer-logo" />
                <p class="rc-footer-desc">
                   {{ __('navigation.footer_text') }}
                </p>
                <div class="rc-footer-social-icons">
                    @php
                        $socials = get_socials();
                    @endphp
                    @if (!empty($socials[0]['facebook']))
                        <a href="{{ $socials[0]['facebook'] }}" target="_blank"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if (!empty($socials[0]['twitter']))
                        <a href="{{ $socials[0]['twitter'] }}" target="_blank"><i class="bi bi-twitter"></i></a>
                    @endif
                    @if (!empty($socials[0]['instagram']))
                        <a href="{{ $socials[0]['instagram'] }}" target="_blank"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if (!empty($socials[0]['whatsapp']))
                        <a href="{{ $socials[0]['whatsapp'] }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    @endif
                    @if (!empty($socials[0]['telegram']))
                        <a href="{{ $socials[0]['telegram'] }}" target="_blank"><i class="bi bi-telegram"></i></a>
                    @endif
                    @if (!empty($socials[0]['linkedin']))
                        <a href="{{ $socials[0]['linkedin'] }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if (!empty($socials[0]['phone']))
                        <a href="tel:{{ $socials[0]['phone'] }}"><i class="bi bi-telephone"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-3">
                <div class="rc-footer-menus">
                    <h5>Navigation</h5>
                    <ul>
                        <li><a href="{{ route('home')}}"> {{ __('navigation.home') }}</a></li>
                        <li><a href="{{ route('vahicles') }}"> {{ __('navigation.vehicles') }}</a></li>
                        <li><a href="{{ route('about-us') }}">{{ __('navigation.about-us') }}</a></li>
                        <li><a href="{{ route('faq') }}"> {{ __('navigation.faq') }}</a></li>
                        <li><a href="{{ route('contact-us') }}">{{ __('navigation.contact-us') }}</a></li>
                        <li><a href="{{ route('terms-and-conditions') }}">{{ __('navigation.terms-conditions') }}</a></li>
                    </ul>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="rc-footer-contact">
                    @php
                        $settings = getWebsiteSetting();
                    @endphp
                    <h4>Visit our office</h4>
                    <p>Airport Rd , Al Khabaisi, Dubai, United Arab Emirate</p>
                    <h4>Contact Us</h4>
                    <p>{{ $settings[0]['phone'] ?? '' }}</p>
                    <p>ameer.rentcar@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="rc-footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <p>© 2025 {{ __('home.copy_right') }}</p>
            </div>
        </div>
    </div>
</div>