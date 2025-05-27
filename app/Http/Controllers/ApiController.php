<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'Hello World'
        ]);
    }

    public function unauthorized()
    {
        return response()->json([
            'message' => 'Unauthorized.'
        ], 401);
    }

    public function resetPassword($token,  Request $request)
    {
        $url = config('app.mobile_uri_scheme') . 'reset-password?token=' . $token . '&email=' . $request->email;

        return view('API.reset-password', [
            'token' => $token,
            'email' => $request->email,
            'url' => $url,
        ]);
    }
    /* 
     * ajwa://reset-password/{{ $token }} adalah custom URI scheme yang biasa digunakan 
     * agar link membuka aplikasi mobile (Android/iOS) langsung ke halaman tertentu 
     * di dalam aplikasi, bukan membuka browser.
     * ajwa:// adalah scheme kustom.
     * Bagian reset-password/{{ $token }} adalah path/route di dalam aplikasi mobile.
     * Aplikasi kamu harus dikonfigurasi agar mengenali dan menangani schema ajwa://.
     */
}
