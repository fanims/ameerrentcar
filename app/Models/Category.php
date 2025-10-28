<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_by',
        'is_active',
    ];


    protected $casts = [
        'name' => 'array',   // ✅ this is the fix
        'is_active' => 'boolean',
    ];


    public function getTranslatedName($limit = null)
    {
        $locale = app()->getLocale();
        $name = $this->name[$locale] ?? $this->name['en'] ?? '';
        return $limit ? Str::limit($name, $limit) : $name;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


public function cars()
{
    return $this->hasMany(Car::class);
}

}
