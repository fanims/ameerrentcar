<?php

// use Illuminate\Support\Facades\App;

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\Language;

// routes/web.php


Route::get('/lang/{locale}', function ($locale) {
    $language = Language::where('code', $locale)->firstOrFail();
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
        Session::put('direction', $language->direction);
    }
    return redirect()->back();
})->name('lang.switch');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});




Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/register',  'showRegisterForm')->name('register.form');
    Route::post('/register',  'register')->name('register');
    Route::get('/login',  'showLoginForm')->name('login.form');
    Route::post('/login',  'login')->name('login');
    Route::post('/logout',  'logout')->name('logout')->middleware('auth');

    // Google
    Route::get('auth/google',  'redirectToGoogle');
    Route::get('auth/google/callback',  'handleGoogleCallback');

    // Facebook
    Route::get('auth/facebook',  'redirectToFacebook');
    Route::get('auth/facebook/callback',  'handleFacebookCallback');

    // LinkedIn
    Route::get('auth/linkedin',  'redirectToLinkedIn');
    Route::get('auth/linkedin/callback',  'handleLinkedInCallback');


    // Show form to request reset link
    Route::get('forgot-password',  'showLinkRequestForm')->name('password.request');
    // Send reset link to email
    Route::post('forgot-password',  'sendResetLinkEmail')->name('password.email');
    // Show reset password form
    Route::get('reset-password/{token}',  'showResetForm')->name('password.reset');
    // Reset password
    Route::post('reset-password',  'reset')->name('password.update');
});


Route::controller(App\Http\Controllers\FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/vehicles', 'vehicles')->name('vahicles');
    Route::get('vehicle/{id}/{name}', 'vehicleByBrand')->name('vehicle');
    Route::get('/about-us', 'about')->name('about-us');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/contact-us', 'contact')->name('contact-us');
    Route::get('/checkout/{slug}', 'checkout')->name('checkout');
    Route::get('/checkout-form/{id}', 'checkoutForm')->name('checkout-form');
    Route::get('/add-to-cart/{id}', 'addToCart')->name('add-to-cart');
    Route::get('/booking-details/{id}', 'bookingDetails')->name('booking-details');
    Route::get('/payment/{id}', 'payment')->name('payment');
    Route::get('/add-payment', 'addPayment')->name('add-payment');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('/terms-and-conditions', 'termsConditions')->name('terms-and-conditions');
    Route::get('/search', 'vehicles')->name('search');
    Route::get('/car-search',  'search')->name('car.search');
    // Route::get('/thank-you', 'thankYou')->name('thank-you');
});

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::controller(OrderController::class)->group(function () {
    Route::post('/store-checkout/{id}',  'storeCheckout')->name('store.checkout');
    Route::post('/booking-details/{car}',  'storeBooking')->name('booking.store');
    Route::post('/order',  'store')->name('order.store');
    Route::post('/apply-coupon',  'applyCoupon')->name('apply.coupon');
    Route::post('/payment-method/store',  'storePaymentMethod')->name('payment.method.store');

    Route::get('/ziina/payment/success',  'paymentSuccess')->name('payment.success');
    Route::get('/ziina/payment/cancel',  'paymentCancel')->name('payment.cancel');
    Route::get('/ziina/payment/failure',  'paymentFailure')->name('payment.failure');
});

// Tabby Payment Routes
Route::controller(App\Http\Controllers\TabbyPaymentController::class)->group(function () {
    Route::get('/tabby/payment/success',  'success')->name('tabby.payment.success');
    Route::get('/tabby/payment/cancel',  'cancel')->name('tabby.payment.cancel');
    Route::get('/tabby/payment/failure',  'failure')->name('tabby.payment.failure');
    Route::get('/tabby/payment/simulate',  'simulateSuccess')->name('tabby.payment.simulate');
});

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('web.user.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('user.update.password');
});



use Illuminate\Support\Facades\App;

Route::get('/api/car-search', function (Request $request) {
    $query = $request->get('q');
    $locale = App::getLocale(); // 'en' or 'ar'

    $cars = \App\Models\Car::with('category')
        ->where('name->en', 'like', "%{$query}%")
        ->orWhere('name->ar', 'like', "%{$query}%")
        ->limit(10)
        ->get();

    return response()->json(
        $cars->map(function ($car) use ($locale) {
            return [
                'name'     => $car->name,
                'slug'     => $car->slug,
                'category' => $car->category ? ($car->category->name[$locale] ?? '') : '',
            ];
        })
    );
});


require __DIR__ . '/admin.php';
