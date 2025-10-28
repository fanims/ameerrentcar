<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'image',
        'is_active',
        'created_by'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function car()
    {
        return $this->hasMany(Car::class);
    }


    public function cars()
    {
        return $this->hasMany(Car::class, 'brand');
    }
}
