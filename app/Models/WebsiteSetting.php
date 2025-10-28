<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $casts = [
        'opening_schedule' => 'array',
    ];

    protected $fillable = [
        'phone',
        'opening_schedule',
        'email',
        'address',
    ];
}
