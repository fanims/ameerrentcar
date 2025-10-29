<?php

namespace App\Http\Controllers;

use App\Services\TabbyService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderPlacedAdmin;
use App\Mail\OrderPlacedUser;
use Illuminate\Support\Facades\Mail;

class TabbyPaymentController extends Controller
{
    protected $tabbyService;

    public function __construct(TabbyService $tabbyService)
    {
        $this->tabbyService = $tabbyService;
    }

    /**
     * Handle successful Tabby payment
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function success(Request $request)
    {
        try {
            $finalData = session('full_order_data');

            if (!$finalData) {
                Log::warning('Tabby Success: No order data in session');
                return redirect()->route('home')->with('error', 'Order session expired. Please start the booking again.');
            }

            // Verify payment with Tabby (optional, if payment_id is provided)
            $paymentId = $request->get('payment_id') ?? $request->get('id');
            if ($paymentId && config('services.tabby.verify_payments', true)) {
                $paymentStatus = $this->tabbyService->getPaymentStatus($paymentId);
                if ($paymentStatus && isset($paymentStatus['status']) && $paymentStatus['status'] !== 'authorized') {
                    Log::warning('Tabby Payment Not Authorized', [
                        'payment_id' => $paymentId,
                        'status' => $paymentStatus['status']
                    ]);
                    return $this->failure($request);
                }
            }

            $finalData['payment_method'] = 'tabby';
            $finalData['payment_status'] = 'paid';

            // Encode license files if array
            if (isset($finalData['license_files']) && is_array($finalData['license_files'])) {
                $finalData['license_files'] = json_encode($finalData['license_files']);
            }

            // Generate unique order ID
            $uniqueOrderId = $finalData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));
            while (Order::where('order_id', $uniqueOrderId)->exists()) {
                $uniqueOrderId = 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999);
            }

            $order = Order::create(array_merge($finalData, [
                'payment_status' => 'paid',
                'payment_method' => 'tabby',
                'order_id' => $uniqueOrderId,
                'discount' => session('applied_coupon.discount') ?? 0,
                'coupon_code' => session('applied_coupon.code') ?? null,
            ]));

            if (!$order) {
                Log::error('Tabby Success: Failed to create order', ['data' => $finalData]);
                return redirect()->route('home')->with('error', 'Unable to save order.');
            }

            // Send confirmation emails
            try {
                Mail::to(config('mail.from.address', 'admin@example.com'))->send(new OrderPlacedAdmin($finalData));
                if (isset($finalData['email'])) {
                    Mail::to($finalData['email'])->send(new OrderPlacedUser($finalData));
                }
            } catch (\Exception $e) {
                Log::error('Tabby Success: Email sending failed', ['error' => $e->getMessage()]);
            }

            // Clear session data
            session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data', 'applied_coupon']);

            Log::info('Tabby Payment Success', ['order_id' => $uniqueOrderId]);

            return view('frontend.pages.thankyou', compact('order'))
                ->with('success', 'Your order has been placed successfully with Tabby payment!');
                
        } catch (\Exception $e) {
            Log::error('Tabby Success Handler Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('home')->with('error', 'An error occurred while processing your payment.');
        }
    }

    /**
     * Handle cancelled Tabby payment
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request)
    {
        try {
            $failedData = session('full_order_data');

            if ($failedData) {
                // Encode license files if array
                if (isset($failedData['license_files']) && is_array($failedData['license_files'])) {
                    $failedData['license_files'] = json_encode($failedData['license_files']);
                }

                $uniqueOrderId = $failedData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));
                while (Order::where('order_id', $uniqueOrderId)->exists()) {
                    $uniqueOrderId = 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999);
                }

                Order::create(array_merge($failedData, [
                    'payment_status' => 'cancelled',
                    'payment_method' => 'tabby',
                    'order_id' => $uniqueOrderId,
                    'discount' => session('applied_coupon.discount') ?? 0,
                    'coupon_code' => session('applied_coupon.code') ?? null,
                ]));

                session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data', 'applied_coupon']);
            }

            Log::info('Tabby Payment Cancelled', ['request' => $request->all()]);

            return redirect()->route('home')->with('warning', 'Payment was cancelled. You can try again.');
            
        } catch (\Exception $e) {
            Log::error('Tabby Cancel Handler Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('home')->with('error', 'Payment cancelled. Please try again.');
        }
    }

    /**
     * Handle failed Tabby payment
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failure(Request $request)
    {
        try {
            $failedData = session('full_order_data');

            if ($failedData) {
                if (isset($failedData['license_files']) && is_array($failedData['license_files'])) {
                    $failedData['license_files'] = json_encode($failedData['license_files']);
                }

                $uniqueOrderId = $failedData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));
                while (Order::where('order_id', $uniqueOrderId)->exists()) {
                    $uniqueOrderId = 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999);
                }

                Order::create(array_merge($failedData, [
                    'payment_status' => 'failed',
                    'payment_method' => 'tabby',
                    'order_id' => $uniqueOrderId,
                    'discount' => session('applied_coupon.discount') ?? 0,
                    'coupon_code' => session('applied_coupon.code') ?? null,
                ]));

                session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data', 'applied_coupon']);
            }

            Log::warning('Tabby Payment Failed', ['request' => $request->all()]);

            return redirect()->route('home')->with('error', 'Payment failed. Please try again or contact support.');
            
        } catch (\Exception $e) {
            Log::error('Tabby Failure Handler Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('home')->with('error', 'Payment failed. Please try again.');
        }
    }

    /**
     * Simulate successful Tabby transaction (for testing without credentials)
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function simulateSuccess(Request $request)
    {
        try {
            $finalData = session('full_order_data');

            if (!$finalData) {
                return redirect()->route('home')->with('error', 'Order session expired. Please start the booking again.');
            }

            $finalData['payment_method'] = 'tabby';
            $finalData['payment_status'] = 'paid';

            // Encode license files if array
            if (isset($finalData['license_files']) && is_array($finalData['license_files'])) {
                $finalData['license_files'] = json_encode($finalData['license_files']);
            }

            // Generate unique order ID
            $uniqueOrderId = $finalData['order_id'] ?? ('ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999));
            while (Order::where('order_id', $uniqueOrderId)->exists()) {
                $uniqueOrderId = 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999);
            }

            $order = Order::create(array_merge($finalData, [
                'payment_status' => 'paid',
                'payment_method' => 'tabby',
                'order_id' => $uniqueOrderId,
                'discount' => session('applied_coupon.discount') ?? 0,
                'coupon_code' => session('applied_coupon.code') ?? null,
            ]));

            if (!$order) {
                return redirect()->route('home')->with('error', 'Unable to save order.');
            }

            // Send confirmation emails
            try {
                Mail::to(config('mail.from.address', 'admin@example.com'))->send(new OrderPlacedAdmin($finalData));
                if (isset($finalData['email'])) {
                    Mail::to($finalData['email'])->send(new OrderPlacedUser($finalData));
                }
            } catch (\Exception $e) {
                Log::error('Tabby Simulate Success: Email sending failed', ['error' => $e->getMessage()]);
            }

            // Clear session data
            session()->forget(['order_data', 'booking_data', 'car_id', 'full_order_data', 'applied_coupon']);

            Log::info('Tabby Payment Simulated Success', ['order_id' => $uniqueOrderId]);

            return view('frontend.pages.thankyou', compact('order'))
                ->with('success', 'Your order has been placed successfully! (Simulated Tabby Payment)');
                
        } catch (\Exception $e) {
            Log::error('Tabby Simulate Success Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('home')->with('error', 'An error occurred while processing your payment.');
        }
    }
}

