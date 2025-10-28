<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Osama\TabbyIntegration\Facades\Tabby;


class TabbyService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tabby.secret_key');
        $this->apiUrl = 'https://api.tabby.ai/api/v2/checkout';
    }

    // public function createCheckout(array $finalData)
    // {
    //     // Prepare the items array
    //     $items = [
    //         [
    //             "title" => "Car Rental",
    //             "description" => "Booking ID: " . $finalData['order_id'],
    //             "quantity" => 1,
    //             "unit_price" => (string)number_format((float)$finalData['grand_total'], 2, '.', ''),
    //             "discount_amount" => "0.00",
    //             "reference_id" => "car_" . ($finalData['car_id'] ?? '0'),
    //             "image_url" => "https://example.com/",
    //             "product_url" => "https://example.com/",
    //             "gender" => "Unisex",
    //             "category" => "Car Rental",
    //             "color" => "black",
    //             "product_material" => "Metal",
    //             "size_type" => "Standard",
    //             "size" => "N/A",
    //             "brand" => "TabbyRentals",
    //             "is_refundable" => true
    //         ]
    //     ];

    //     // Prepare the main payload
    //     $body = [
    //         "payment" => [
    //             "amount" => (string)number_format((float)$finalData['grand_total'], 2, '.', ''),
    //             "currency" => "AED",
    //             "description" => "Car Rental - Order #" . $finalData['order_id'],

    //             "customer" => [
    //                 "phone" => $this->validateTabbyPhone($finalData['phone'] ?? null),
    //                 "email" => $this->getTabbyEmail($finalData['email'] ?? null),
    //                 "name" => $finalData['full_name'] ?? 'Guest User',
    //                 "dob" => "2000-01-20" // Adding DOB as it's often required
    //             ],
    //             "shipping_address" => [
    //                 "city" => $finalData['city'] ?? 'Dubai',
    //                 "address" => $finalData['address'] ?? 'Dubai',
    //                 "zip" => $finalData['zip'] ?? '00000',
    //             ],
    //             "order" => [
    //                 "tax_amount" => "0.00",
    //                 "shipping_amount" => "0.00",
    //                 "discount_amount" => "0.00",
    //                 "updated_at" => now()->toIso8601String(),
    //                 "reference_id" => $finalData['order_id'],
    //                 "items" => $items,

    //             ],
    //             "customer_history" => [
    //                 "registered_since" => "2022-01-01T00:00:00Z", // Using a fixed past date,
    //                 "loyalty_points" => 0,
    //                 "loyalty_level" => 0,
    //                 "wishlist_count" => 0,
    //                 "is_social_networks_connected" => false,
    //                 "is_phone_number_verified" => true,
    //                 "is_email_verified" => true,
    //                 "is_address_verified" => true,

    //             ],
    //         ],
    //         'phone' => $this->validateTabbyPhone($finalData['phone'] ?? null),
    //         "lang" => app()->getLocale(),
    //         "merchant_code" => "459000001725", // Your actual merchant code
    //         "merchant_urls" => [
    //             "success" => route('payment.success', ['gateway' => 'tabby']),
    //             "cancel" => route('payment.cancel', ['gateway' => 'tabby']),
    //             "failure" => route('payment.failure', ['gateway' => 'tabby']),
    //         ]
    //     ];

    //     try {
    //         Log::debug('Tabby API Request Payload:', $body);

    //         $response = Http::withHeaders([
    //             'Authorization' => "Bearer " . trim(env('TABBY_SECRET_KEY')),
    //             'Content-Type' => 'application/json',
    //             'Accept' => 'application/json'
    //         ])->post($this->apiUrl, $body);

    //         $result = $response->json();

    //         if (!$response->successful()) {
    //             throw new \Exception($result['message'] ?? 'API request failed');
    //         }

    //         return redirect($result['payment_url'] ?? $result['api_url']);
    //     } catch (\Exception $e) {
    //         Log::error('Tabby Checkout Error', [
    //             'message' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString(),
    //             'request' => $body
    //         ]);
    //         return back()->with('error', 'Payment processing error: ' . $e->getMessage());
    //     }
    // }


    public function createCheckout(array $finalData)
    {
        $orderId = $finalData['order_id'];

        $items = [[
            "title" => "Car Rental",
            "description" => "Booking ID: $orderId",
            "quantity" => 1,
            "unit_price" => number_format((float)$finalData['grand_total'], 2, '.', ''),
            "discount_amount" => "0.00",
            "reference_id" => "car_" . ($finalData['car_id'] ?? '0'),
            "image_url" => "https://example.com/",
            "product_url" => "https://example.com/",
            "gender" => "Unisex",
            "category" => "Car Rental",
            "color" => "black",
            "product_material" => "Metal",
            "size_type" => "Standard",
            "size" => "N/A",
            "brand" => "TabbyRentals",
            "is_refundable" => true
        ]];

        $body = [
            "payment" => [
                "amount" => number_format((float)$finalData['grand_total'], 2, '.', ''),
                "currency" => "AED",
                "description" => "Car Rental - Order #$orderId",
                "buyer" => [
                      "phone" => $this->validateTabbyPhone($finalData['phone'] ?? null),
                "email" => $this->getTabbyEmail($finalData['email'] ?? 'customer@example.com'),
                "name" => $finalData['full_name'] ?? 'Guest User',
                "dob" => "2000-01-20"
                ],

                "shipping_address" => [
                    "city" => $finalData['city'] ?? 'Dubai',
                    "address" => $finalData['address'] ?? 'Dubai',
                    "zip" => $finalData['zip'] ?? '00000',
                ],
                "order" => [
                    "tax_amount" => "0.00",
                    "shipping_amount" => "0.00",
                    "discount_amount" => "0.00",
                    "updated_at" => now()->toIso8601String(),
                    "reference_id" => $orderId,
                    "items" => $items
                ],
                "customer_history" => [
                    "registered_since" => "2022-01-01T00:00:00Z",
                    "loyalty_points" => 0,
                    "loyalty_level" => 0,
                    "wishlist_count" => 0,
                    "is_social_networks_connected" => false,
                    "is_phone_number_verified" => true,
                    "is_email_verified" => true,
                    "is_address_verified" => true
                ],
            ],
            "customer" => [
                "phone" => $this->validateTabbyPhone($finalData['phone'] ?? null),
                "email" => $this->getTabbyEmail($finalData['email'] ?? 'customer@example.com'),
                "name" => $finalData['full_name'] ?? 'Guest User',
                "dob" => "2000-01-20"
            ],
            "phone" => $this->validateTabbyPhone($finalData['phone'] ?? null),
            "lang" => app()->getLocale(),
            "merchant_code" => "459000001725",
            'is_test' => true,
            "merchant_urls" => [
                "success" => route('payment.success', ['gateway' => 'tabby']),
                "cancel" => route('payment.cancel', ['gateway' => 'tabby']),
                "failure" => route('payment.failure', ['gateway' => 'tabby']),
            ]
        ];
        // dd($body);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . trim(env('TABBY_SECRET_KEY')),
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);

        curl_close($ch);

        $result = json_decode($response, true);
        // dd($result);

        if ($httpCode !== 200 || isset($result['error'])) {
            Log::error('Tabby cURL Checkout Error', [
                'http_code' => $httpCode,
                'error' => $result['error'] ?? $curlError,
                'response' => $result,
                'request' => $body,
            ]);
            return back()->with('error', 'Tabby checkout failed: ' . ($result['error'] ?? 'Unknown error'));
        }

        return redirect($result['payment_url'] ?? $result['api_url'] ?? '/');
    }


    /**
     * Validate and format phone number for Tabby API
     */
    private function validateTabbyPhone(?string $phone): string
    {
        // Remove all non-digit characters
        // $cleaned = preg_replace('/[^0-9]/', '', $phone ?? '');

        // // Convert to proper UAE format
        // if (strlen($cleaned) === 9 && str_starts_with($cleaned, '0')) {
        //     return '+971' . substr($cleaned, 1);
        // } elseif (strlen($cleaned) === 12 && str_starts_with($cleaned, '971')) {
        //     return '+' . $cleaned;
        // } elseif (strlen($cleaned) === 10 && str_starts_with($cleaned, '5')) {
        //     return '+971' . $cleaned;
        // }

        // Default valid UAE number
        return '+971500000001';
    }

    /**
     * Get appropriate email address based on environment
     */
    private function getTabbyEmail(?string $email): string
    {
        // $isTestEnvironment = env('TABBY_ENV', 'sandbox') === 'sandbox';

        // if ($isTestEnvironment) {
        //     if (preg_match('/@tabby\.(ai|email)/i', $email ?? '')) {
        //         return $email;
        //     }
        //     return 'test@tabby.ai';
        // }

        return  'otp.success@tabby.ai';
    }
}
