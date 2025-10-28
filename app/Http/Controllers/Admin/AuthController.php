<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\AuthService;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login()
    {
        return view('admin.auth.login');
    }

    public function storeLogin(Request $request)
    {
        try {
            $result =  $this->authService->adminLogin($request);
            if ($result) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }else{
                return back()->with(
                    'error',
                    'Invalid email or password',
                );
            }
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                $th->getMessage(),
            );
        }
    }


    public function profile($id)
    {
        $user = User::find($id);
        return view('admin.auth.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $this->authService->updateProfile($request, $user);
            return back()->with(
                'success',
                'Profile updated successfully',
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                $th->getMessage(),
            );
        }
    }


    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        try {
            $user = User::find($id);
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return back()->with(
                'success',
                'Password updated successfully',
            );
        } catch (\Throwable $th) {
            return back()->with(
                'error',
                $th->getMessage(),
            );
        }
    }

    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->route('admin.login');
    }
}
