<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TabbyService
{
    protected $apiKey;
    protected $checkoutUrl;
    protected $baseUrl;
    protected $merchantCode;
    protected $isTestMode;

    public function __construct()
    {
        $this->apiKey = config('services.tabby.secret_key');
        $this->merchantCode = config('services.tabby.merchant_code');
        
        // Determine test mode: check TABBY_ENV first, then TABBY_TEST_MODE, default to true if no API key
        $env = config('services.tabby.env', 'test');
        $testModeConfig = config('services.tabby.test_mode');
        
        // If API key is missing or empty, force test mode
        if (empty($this->apiKey)) {
            $this->isTestMode = true;
        } else {
            // Use explicit test_mode config if set, otherwise use env
            $this->isTestMode = $testModeConfig !== null 
                ? (bool)$testModeConfig 
                : ($env === 'test');
        }
        
        // Use sandbox URL for testing, production URL when credentials are available
        $this->checkoutUrl = $this->isTestMode 
            ? config('services.tabby.sandbox_url', 'https://api.tabby.dev/api/v2/checkout')
            : config('services.tabby.production_url', 'https://api.tabby.ai/api/v2/checkout');
        
        // Base URL for payments API (different from checkout endpoint)
        $this->baseUrl = $this->isTestMode
            ? config('services.tabby.sandbox_base_url', 'https://api.tabby.dev/api/v2')
            : config('services.tabby.production_base_url', 'https://api.tabby.ai/api/v2');
    }
    
    /**
     * Check if Tabby is properly configured with API keys
     * 
     * @return bool
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->merchantCode);
    }
    
    /**
     * Get current mode (test or live)
     * 
     * @return string
     */
    public function getMode(): string
    {
        return $this->isTestMode ? 'test' : 'live';
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


    /**
     * Create a Tabby checkout session
     * 
     * @param array $finalData Order and customer data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCheckout(array $finalData)
    {
        // Validate API key exists
        if (!$this->isConfigured()) {
            Log::warning('Tabby API key not configured', [
                'has_api_key' => !empty($this->apiKey),
                'has_merchant_code' => !empty($this->merchantCode),
                'test_mode' => $this->isTestMode
            ]);
            return back()->with('error', 'Tabby payment gateway is not configured. Please contact support.');
        }

        $orderId = $finalData['order_id'] ?? 'ORD-' . now()->format('YmdHis');
        
        // Build order items
        $items = $this->buildOrderItems($finalData, $orderId);
        
        // Build payment payload
        $body = $this->buildPaymentPayload($finalData, $orderId, $items);

        try {
            Log::info('Tabby API Request', [
                'url' => $this->checkoutUrl,
                'merchant_code' => $this->merchantCode,
                'is_test_mode' => $this->isTestMode
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . trim($this->apiKey),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->post($this->checkoutUrl, $body);

            $result = $response->json();

            if (!$response->successful()) {
                Log::error('Tabby API Error', [
                    'status' => $response->status(),
                    'response' => $result,
                    'request_body' => $body
                ]);
                
                return back()->with('error', 
                    'Tabby payment initialization failed: ' . 
                    ($result['message'] ?? $result['error'] ?? 'Unknown error')
                );
            }

            // Extract payment URL from response
            $paymentUrl = $result['payment_url'] ?? $result['api_url'] ?? null;
            
            if (!$paymentUrl) {
                Log::error('Tabby Payment URL Missing', ['response' => $result]);
                return back()->with('error', 'Unable to retrieve payment URL from Tabby.');
            }

            Log::info('Tabby Checkout Created', ['payment_url' => $paymentUrl]);
            
            return redirect($paymentUrl);
            
        } catch (\Exception $e) {
            Log::error('Tabby Checkout Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $body
            ]);
            
            return back()->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    /**
     * Build order items array for Tabby API
     */
    private function buildOrderItems(array $finalData, string $orderId): array
    {
        $carImage = isset($finalData['car_id']) 
            ? optional(\App\Models\Car::find($finalData['car_id']))->thumbnail_image 
            : null;

        return [
            [
                "title" => "Car Rental",
                "description" => "Booking ID: $orderId",
                "quantity" => 1,
                "unit_price" => number_format((float)($finalData['grand_total'] ?? 0), 2, '.', ''),
                "discount_amount" => number_format((float)($finalData['discount'] ?? 0), 2, '.', ''),
                "reference_id" => "car_" . ($finalData['car_id'] ?? '0'),
                "image_url" => $carImage ? url('storage/' . $carImage) : config('services.tabby.default_image_url', 'https://example.com/car.jpg'),
                "product_url" => isset($finalData['car_id']) 
                    ? route('vehicle', ['id' => $finalData['car_id']]) 
                    : url('/'),
                "category" => "Car Rental",
                "is_refundable" => true
            ]
        ];
    }

    /**
     * Build complete payment payload for Tabby API
     */
    private function buildPaymentPayload(array $finalData, string $orderId, array $items): array
    {
        $phone = $this->validateTabbyPhone($finalData['phone'] ?? null);
        $email = $this->getTabbyEmail($finalData['email'] ?? null);
        $name = $finalData['full_name'] ?? 'Guest User';
        $dob = isset($finalData['date_of_birth']) 
            ? date('Y-m-d', strtotime($finalData['date_of_birth']))
            : '2000-01-20';

        return [
            "payment" => [
                "amount" => number_format((float)($finalData['grand_total'] ?? 0), 2, '.', ''),
                "currency" => config('services.tabby.currency', 'AED'),
                "description" => "Car Rental - Order #$orderId",
                "buyer" => [
                    "phone" => $phone,
                    "email" => $email,
                    "name" => $name,
                    "dob" => $dob
                ],
                "shipping_address" => [
                    "city" => $finalData['city'] ?? $finalData['billing_city'] ?? 'Dubai',
                    "address" => $finalData['address'] ?? $finalData['billing_address'] ?? $finalData['delivery_location'] ?? 'Dubai',
                    "zip" => $finalData['zip'] ?? $finalData['billing_zip'] ?? '00000',
                ],
                "order" => [
                    "tax_amount" => number_format((float)($finalData['tax_amount'] ?? 0), 2, '.', ''),
                    "shipping_amount" => "0.00",
                    "discount_amount" => number_format((float)($finalData['discount'] ?? 0), 2, '.', ''),
                    "updated_at" => now()->toIso8601String(),
                    "reference_id" => $orderId,
                    "items" => $items
                ],
                "customer_history" => [
                    "registered_since" => auth()->check() && auth()->user()->created_at 
                        ? auth()->user()->created_at->toIso8601String()
                        : now()->subYears(2)->toIso8601String(),
                    "loyalty_points" => 0,
                    "loyalty_level" => 0,
                    "wishlist_count" => 0,
                    "is_social_networks_connected" => false,
                    "is_phone_number_verified" => true,
                    "is_email_verified" => true,
                    "is_address_verified" => true
                ],
            ],
            "lang" => app()->getLocale(),
            "merchant_code" => $this->merchantCode,
            "merchant_urls" => [
                "success" => route('tabby.payment.success'),
                "cancel" => route('tabby.payment.cancel'),
                "failure" => route('tabby.payment.failure'),
            ]
        ];
    }


    /**
     * Validate and format phone number for Tabby API
     * 
     * @param string|null $phone
     * @return string
     */
    private function validateTabbyPhone(?string $phone): string
    {
        if (empty($phone)) {
            // Use test phone number in test mode
            return $this->isTestMode ? '+971500000001' : '+971500000000';
        }

        // Remove all non-digit characters
        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        // Convert to proper UAE format
        if (strlen($cleaned) === 9 && str_starts_with($cleaned, '0')) {
            return '+971' . substr($cleaned, 1);
        } elseif (strlen($cleaned) === 12 && str_starts_with($cleaned, '971')) {
            return '+' . $cleaned;
        } elseif (strlen($cleaned) === 10 && str_starts_with($cleaned, '5')) {
            return '+971' . $cleaned;
        } elseif (strlen($cleaned) === 9) {
            return '+971' . $cleaned;
        } elseif (str_starts_with($phone, '+971')) {
            return $phone;
        }

        // Default valid UAE number format
        return '+971' . substr($cleaned, -9);
    }

    /**
     * Get appropriate email address based on environment
     * Tabby test mode requires specific test email formats
     * 
     * @param string|null $email
     * @return string
     */
    private function getTabbyEmail(?string $email): string
    {
        if ($this->isTestMode) {
            // In test mode, use Tabby test email if provided, otherwise default test email
            if (!empty($email) && preg_match('/@tabby\.(ai|email)/i', $email)) {
                return $email;
            }
            // Use Tabby test email for successful OTP
            return config('services.tabby.test_email', 'otp.success@tabby.ai');
        }

        // In production, use actual customer email
        return $email ?? config('services.tabby.default_email', 'customer@example.com');
    }

    /**
     * Verify payment webhook signature using HMAC-SHA256
     * 
     * Tabby sends webhook signatures in the X-Tabby-Signature header.
     * The signature is computed as HMAC-SHA256 of the raw request body.
     * 
     * @param array|string $payload Raw request body or parsed array
     * @param string $signature Signature from X-Tabby-Signature header
     * @return bool
     */
    public function verifyWebhookSignature($payload, string $signature): bool
    {
        if (empty($signature) || empty($this->apiKey)) {
            Log::warning('Tabby Webhook: Missing signature or API key', [
                'has_signature' => !empty($signature),
                'has_api_key' => !empty($this->apiKey)
            ]);
            return false;
        }

        // If payload is already an array, convert to JSON string
        // Tabby signs the raw JSON body, not the parsed array
        if (is_array($payload)) {
            $payloadString = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } else {
            $payloadString = $payload;
        }

        // Create expected signature using HMAC-SHA256
        // Tabby uses the secret key (not public key) for webhook verification
        $expectedSignature = hash_hmac('sha256', $payloadString, $this->apiKey);

        // Compare signatures (timing-safe comparison)
        $isValid = hash_equals($expectedSignature, $signature);

        if (!$isValid) {
            Log::warning('Tabby Webhook: Invalid signature', [
                'expected_prefix' => substr($expectedSignature, 0, 20) . '...',
                'received_prefix' => substr($signature, 0, 20) . '...',
                'payload_length' => strlen($payloadString)
            ]);
        } else {
            Log::info('Tabby Webhook: Signature verified successfully');
        }

        return $isValid;
    }

    /**
     * Get payment status from Tabby
     * Uses the correct payments endpoint, not checkout endpoint
     * 
     * @param string $paymentId
     * @return array|null
     */
    public function getPaymentStatus(string $paymentId): ?array
    {
        if (empty($this->apiKey)) {
            return null;
        }

        try {
            // Use payments endpoint, not checkout endpoint
            $paymentsUrl = $this->baseUrl . '/payments/' . $paymentId;
            
            Log::info('Tabby Get Payment Status', [
                'payment_id' => $paymentId,
                'url' => $paymentsUrl
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . trim($this->apiKey),
                'Accept' => 'application/json'
            ])->get($paymentsUrl);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('Tabby Get Payment Status Failed', [
                'payment_id' => $paymentId,
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Tabby Get Payment Status Error', [
                'payment_id' => $paymentId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}
