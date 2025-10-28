<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralPrice;

class GeneralPriceController extends Controller
{
    public function edit()
    {
        $price = GeneralPrice::first(); // Only one row exists
        return view('admin.cars.general', compact('price'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'driver_price' => 'nullable|numeric|min:0',
            'deposit_fee' => 'nullable|numeric|min:0',
            'fuel_tank_fee' => 'nullable|numeric|min:0',
            'extra_km_fee' => 'nullable|numeric|min:0',
            'baby_seat_fee' => 'nullable|numeric|min:0',
            'delivery_outside_fee' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
        ]);

        $price = GeneralPrice::first();

        if (!$price) {
            $price = new GeneralPrice();
        }

        $price->fill($request->only([
            'driver_price',
            'deposit_fee',
            'fuel_tank_fee',
            'extra_km_fee',
            'baby_seat_fee',
            'delivery_outside_fee',
            'tax',
        ]))->save();

        return redirect()->back()->with('success', 'General pricing updated successfully.');
    }
}
