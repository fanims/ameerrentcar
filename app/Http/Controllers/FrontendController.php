<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarType;
use App\Models\Category;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        $cars = Car::with(['category', 'images'])->latest()->get();
        // foreach ($cars as $car) {
        //     try {
        //         /** ------------------------------
        //          *  Process Thumbnail
        //          * ------------------------------ */
        //         if ($car->thumbnail_image && Storage::disk('public')->exists($car->thumbnail_image)) {
        //             $newThumbPath = optimizeAndResize(
        //                 $car->thumbnail_image, // old stored path
        //                 'cars/thumbnails',
        //                 348,
        //                 261,
        //                 85
        //             );

        //             // Delete old thumbnail after successful resize
        //             Storage::disk('public')->delete($car->thumbnail_image);

        //             // Update thumbnail path
        //             $car->thumbnail_image = $newThumbPath;
        //         }

        //         /** ------------------------------
        //          *  Process Gallery Images
        //          * ------------------------------ */
        //         foreach ($car->images as $image) {
        //             if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
        //                 $newImagePath = optimizeAndResize(
        //                     $image->image_path,
        //                     'cars/images',
        //                     348,
        //                     261,
        //                     85
        //                 );

        //                 // Delete old image after successful resize
        //                 Storage::disk('public')->delete($image->image_path);

        //                 // Update the CarImage record
        //                 $image->image_path = $newImagePath;
        //                 $image->save();
        //             }
        //         }

        //         // Save updated car record
        //         $car->save();
        //     } catch (\Exception $e) {
        //         Log::error("Failed processing images for car ID {$car->id}: " . $e->getMessage());
        //         continue;
        //     }
        // }

        $categories = Category::with('cars')->latest()->get();
        $car_types = CarType::latest()->get();
        $reviews = $this->getGoogleReviews();
        // dd($reviews);

        return view('welcome', compact('brands', 'cars', 'categories', 'car_types', 'reviews'));
    }

      public function vehicles(Request $request)
    {

      
        $query = Car::query();

        // Filter by brand name
        $locale = app()->getLocale();
        $nameColumn = $locale === 'en' ? 'name_en' : 'name_ar';
        if ($request->filled('brand')) {
            $query->whereHas('brand', function ($q) use ($request, $nameColumn) {
                $q->where($nameColumn, 'LIKE', '%' . $request->brand . '%'); // flexible match
            });
        }

        // Filter by car_type
        if ($request->filled('car_type')) {
            $query->where('car_type', $request->car_type);
        }

        // Filter by price
        if ($request->filled('price')) {
            $query->where('current_price_per_week', $request->price);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('model_year', $request->year);
        }

        // Filter by category name
        if ($request->filled('category')) {
            $category = Category::where('name->' . App::getLocale(), 'LIKE', '%' . $request->category . '%')->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Price sort
        if ($request->filled('range')) {
            if ($request->range === 'LOW') {
                $query->orderBy('current_price_per_week', 'asc');
            } elseif ($request->range === 'HIGH') {
                $query->orderBy('current_price_per_week', 'desc');
            }
        }

        // Fetch filtered cars
        $cars = $query->get();

        // For AJAX requests
        if ($request->ajax()) {
            return response()->json($cars);
        }

        // Get data for filters (sidebar etc.)
        $brands = Brand::all();
        $car_types = CarType::all();
        $car_models = Car::select('model_year')->distinct()->get();
        $car_price = Car::select('current_price_per_week')->distinct()->get();
        $categories = Category::all();

        return view('frontend.pages.vehicle', compact(
            'cars',
            'brands',
            'car_types',
            'car_models',
            'car_price',
            'categories'
        ));
    }


    // public function thankYou()
    // {
    //     return view('frontend.pages.thankyou');
    // }

    public function vehicleByBrand($id, $name)
    {
        $cars = Car::where('brand_id', $id)->get();
        $brands = Brand::all();
        $car_types = CarType::latest()->get();
        $car_models = Car::select('model_year')->distinct()->get();
        $car_price = Car::select('current_price_per_week')->distinct()->get();
        $categories = Category::all();
        return view('frontend.pages.vehicle', compact('cars', 'name', 'brands', 'car_types', 'car_models', 'car_price', 'categories'));
    }


    public function search(Request $request)
    {
        $pickup = Carbon::parse($request->pickup_date . ' ' . $request->pickup_time);
        $dropoff = Carbon::parse($request->dropoff_date . ' ' . $request->dropoff_time);

        // Get car IDs that are unavailable due to overlapping orders in date/time & locations
        $unavailableCarIds = Order::where(function ($query) use ($pickup, $dropoff, $request) {
            $query->where(function ($q) use ($pickup, $dropoff) {
                $q->where('pickup_date', '<=', $dropoff->toDateString())
                    ->where('dropoff_date', '>=', $pickup->toDateString());
            });

            if ($request->pickup_location) {
                $query->where('delivery_location', 'like', '%' . $request->pickup_location . '%');
            }

            if ($request->dropoff_location) {
                $query->where('receiving_location', 'like', '%' . $request->dropoff_location . '%');
            }
        })->pluck('car_id');

        // Get available cars not in unavailable list
        $cars = Car::whereNotIn('id', $unavailableCarIds)->get();

        $brands = Brand::all();
        $car_types = Car::select('car_type')->distinct()->get();
        $car_models = Car::select('model_year')->distinct()->get();
        $car_price = Car::select('current_price_per_week')->distinct()->get();
        $categories = Category::all();

        return view('frontend.pages.vehicle', compact(
            'cars',
            'brands',
            'car_types',
            'car_models',
            'car_price',
            'categories'
        ));
    }



    public function about()
    {
        return view('frontend.pages.about');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function checkout($slug)
    {
        $car = Car::where('slug', $slug)->first();
        return view('frontend.pages.checkout', compact('car'));
    }

    public function checkoutForm($id)
    {
        $car = Car::with('images')->find($id);
        
        // If AJAX request, return only the modal content
        if (request()->ajax()) {
            return view('frontend.pages.checkoutform-modal', compact('car'));
        }
        
        return view('frontend.pages.checkoutform', compact('car'));
    }

    public function addToCart($id)
    {
        $car = Car::with(['images', 'category'])->find($id);

        // Maintain a simple session cart of car ids
        $cart = session()->get('cart', []);
        $cart[$id] = true; // use associative keys to avoid duplicates
        session()->put('cart', $cart);

        // Load all cars currently in the cart for rendering the page
        $cartCarIds = array_keys($cart);
        $cartCars = Car::with(['images', 'category'])->whereIn('id', $cartCarIds)->get();

        return view('frontend.pages.add-to-cart', [
            'car' => $car,        // keep for back button to last added car
            'cartCars' => $cartCars,
        ]);
    }

    public function bookingDetails($id)
    {
        $car = Car::with('images')->find($id);
        return view('frontend.pages.booking-details', compact('car'));
    }

    public function payment($id)
    {
        $car = Car::with('images')->find($id);
        return view('frontend.pages.payment', compact('car'));
    }

    public function addPayment()
    {
        return view('frontend.pages.add-payment');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.policy');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms-and-condition');
    }


    protected function getGoogleReviews(): array
    {
        $placeId = 'ChIJxTwW5aNdXz4R-FGHvkYvmQE';
        $apiKey = 'AIzaSyB7ZNZjYA0dBQRKvUdDGiMptZSYEbdlMgs';
        $locale = app()->getLocale();

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'fields' => 'name,rating,reviews,formatted_address',
                'language' => $locale,
                'key' => $apiKey
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['result']['reviews'])) {
                return $data['result']['reviews'];
            }
        } catch (\Exception $e) {
            Log::error('Google Reviews fetch error: ' . $e->getMessage());
        }

        return [];
    }
}
