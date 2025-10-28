<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CarController extends Controller
{


    public function index()
    {
        $cars  = Car::with('images')->latest()->get();
        return view('admin.cars.index', compact('cars'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $types = CarType::all();
        return view('admin.cars.create', compact('categories', 'brands', 'types'));
    }

    public function store(Request $request, $id = null)
    {
        $rules = [
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'short_description.en' => 'required|string',
            'short_description.ar' => 'required|string',

            'brand_id' => 'required|string',
            'car_type' => 'required|string',
            'category_id' => 'required|string',
            'model_year' => 'required',

            'base_price_per_hour' => 'required',
            'current_price_per_hour' => 'required',
            'base_price_per_day' => 'required',
            'current_price_per_day' => 'required',
            'base_price_per_week' => 'required',
            'current_price_per_week' => 'required',
            'base_price_per_month' => 'required',
            'current_price_per_month' => 'required',

            'km_per_hour' => 'required',
            'km_per_day' => 'required',
            'km_per_week' => 'required',
            'km_per_month' => 'required',
            'number_of_bags' => 'nullable|integer',
            'gear' => 'nullable|string|in:Manual,Automatic',

            'persons_can_sit' => 'required|integer',
            'seats_available' => 'required|integer',
            'interior_colors' => 'nullable|string',
            'exterior_colors' => 'nullable|string',

            'thumbnail' => ($id ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,webp',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,webp|nullable',
            'fuel' => 'nullable',
            'engine' => 'nullable',
            'service_included' => 'nullable',
            'doors' => 'nullable',
        ];

        $request->validate($rules);

        // If update, find the car or create a new one
        $car = $id ? Car::findOrFail($id) : new Car();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if updating
            if ($id && $car->thumbnail_image && Storage::disk('public')->exists($car->thumbnail_image)) {
                Storage::disk('public')->delete($car->thumbnail_image);
            }

            $car->thumbnail_image = optimizeAndResize(
                $request->file('thumbnail'),
                'cars/thumbnails',
                780,
                480,
                85
            );
        }

        // Prepare car data
        $car->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),

            'brand_id' => $request->brand_id,
            'car_type' => $request->car_type,
            'category_id' => $request->category_id,
            'model_year' => $request->model_year,

            'base_price_per_hour' => $request->base_price_per_hour,
            'current_price_per_hour' => $request->current_price_per_hour,
            'base_price_per_day' => $request->base_price_per_day,
            'current_price_per_day' => $request->current_price_per_day,
            'base_price_per_week' => $request->base_price_per_week,
            'current_price_per_week' => $request->current_price_per_week,
            'base_price_per_month' => $request->base_price_per_month,
            'current_price_per_month' => $request->current_price_per_month,

            'km_per_hour' => $request->km_per_hour,
            'km_per_day' => $request->km_per_day,
            'km_per_week' => $request->km_per_week,
            'km_per_month' => $request->km_per_month,
            'number_of_bags' => $request->number_of_bags,
            'gear' => $request->gear,

            'persons_can_sit' => $request->persons_can_sit,
            'seats_available' => $request->seats_available,
            'interior_colors' => $request->interior_colors ? json_encode(array_map('trim', explode(',', $request->interior_colors))) : null,
            'exterior_colors' => $request->exterior_colors ? json_encode(array_map('trim', explode(',', $request->exterior_colors))) : null,

            'slug' => str_replace(' ', '-', strtolower($request->input('name.en'))),
            'fuel' => $request->fuel,
            'engine' => $request->engine,
            'service_included' => $request->service_included,
            'doors' => $request->doors,
        ]);

        $car->save();

        // Handle other images
        if ($request->hasFile('other_images')) {
            if ($id) {
                // Optionally, delete old images if updating
                foreach ($car->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }
            }

            foreach ($request->file('other_images') as $image) {
                $path = optimizeAndResize($image, 'cars/images', 780, 480, 85);

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', $id ? 'Car updated successfully.' : 'Car added successfully.');
    }


    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }


    public function edit($id)
    {
        $car = Car::with('images')->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $types = CarType::all();
        return view('admin.cars.edit', compact('car', 'categories', 'brands', 'types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'short_description.en' => 'required|string',
            'short_description.ar' => 'required|string',

            'brand_id' => 'required|string',
            'car_type' => 'required|string',
            'category_id' => 'required|string',
            'model_year' => 'required',

            'base_price_per_hour' => 'required',
            'current_price_per_hour' => 'required',
            'base_price_per_day' => 'required',
            'current_price_per_day' => 'required',
            'base_price_per_week' => 'required',
            'current_price_per_week' => 'required',
            'base_price_per_month' => 'required',
            'current_price_per_month' => 'required',

            'km_per_hour' => 'required',
            'km_per_day' => 'required',
            'km_per_week' => 'required',
            'km_per_month' => 'required',
            'number_of_bags' => 'nullable|integer',
            'gear' => 'nullable|string|in:Manual,Automatic',

            'persons_can_sit' => 'required|integer',
            'seats_available' => 'required|integer',
            'interior_colors' => 'nullable|string',
            'exterior_colors' => 'nullable|string',

            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'other_images.*' => 'image|mimes:jpeg,png,jpg,webp|nullable',
            'fuel' => 'nullable',
            'engine' => 'nullable',
            'service_included' => 'nullable',
            'doors' => 'nullable',
        ]);

        $car = Car::findOrFail($id);

        /** ------------------------------
         *  Handle Thumbnail Update
         * ------------------------------ */
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($car->thumbnail_image && Storage::disk('public')->exists($car->thumbnail_image)) {
                Storage::disk('public')->delete($car->thumbnail_image);
            }

            // Process and save new thumbnail
            $car->thumbnail_image = optimizeAndResize(
                $request->file('thumbnail'),
                'cars/thumbnails',
                780,
                480,
                85
            );
        }

        /** ------------------------------
         *  Update Car Data
         * ------------------------------ */
        $car->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),

            'brand_id' => $request->brand_id,
            'car_type' => $request->car_type,
            'category_id' => $request->category_id,
            'model_year' => $request->model_year,

            'base_price_per_hour' => $request->base_price_per_hour,
            'current_price_per_hour' => $request->current_price_per_hour,
            'base_price_per_day' => $request->base_price_per_day,
            'current_price_per_day' => $request->current_price_per_day,
            'base_price_per_week' => $request->base_price_per_week,
            'current_price_per_week' => $request->current_price_per_week,
            'base_price_per_month' => $request->base_price_per_month,
            'current_price_per_month' => $request->current_price_per_month,

            'km_per_hour' => $request->km_per_hour,
            'km_per_day' => $request->km_per_day,
            'km_per_week' => $request->km_per_week,
            'km_per_month' => $request->km_per_month,
            'number_of_bags' => $request->number_of_bags,
            'gear' => $request->gear,

            'persons_can_sit' => $request->persons_can_sit,
            'seats_available' => $request->seats_available,
            'interior_colors' => $request->interior_colors ? json_encode(array_map('trim', explode(',', $request->interior_colors))) : null,
            'exterior_colors' => $request->exterior_colors ? json_encode(array_map('trim', explode(',', $request->exterior_colors))) : null,
            'slug' => str_replace(' ', '-', strtolower($request->input('name.en'))),
            'fuel' => $request->fuel,
            'engine' => $request->engine,
            'service_included' => $request->service_included,
            'doors' => $request->doors,
        ]);

        /** ------------------------------
         *  Handle Other Images Update
         * ------------------------------ */
        if ($request->hasFile('other_images')) {
            // Delete old images if replacing
            foreach ($car->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
                $oldImage->delete();
            }

            // Upload new images
            foreach ($request->file('other_images') as $image) {
                $path = optimizeAndResize($image, 'cars/images', 780, 480, 85);

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        foreach ($car->images as $image) {
            if (Storage::exists($image->image_path)) {
                Storage::delete($image->image_path);
            }
            $image->delete();
        }

        if ($car->thumbnail && Storage::exists($car->thumbnail)) {
            Storage::delete($car->thumbnail);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }


    public function imageDestroy($id)
    {
        $image = CarImage::findOrFail($id);

        if (Storage::exists($image->image_path)) {
            Storage::delete($image->image_path);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
