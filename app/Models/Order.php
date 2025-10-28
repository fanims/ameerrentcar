<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'pickup_date',
        'pickup_time',
        'dropoff_date',
        'dropoff_time',
        'grand_total',
        'full_name',
        'email',
        'phone',
        'whatsapp',
        'date_of_birth',
        'nationality',
        'delivery_location',
        'receiving_location',
        'has_international_license',
        'special_request',
        // 'card_holder_name',
        // 'card_number',
        // 'expiry_date',
        // 'security_code',
        'billing_country',
        'billing_state',
        'billing_city',
        'billing_zip',
        'billing_address',
        'car_id',
        'user_id',
        'status',
        'payment_status',
        'license_files',
        'order_id',
        'is_read',
        'discount',
        'coupon_code',
                'payment_method',

    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
