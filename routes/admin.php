<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralPriceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::get('/admin/login', 'login')->name('admin.login')->middleware('guest');
    Route::post('/admin-login-store', 'storeLogin')->name('admin.storeLogin')->middleware('guest');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::controller(AuthController::class)->group(function () {
            Route::get('/profile/{id}', 'profile')->name('admin.profile');
            Route::get('/logout',  'logout')->name('admin.logout');
            Route::put('/profile/{id}', 'updateProfile')->name('admin.updateProfile');
            Route::post('update-password/{id}', 'updatePassword')->name('admin.updatePassword');
        });


        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('category.index');
            Route::get('/category/create', 'create')->name('category.create');
            Route::post('/category', 'store')->name('category.store');
            Route::get('/category/{category}/edit', 'edit')->name('category.edit');
            Route::put('/category/{category}', 'update')->name('category.update');
            Route::delete('/category/{category}', 'destroy')->name('category.destroy');
        });



        Route::controller(BrandController::class)->group(function () {
            Route::get('/brand', 'index')->name('brand.index');
            Route::get('/brand/create', 'create')->name('brand.create');
            Route::post('/brand', 'store')->name('brand.store');
            Route::get('/brand/{brand}/edit', 'edit')->name('brand.edit');
            Route::put('/brand/{brand}', 'update')->name('brand.update');
            Route::delete('/brand/{brand}', 'destroy')->name('brand.destroy');
        });



        Route::controller(CarController::class)->group(function () {
            Route::get('/cars/create',  'create')->name('cars.create');
            Route::post('/cars',  'store')->name('cars.store');
            Route::get('/cars', 'index')->name('cars.index');
            Route::get('/cars/{car}/edit', 'edit')->name('cars.edit');
            Route::put('/cars/{car}', 'update')->name('cars.update');
            Route::get('/show-car/{car}', 'show')->name('cars.show');
            Route::delete('/cars/{car}', 'destroy')->name('cars.destroy');
            Route::delete('car-image/{id}',  'imageDestroy')->name('car-image.destroy');
        });

        Route::get('/general-price', [GeneralPriceController::class, 'edit'])->name('admin.general-price.edit');
        Route::post('/general-price', [GeneralPriceController::class, 'update'])->name('admin.general-price.update');



        // routes/web.php

        Route::resource('languages', \App\Http\Controllers\Admin\LanguageController::class);
        Route::post('/languages/{id}/set-default', [\App\Http\Controllers\Admin\LanguageController::class, 'setDefault'])->name('languages.setDefault');

        Route::resource('/currencies', \App\Http\Controllers\Admin\CurrencyController::class);
        Route::resource('social', SocialController::class)->names('social');
        Route::resource('coupons', CouponController::class);
        Route::resource('contact', ContactController::class)->only(['index', 'destroy']);
        Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);
        Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);
        Route::resource('car-types', CarTypeController::class);






        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('orders.index');
            Route::get('/orders/{order}', 'show')->name('orders.show');
            Route::patch('/orders/{order}/status',  'updateStatus')->name('orders.update-status');
            Route::patch('/orders/{order}/payment-status',  'updatePaymentStatus')->name('orders.update-payment-status');
            Route::delete('/orders/{order}',  'destroy')->name('orders.destroy');
        });


        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('users.index');
            Route::get('/users/{user}', 'show')->name('users.show');
            Route::delete('/users/{user}', 'destroy')->name('users.destroy');
            Route::post('/admin/users/mark-as-read',  'markAsRead')->name('admin.users.markAsRead');
            Route::put('/user/{id}/update',  'update')->name('user.update');
            Route::put('/user/{id}/update-password',  'updatePassword')->name('user.update.password');
            Route::put('/user/{id}/update-status',  'updateStatus')->name('user.update.status');
            Route::get("/user/create", "create")->name("admin.create");
            Route::post('/user/store',  'store')->name('admin.store');
        });



        Route::controller(WebsiteSettingController::class)->group(function () {
            Route::get('/settings',  'create')->name('website.create');
            Route::post('/settings',  'store')->name('website.store');
        });
        Route::controller(ReportController::class)->group(function () {
            Route::get('/reports', 'orderReport')->name('admin.reports.orders');
        });
    });
});
