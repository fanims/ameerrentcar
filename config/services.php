<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // config/services.php
    'ziina' => [
        'url' => env('ZIINA_API_URL'),
        'token' => env('ZIINA_API_TOKEN'),
    ],


    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URL'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_REDIRECT_URL'),
    ],

    'tabby' => [
        'secret_key' => env('TABBY_SECRET_KEY', ''),
        'public_key' => env('TABBY_PUBLIC_KEY', ''),
        'merchant_code' => env('TABBY_MERCHANT_CODE', '459000001725'),
        'test_mode' => env('TABBY_TEST_MODE', env('TABBY_ENV') === 'test'),
        'env' => env('TABBY_ENV', 'test'), // 'test' or 'live'
        'currency' => env('TABBY_CURRENCY', 'AED'),
        'sandbox_url' => env('TABBY_SANDBOX_URL', 'https://api.tabby.dev/api/v2/checkout'),
        'production_url' => env('TABBY_PRODUCTION_URL', 'https://api.tabby.ai/api/v2/checkout'),
        'sandbox_base_url' => env('TABBY_SANDBOX_BASE_URL', 'https://api.tabby.dev/api/v2'),
        'production_base_url' => env('TABBY_PRODUCTION_BASE_URL', 'https://api.tabby.ai/api/v2'),
        'test_email' => env('TABBY_TEST_EMAIL', 'otp.success@tabby.ai'),
        'default_email' => env('TABBY_DEFAULT_EMAIL', 'customer@example.com'),
        'default_image_url' => env('TABBY_DEFAULT_IMAGE_URL', 'https://example.com/car.jpg'),
        'verify_payments' => env('TABBY_VERIFY_PAYMENTS', true),
    ],


];
