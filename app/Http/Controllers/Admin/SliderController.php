<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('creator')->latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('admin.slider.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
            'created_by' => 'required|exists:users,id',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'image' => $path,
            'link' => $request->link,
            'status' => $request->status,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $users = User::select('id', 'name')->get();
        return view('admin.slider.edit', compact('slider', 'users'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
            'created_by' => 'required|exists:users,id',
        ]);

        $data = [
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'link' => $request->link,
            'status' => $request->status,
            'created_by' => $request->created_by,
        ];

        if ($request->hasFile('image')) {
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully.');
    }
}
