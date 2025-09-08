<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\bioJemaah;
use App\Models\jemaah;
use Illuminate\Http\Request;

class jemaahController extends Controller
{
    // GET: /api/jemaahById/{id}
    public function jemaahById($id)
    {
        $jemaah = jemaah::find($id);
        $data = [
            'id' => $jemaah->id,
            'nama' => $jemaah->bioJemaah->nama_lengkap,
            'paket' => $jemaah->group->paket->nama,
            'group' => $jemaah->group->nama,
            'berangkat' => $jemaah->group->tanggal_keberangkatan,
            'harga' => $jemaah->group->paket->harga,
            'terbayar' => $jemaah->pembayaran->sum('harga'),
        ];
        return $data;
    }
}
