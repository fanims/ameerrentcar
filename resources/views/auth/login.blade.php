<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Rent It</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    @include('frontend.includes.style')
</head>

<body>
    <!-- Top contact bar -->
    @include('frontend.includes.topbar')
    <div class="rc-auth">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rc-auth-wrap">
                        <div class="rc-auth-content">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                            </a>
                            <h1>{{ __('auth.welcome_back') }}</h1>
                            <p>{{ __('auth.login_desc') }}</p>
                            <form method="POST" action="{{ route('login') }}" class="rc-auth-form">
                                @csrf
                                @if(session('success'))
                                    <div style="color: green;">{{ session('success') }}</div>
                                @endif
                                @if($errors->any())
                                    <div style="color: red;">
                                        @foreach($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="email" name="email" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}" required />
                                <input type="password" name="password" placeholder="{{ __('auth.password') }}" required />
                                <a href="{{ route('password.request') }}">{{ __('auth.forget_password_link') }}</a>
                                <button class="rc-btn-theme" type="submit">{{ __('auth.login') }}</button>
                            </form>
                            <div class="rc-devider">
                                <span>or login with</span>
                            </div>
                            <div class="rc-footer-social-icons">
                                @php
                                    $socials = get_socials();
                                @endphp
                                @if (!empty($socials[0]['facebook']))
                                    <a href="{{ $socials[0]['facebook'] }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                @endif
                                <a href="#" target="_blank"><i class="bi bi-google"></i></a>
                            </div>
                            <div class="rc-signup-option">
                                <p>{{ __('auth.dont_have_an_account') }}</p>
                                <a href="{{ route('register.form') }}">{{ __('auth.signup') }}</a>
                            </div>
                        </div>
                        <figure class="rc-auth-img">
                            <img src="{{ asset('assets/img/login-sec-img.png') }}" alt="Login">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('assets/img/bg-shape.png') }}" alt="Login" class="bg-shape">
    </div>
</body>

</html>