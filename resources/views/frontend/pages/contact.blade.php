@extends('frontend.layout.layout')

@section('meta_title')
Ameer RAC | Contact Us
@endsection

@section('style')

@endsection

@section('content')
<!-- CONTENT AREA -->
<section class="page-section rc-contact" id="contact">
  @if(Session::has('success'))
  <div class="alert alert-success">
    {{ Session::get('success') }}
  </div>
  @endif
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="rc-section-title rc-section-title_left" data-wow-offset="70" data-wow-delay="100ms">
          <div class="rc-section-title-content">
            <span>{{ __('home.get_in_touch_tagline') }}</span>
            <h2>{{ __('home.get_in_touch') }}</h2>
          </div>
        </div>
        <div class="rc-contact-wrap">
          <div class="direct-contact-container">
            @php
            $settings = getWebsiteSetting();
            @endphp
            <h4>{{ __('home.form_heading') }}</h4>
            <p>{{ __('home.form_desc') }}</p>
            <ul class="contact-list">
              <li class="list-item">
                <i class="fa fa-phone fa-2x"></i>
                <span class="contact-text ">
                  <a href="tel:{{ $settings[0]['phone'] ?? '#' }}" title="Give me a call">
                    {{ $settings[0]['phone'] ?? 'Phone not available' }}
                  </a>
                </span>
              </li>
              <li class="list-item">
                <i class="fa fa-envelope fa-2x"></i>
                <span class="contact-text ">
                  <a href="mailto:{{ $settings[0]['email'] ?? '#' }}" title="Send me an email">
                    {{ $settings[0]['email'] ?? 'Email not available' }}
                  </a>
                </span>
              </li>
              <li class="list-item">
                <i class="fa fa-map-marker fa-2x"></i>
                <span class="contact-text ">
                  {{ $settings[0]['address'] ?? 'Address not available' }}
                </span>
              </li>
            </ul>
            <ul class="social-media-list">
              @php
              $socials = get_socials();
              @endphp
              <li><a href="{{ $socials[0]['facebook'] ?? '#' }}" target="_blank" class="contact-icon">
                  <i class="fa fa-facebook" aria-hidden="true"></i></a>
              </li>
              <li><a href="{{ $socials[0]['whatsapp'] ?? '#' }}" target="_blank" class="contact-icon">
                  <i class="fa fa-whatsapp" aria-hidden="true"></i></a>
              </li>
              <li><a href="{{ $socials[0]['linkedin'] ?? '#' }}" target="_blank" class="contact-icon">
                  <i class="fa fa-linkedin" aria-hidden="true"></i></a>
              </li>
              <li><a href="{{ $socials[0]['instagram'] ?? '#' }}" target="_blank" class="contact-icon">
                  <i class="fa fa-instagram" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
          <form method="POST" action="{{ route('contact.store') }}" id="contact-form" class="form-horizontal" role="form">
            @csrf
            <div class="form-group-wrap">
              <div class="form-group form-group-half">
                <label for="name">{{ __('home.form_name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="First Name" name="name" value="" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group form-group-half">
                <label for="name">{{ __('home.form_last_name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="Last Name" name="name" value="">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="form-group-wrap">
              <div class="form-group form-group-half">
                <label for="email">{{ __('home.form_email') }}</label>
                <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" value="" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group form-group-half">
                <label for="email">{{ __('home.form_phone') }}</label>
                <input type="text" class="form-control" placeholder="Phone Number" name="email" value="">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>
            @error('message')
            <span class="text-danger">{{ $message }}</span>
            @enderror
  
            <button class="rc-btn-theme" id="submit" type="submit" value="SEND">
              {{ __('home.send') }}
            </button>
          </form>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="contact-form-image">
          <img src="{{ asset('assets/img/contact-form-img.png') }}" alt="Contact Image">
        </div>
      </div>
    </div>
  </div>
</section>
<div class="content-area">

  <!-- google api -->
  <section class="page-section dark">
    <div class="container-fluid">
      <!-- Google map -->
      <div class="google-map">
        <div id="map-canvas"></div>
      </div>
      <!-- /Google map -->
    </div>
  </section>
  <!-- / google api  -->



</div>
<!-- /CONTENT AREA -->
@endsection