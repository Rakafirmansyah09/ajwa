<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\NewAdminCredentials;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // List admin (kecuali diri sendiri)
    public function index()
    {
        $admins = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.admin.index', compact('admins'));
    }

    // Form tambah admin/super admin
    public function create()
    {

        return view('admin.admin.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,front_office',
        ]);

        // Generate random password
        $password = Str::random(8);

        $admin = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'admin_role'     => $request->role,
        ]);

        // Send email with password
        Mail::to($admin->email)->send(new NewAdminCredentials($admin, $password));

        return redirect()->route('admin.admin.list')->with('success', 'Admin berhasil ditambahkan dan password telah dikirim ke email.');
    }

    // Form edit
    public function edit($id)
    {
        $admin = User::findOrFail($id);

        return view('admin.admin.edit', compact('admin'));
    }

    // Update data
    public function update(Request $request)
    {

        $request->validate([
            'id'       => 'required|exists:users,id',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $request->id,
            'role'     => 'required|in:admin,front_office',
        ]);

        $admin = User::findOrFail($request->id);


        $admin->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'role' => 'admin',
            'admin_role'     => $request->role,
        ]);

        return redirect()->route('admin.admin.list')->with('success', 'Data admin diperbarui.');
    }

    // Hapus admin
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        $admin = User::findOrFail($request->id);

        // Batasi hanya super admin bisa mengubah ke super admin
        if (Auth::user()->admin_role !== 'super_admin') {
            return back()->withErrors(['role' => 'Hanya super admin yang bisa menghapus.']);
        }

        $admin->delete();

        return redirect()->route('admin.admin.list')->with('success', 'Admin berhasil dihapus.');
    }
}
