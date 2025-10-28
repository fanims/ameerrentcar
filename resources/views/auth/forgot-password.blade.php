<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password | Rent It</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #000002;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25);
            width: 400px;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .baton {
            border-radius: 20px;
            border: none;
            background-color: #ce933c;
            color: #000002;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 15px;
        }
        a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
}
    </style>
</head>

<body>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
            style="height: 50px; blend-mode: lighten; margin-bottom: 15px; border-radius: 10px;" class="me-2">

        <h1>{{ __('auth.forget_password') }}</h1>
        <p>{{ __('auth.enter_you_email') }}</p>

        @if (session('status'))
        <div style="color:green;">{{ session('status') }}</div>
        @endif

        @error('email')
        <div style="color:red;">{{ $message }}</div>
        @enderror

        <input type="email" name="email" placeholder="Email" required />
        <button class="baton" type="submit">{{ __('auth.send_reset_link') }}</button>
        <a href="{{ route('login') }}">{{ __('auth.back_to_login') }}</a>
    </form>

</body>

</html>