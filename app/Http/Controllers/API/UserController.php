<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\bioJemaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();
        $bioJemaah = bioJemaah::where('id_akun', $user->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data profil',
            'data' => [
                'id' => $user->id,
                'email' => $user->email,
                'nama_lengkao' => $user->name,
                'nik' => $bioJemaah->nik,
                'tanggal_lahir' => $bioJemaah->tanggal_lahir,
                'jenis_kelamin' => $bioJemaah->jenis_kelamin,
                'tempat_lahir' => $bioJemaah->tempat_lahir,
                'file_ktp' => asset($bioJemaah->file_ktp),
                'file_paspor' => asset($bioJemaah->file_paspor),
            ],
        ]);
    }

    // Ganti password user
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah',
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah',
            'data' => null
        ], 200);
    }
}
