<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    // Menampilkan halaman profil
    public function index()
    {
        $user = Auth::user();
        // return $user;
        return view('Admin.profile.index', compact('user'));
    }

    public function updateBiodata(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        return redirect()->back()->with('success', 'Biodata berhasil diperbarui.');
    }

    // Proses ganti email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Email berhasil diperbarui.');
    }

    // Proses ganti password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
}
