<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::latest()->paginate(10);
        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:currencies,code',
            'symbol' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        Currency::create($validated);

        return redirect()->route('currencies.index')->with('success', 'Currency added successfully.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:currencies,code,' . $currency->id,
            'symbol' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $currency->update($validated);

        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully.');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully.');
    }
}
