<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $orderCount = $user->orders()->count();
        $this->markAsRead($user);
        return view('admin.users.view', compact('user', 'orderCount'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only(['name', 'email', 'dob', 'phone']);

        // Handle License File Upload
        if ($request->hasFile('license_files')) {
            $paths = [];

            foreach ($request->file('license_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('license_uploads', $filename, 'public');
                $paths[] = $path;
            }

            $data['license'] = json_encode($paths); // Store as JSON
        }

        $user->update($data);

        return back()->with('success', 'User details updated successfully.');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'User status updated successfully.');
    }


    private function markAsRead($user)
    {
        $userId = $user->id;

        DB::table('users')
            ->where('id', $userId)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'is_active' => 'required|boolean',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'license_files.*' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        // Handle license file uploads
        $licensePaths = [];
        foreach ($request->file('license_files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('license_uploads', $filename, 'public');
            $licensePaths[] = $path;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'license' => !empty($licensePaths) ? json_encode($licensePaths) : null,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
}
