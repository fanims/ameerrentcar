<?php

// app/Services/AuthService.php

namespace App\Services\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function index()
    {
        return Brand::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:brands,name_en|max:255',
            'name_ar' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'required',
            'created_by' => 'required',
        ]);


        try {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->file('image')->storeAs('brands', $imageName, 'public');
            $fullPath = asset('storage/' . $path);

            return Brand::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'image' => $fullPath,
                'is_active' => $request->is_active,
                'created_by' => $request->created_by
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Failed to create brand. " . $e->getMessage());
        }
    }


    public function find($id)
    {
        return Brand::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|max:255|unique:brands,name_en,' . $id,
            'name_ar' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'required',
            'created_by' => 'required',
        ]);


        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $path = $request->file('image')->storeAs('brands', $imageName, 'public');
            $fullPath = asset('storage/' . $path);
            $brand->image = $fullPath;
        }

        $brand->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by,
            'image' => $brand->image,
        ]);


        return $brand;
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image) {
            $parsedUrl = parse_url($brand->image, PHP_URL_PATH); // /storage/srktalents/filename.png
            $relativePath = str_replace('/storage/', '', $parsedUrl); // srktalents/filename.png

            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }
        $brand->delete();

        return true;
    }
}
