<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function create()
    {
        $settings = WebsiteSetting::first();
        return view('admin.website.create', compact('settings'));
    }

 public function store(Request $request)
{
    $data = $request->validate([
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:1000',
        'schedule' => 'array',
        'schedule.*.from' => 'nullable|string',
        'schedule.*.to' => 'nullable|string',
    ]);

    $opening_schedule = [];

    foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day) {
        $opening_schedule[$day] = [
            'active' => isset($request->schedule[$day]['active']),
            'from' => $request->schedule[$day]['from'] ?? null,
            'to' => $request->schedule[$day]['to'] ?? null,
        ];
    }

    WebsiteSetting::updateOrCreate(
        ['id' => 1],
        [
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'opening_schedule' => $opening_schedule,
        ]
    );

    return redirect()->route('website.create')->with('success', 'Website settings saved!');
}

}
