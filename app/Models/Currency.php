<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'code', 'symbol', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
