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
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                            <h1>{{ __('auth.hello_there') }}</h1>
                            <p>{{ __('auth.register_desc') }}</p>
                            <form method="POST" action="{{ route('login') }}" class="rc-auth-form">
                                @csrf
                                @if($errors->any())
                                    <div style="color: red;">
                                        @foreach($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="text" name="name" placeholder="{{ __('auth.name') }}" value="{{ old('name') }}" required />
                                <input type="email" name="email" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}"
                                    required />
                                <input type="password" name="password" placeholder="{{ __('auth.password') }}" required />
                                <input type="password" name="password_confirmation" placeholder="{{ __('auth.password_confirmation') }}"
                                    required />
                                <button class="rc-btn-theme" type="submit">{{ __('auth.register') }}</button>
                            </form>
                            <div class="rc-login-option">
                                <p>{{ __('auth.dont_have_an_account') }}</p>
                                <a href="{{ route('login.form') }}">{{ __('auth.login') }}</a>
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