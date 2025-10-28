<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedAdmin;
use App\Mail\OrderPlacedUser;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\ZiinaService;
use Illuminate\Support\Facades\Storage;
use App\Models\Coupon;
use App\Services\TabbyService;


class OrderController extends Controller
{

    public function storeCheckout(Request $request, $id)
    {
        $validated = $request->validate([
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'dropoff_date' => 'required|date',
            'dropoff_time' => 'required',
            'grand_total' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);


        // Optional: Fetch extra selections from form
        $extras = $request->input('extras', []); // array of selected extra keys like ['fuelTank', 'depositFee']
        $extra_prices = $request->input('extra_prices', []); // array like ['fuelTank' => 400]

        // Build selected extras for session
        $selected_extras = [];
        foreach ($extras as $key) {
            if (isset($extra_prices[$key])) {
                $selected_extras[$key] = (float) $extra_prices[$key];
            }
        }

        session([
            'order_data' => [
                'pickup_date' => $validated['pickup_date'],
                'pickup_time' => $validated['pickup_time'],
                'dropoff_date' => $validated['dropoff_date'],
                'dropoff_time' => $validated['dropoff_time'],
                'car_price' => $validated['subtotal'],
                'grand_total' => $validated['grand_total'],
                'tax' => $validated['tax'],
                'extras' => $selected_extras,
            ],
            'car_id' => $id,
        ]);


        return redirect()->route('booking-details', $id);
    }



    public function storeBooking(Request $request, Car $car)
    {
        $data = $request->validate([
            'full_name'          => 'required|string|max:255',
            'nationality'        => 'required|string|max:255',
            'date_of_birth'      => 'required|date',
            'email'              => 'required|email',
            'delivery_location'  => 'required|string',
            'receiving_location' => 'required|string',
            'phone'              => 'required|string',
            'whatsapp'           => 'nullable|string',
            'license'            => 'required|in:yes,no',
            'special_requests'   => 'nullable|string',
            'license_files'      => 'required_if:license,yes|array',
            'license_files.*'    => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_method' => 'required|in:online,cod,tabby',
        ]);

        if ($request->license === 'yes' && $request->hasFile('license_files')) {
            $uploadedFiles = [];

            foreach ($request->file('license_files') as $file) {
                $path = $file->store('license_uploads', 'public'); // save to storage/app/public/license_uploads
                $uploadedFiles[] = $path;
            }

            $data['license_files'] = $uploadedFiles;
        }

        // Store everything in session
        session()->put('booking_data', $data);

        return redirect()->route('payment', $car->id)->with('success', 'Booking details saved.');
    }


    public function store(Request $request, ZiinaService $ziina)
    {
        $payment = $request->validate([
            'billing_country'  => 'nullable',
            'billing_state'    => 'nullable',
            'billing_city'     => 'nullable',
            'billing_zip'      => 'nullable',
            'billing_address'  => 'nullable',
            'status'           => 'nullable',
        ]);


        $orderData = session('order_data');
        $bookingData = session('booking_data');
        $carId = session('car_id');
        $orderId = 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999);
        while (Order::where('order_id', $orderId)->exists()) {
            $orderId = 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999);
        }

        if (!$orderData || !$bookingData || !$carId) {
            return redirect()->route('home')->with('error', 'Session expired. Please start the booking again.');
        }

        $finalData = array_merge(
            $orderData,
            $bookingData,
            $payment,
            [
                'car_id' => $carId,
                'user_id' => auth()->id() ?? 'Guest-' . rand(1000, 9999),
                'order_id' => $orderId, // ✅ add it here
            ]
        );

        session()->put('full_order_data', $finalData);

        if (isset($bookingData['payment_method']) && $bookingData['payment_method'] === 'cod') {
            return $this->handleCodOrder($finalData);
        } else if ($bookingData['payment_method'] === 'tabby') {
            $tabby = new TabbyService();
            return $tabby->createCheckout($finalData); // Will redirect inside the service
        }


        // ✅ Proceed with online payment
        $paymentIntent = $ziina->createPaymentIntent([
            'amount' => $orderData['grand_total'],
            'name' => $bookingData['full_name'],
            'success_url' => route('payment.success',  ['gateway' => 'ziina']),
            'cancel_url' => route('payment.cancel',  ['gateway' => 'ziina']),
            'failure_url' => route('payment.failure',  ['gateway' => 'ziina']),
        ]);

        if (isset($paymentIntent['redirect_url'])) {
            return redirect($paymentIntent['redirect_url']);
        }

        return back()->with('error', 'Unable to initiate payment.');
    }

    private function handleCodOrder(array $finalData)
    {
        if (isset($finalData['license_files']) && is_array($finalData['license_files'])) {
            $finalData['license_files'] = json_encode($finalData['license_files']);
        }

        $uniqueOrderId = $finalData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));

        $order = Order::create(array_merge($finalData, [
            'payment_status' => 'unpaid', // 
            'payment_method' => 'cod', // ✅ COD
            'order_id' => $uniqueOrderId,
            'discount' => session('applied_coupon.discount') ?? 0,
            'coupon_code' => session('applied_coupon.code') ?? null,
        ]));

        if (!$order) {
            return redirect()->route('home')->with('error', 'Unable to save order.');
        }

        Mail::to('admin@example.com')->send(new OrderPlacedAdmin($finalData));
        Mail::to($finalData['email'])->send(new OrderPlacedUser($finalData));

        session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data']);

        return view('frontend.pages.thankyou', compact('order'))->with('success', 'Your order has been placed successfully with Cash on Delivery!');
    }



    public function paymentSuccess(Request $request)
    {
        $gateway = $request->get('gateway', 'unknown');
        $finalData = session('full_order_data');

        if (!$finalData) {
            return redirect()->route('home')->with('error', 'Order session expired.');
        }
        $finalData['payment_method'] = $gateway;

        // Encode license files
        if (isset($finalData['license_files']) && is_array($finalData['license_files'])) {
            $finalData['license_files'] = json_encode($finalData['license_files']);
        }

        // Generate unique order ID (example: ORD-20250625-8392)
        $uniqueOrderId = $finalData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));


        $order = Order::create(array_merge($finalData, [
            'payment_status' => 'paid', // 
            'payment_method' => $gateway, // ✅ COD
            'order_id' => $uniqueOrderId,
            'discount' => session('applied_coupon.discount') ?? 0,
            'coupon_code' => session('applied_coupon.code') ?? null,
        ]));

        if (!$order) {
            return redirect()->route('home')->with('error', 'Unable to save order.');
        }

        Mail::to('admin@example.com')->send(new OrderPlacedAdmin($finalData));
        Mail::to($finalData['email'])->send(new OrderPlacedUser($finalData));

        session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data']);

        return view('frontend.pages.thankyou', compact('order'))->with('success', 'Your order has been placed successfully!');
    }


    public function paymentCancel(Request $request)
    {
        $gateway = $request->get('gateway', 'unknown'); // tabby, ziina, etc.

        try {
            $failedData = session('full_order_data');

            if ($failedData) {
                // If license_files is array, encode it
                if (isset($failedData['license_files']) && is_array($failedData['license_files'])) {
                    $failedData['license_files'] = json_encode($failedData['license_files']);
                }

                $uniqueOrderId = $finalData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));


                Order::create(array_merge($failedData, [
                    'payment_status' => 'cancelled',
                    'payment_method' => $gateway,
                    'order_id' => $uniqueOrderId,
                    'discount' => session('applied_coupon.discount') ?? 0,
                    'coupon_code' => session('applied_coupon.code') ?? null,
                ]));

                session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data']);
            }

            return redirect()->route('home')->with('error', 'Payment was cancelled.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Payment cancelled. Please try again.');
        }
    }


    public function paymentFailure(Request $request)
    {
        $gateway = $request->get('gateway', 'unknown');

        try {
            $failedData = session('full_order_data');

            if ($failedData) {
                if (isset($failedData['license_files']) && is_array($failedData['license_files'])) {
                    $failedData['license_files'] = json_encode($failedData['license_files']);
                }

                $uniqueOrderId = $finalData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));

                Order::create(array_merge($failedData, [
                    'payment_status' => 'failed',
                    'payment_method' => $gateway,
                    'order_id' => $uniqueOrderId,
                    'discount' => session('applied_coupon.discount') ?? 0,
                    'coupon_code' => session('applied_coupon.code') ?? null,
                ]));

                session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data']);
            }

            return redirect()->route('home')->with('error', 'Payment failed.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Payment failed. Please try again.');
        }
    }



    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', $request->code)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })->first();

        if (!$coupon) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired coupon.']);
        }

        $order = session('order_data');

        if (!$order || !isset($order['car_price'])) {
            return response()->json(['status' => 'error', 'message' => 'No order total found.']);
        }

        $car_price = $order['car_price'];
        $driver_price = $order['driver_price'] ?? 0;
        $extras = $order['extras'] ?? [];

        // Calculate discount
        $discountAmount = $coupon->type === 'percent'
            ? ($car_price * $coupon->value / 100)
            : $coupon->value;

        $car_price_after_discount = max(0, $car_price - $discountAmount);

        // Total = discounted car price + driver + extras
        $extras_total = array_sum($extras);
        $grand_total = $car_price_after_discount + $driver_price + $extras_total;

        // Update session
        session()->put('order_data.car_price', $car_price_after_discount);
        session()->put('order_data.discount', $discountAmount);
        session()->put('order_data.grand_total', $grand_total);

        session()->put('applied_coupon', [
            'code' => $coupon->code,
            'discount' => $discountAmount,
            'new_total' => $car_price_after_discount,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Coupon applied! New total: {$grand_total} AED",
            'new_total' => $grand_total,
        ]);
    }
}
