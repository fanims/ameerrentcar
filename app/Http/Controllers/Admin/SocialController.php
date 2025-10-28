<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function index()
    {
        $socials = Social::all();
        return view('admin.social.index', compact('socials'));
    }

    public function create()
    {
        $socials = Social::all();
        return view('admin.social.create', compact('socials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'twitter' => 'nullable|url',
            'telegram' => 'nullable|url',
        ]);

        // Assumes only one row will exist in the socials table
        \App\Models\Social::updateOrCreate(
            ['id' => 1], // always targets the same row (you can customize this)
            $request->only(['facebook', 'instagram', 'whatsapp', 'twitter', 'telegram'])
        );

        $socials = Social::all();

        return view('admin.social.create', compact('socials'))->with('success', 'Social links saved!');
    }

}
