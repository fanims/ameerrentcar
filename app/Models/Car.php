<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_type',
        'category_id',
        'name',
        'brand_id',
        'slug',
        'model_year',
        'base_price_per_hour',
        'current_price_per_hour',
        'base_price_per_day',
        'current_price_per_day',
        'base_price_per_week',
        'current_price_per_week',
        'base_price_per_month',
        'current_price_per_month',
        'persons_can_sit',
        'seats_available',
        'interior_colors',
        'exterior_colors',
        'thumbnail_image',
        'description',
        'short_description',
        'km_per_hour',
        'km_per_day',
        'km_per_week',
        'km_per_month',
        'number_of_bags',
        'gear',
        'fuel',
        'engine',
        'service_included',
        'doors',
    ];



    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'short_description' => 'array',
        'interior_colors' => 'array',
        'exterior_colors' => 'array',
    ];



    public function images()
    {
        return $this->hasMany(CarImage::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
