<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    protected $fillable = ['title', 'image', 'link', 'status', 'created_by'];

    protected $casts = [
        'title' => 'array',
        'status' => 'boolean',
    ];

    // app/Models/Slider.php

    public function getTranslatedTitle($limit = null)
    {
        $locale = app()->getLocale(); // Get current app locale ('en' or 'ar')
        $title = $this->title[$locale] ?? '';

        if ($limit) {
            return Str::limit($title, $limit);
        }

        return $title;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
