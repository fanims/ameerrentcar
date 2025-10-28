<?php

// app/Services/AuthService.php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{


    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        return Auth::attempt($credentials) && auth()->user()->hasRole('admin');
    }


    public function updateProfile($request, $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return $user->load('profile');
    }
}
