<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Admin.Auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            Auth::login(Auth::user());
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Login berhasil');
        }
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak sesuai.',
        ]);
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Logout successful');
        }
        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {
        return view('Admin.Auth.forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        return $request;
    }

    public function resetPassword($token)
    {
        return view('Admin.Auth.resetPassword', [
            'token' => $token,
            'email' => 'halo@gmail.com',
        ]);
    }

    public function resetPasswordPost(Request $request)
    {
        return $request;
    }
}
