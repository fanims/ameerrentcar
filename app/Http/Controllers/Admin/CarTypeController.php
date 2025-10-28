<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    public function index()
    {
        $carTypes = CarType::all();
        return view('admin.car_types.index', compact('carTypes'));
    }

    public function create()
    {
        return view('admin.car_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        CarType::create($request->only('name_en', 'name_ar'));

        return redirect()->route('car-types.index')->with('success', 'Car type created.');
    }

    public function edit(CarType $carType)
    {
        return view('admin.car_types.edit', compact('carType'));
    }

    public function update(Request $request, CarType $carType)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $carType->update($request->only('name_en', 'name_ar'));

        return redirect()->route('car-types.index')->with('success', 'Car type updated.');
    }

    public function destroy(CarType $carType)
    {
        $carType->delete();
        return redirect()->route('car-types.index')->with('success', 'Car type deleted.');
    }
}
