<?php

// app/Services/ZiinaService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZiinaService
{
public function createPaymentIntent(array $data)
{
    return Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.ziina.token'),
        'Content-Type' => 'application/json',
    ])->post(config('services.ziina.url'), [
        'amount' => intval($data['amount'] * 100),       // amount in fils (AED * 100)
        'currency_code' => 'AED',
        'message' => 'Car Booking - ' . $data['name'],
        'success_url' => $data['success_url'],
        'cancel_url' => $data['cancel_url'],
        'failure_url' => $data['failure_url'],
        'test' => true,
        'transaction_source' => 'directApi',
        'expiry' => (string) (now()->addMinutes(30)->timestamp * 1000),
        'allow_tips' => false,
    ])->json();
}

}
