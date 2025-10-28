<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'is_active',
        'expires_at'
    ];

    public function isValid()
    {
        return $this->is_active &&
            ($this->expires_at === null || $this->expires_at >= now()) &&
            ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function applyDiscount($amount)
    {
        return $this->type === 'fixed'
            ? max(0, $amount - $this->value)
            : max(0, $amount - ($amount * $this->value / 100));
    }
}
