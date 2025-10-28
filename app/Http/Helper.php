<?php

use App\Models\Category;
use App\Models\Language;
use App\Models\Currency;
use App\Models\GeneralPrice;
use App\Models\Social;
use App\Models\WebsiteSetting;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
if (!function_exists('categories')) {
    function categories()
    {
        return Category::where('is_active', 1)->latest()->limit(5)->get();
    }
}

if (!function_exists('getLang')) {
    function getLang()
    {
        return Language::all();
    }
}

if (!function_exists('getCurrencySymbol')) {
    function getCurrencySymbol()
    {
        $locale = app()->getLocale();
        $currencyCode = $locale === 'ar' ? 'AED' : 'USD';

        $currency = Currency::where('code', $currencyCode)->where('is_active', 1)->first();
        return $currency ? $currency->code : 'AED';
    }
}

if (!function_exists('trans_field')) {
    function trans_field($field)
    {
        return $field[app()->getLocale()] ?? $field['en'] ?? '';
    }
}

if (!function_exists('get_socials')) {
    function get_socials()
    {
        $socials = Social::all();
        return $socials->toArray();
    }
}

if (!function_exists('getWebsiteSetting')) {
    function getWebsiteSetting()
    {
        $socials = WebsiteSetting::all();
        return $socials->toArray();
    }
}

if (!function_exists('get_general_prices')) {
    function get_general_prices()
    {
        return GeneralPrice::first();
    }
}




if (!function_exists('optimizeAndResize')) {
    function optimizeAndResize($image, $directory, $width = null, $height = null, $quality = 80)
    {
        $manager = new ImageManager(new Driver());

        // Check if $image is an UploadedFile
        if ($image instanceof \Illuminate\Http\UploadedFile) {
            // Move uploaded file to temporary storage for processing
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $newPath = "$directory/$filename";
            $newFullPath = storage_path("app/public/$newPath");

            // Ensure directory exists
            Storage::disk('public')->makeDirectory($directory);

            // Read and process the uploaded file
            $img = $manager->read($image->getRealPath());
        } else {
            // If it's already a storage path
            if (!Storage::disk('public')->exists($image)) {
                throw new \Exception("Image file not found: {$image}");
            }

            $extension = pathinfo($image, PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $extension;
            $newPath = "$directory/$filename";
            $newFullPath = storage_path("app/public/$newPath");

            $img = $manager->read(storage_path("app/public/$image"));
        }

        // Resize if dimensions provided
        if ($width || $height) {
            $img->cover($width, $height);
        }

        // Save optimized image
        $img->save($newFullPath, $quality);

        return $newPath;
    }
}
