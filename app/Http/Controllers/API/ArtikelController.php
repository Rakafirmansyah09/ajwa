<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\news;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    // GET /api/artikel
    public function list()
    {
        $data = news::where('status', 'publish')
            ->whereDate('tanggal_publish', '<=', now())
            ->orderBy('tanggal_publish', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List semua artikel',
            'data' => $data
        ]);
    }

    // GET /api/artikel/{id}
    public function show($id)
    {
        $artikel = news::find($id);

        if (!$artikel) {
            return response()->json([
                'status' => false,
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $artikel
        ]);
    }
}
