<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Order; // Assuming you have an Order model

class UserController extends Controller
{
    /**
     * Show user profile page with details and orders.
     */
    public function profile()
    {
        $user = auth()->user();

        // Load user orders (adjust relationship as needed)
        $orders = Order::where('user_id', $user->id)
            ->with('car') // eager load car relation if exists
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.pages.profile', compact('user', 'orders'));
    }

    /**
     * Update user profile details including license upload.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'license_files.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120', // max 5MB per file
        ]);

        $data = $request->only(['name', 'email', 'dob', 'phone']);

        if ($request->hasFile('license_files')) {
            $existing = json_decode($user->license, true) ?: [];

            foreach ($request->file('license_files') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('licenses', $filename, 'public');
                $existing[] = $path;
            }

            $data['license'] = json_encode($existing);
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Change user password.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password updated successfully.');
    }
}
