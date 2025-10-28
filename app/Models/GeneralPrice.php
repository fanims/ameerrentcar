<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralPrice extends Model
{
    protected $fillable = [
        'driver_price',
        'deposit_fee',
        'fuel_tank_fee',
        'extra_km_fee',
        'baby_seat_fee',
        'delivery_outside_fee',
        'tax',
    ];
}
