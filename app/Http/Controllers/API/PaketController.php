<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\group;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function allGroup()
    {
        $data = group::with('paket')->get();
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => [],
            ]);
        }

        $data->map(function ($item) {
            $item->jumlahTerdaftar = $item->jemaah->count();
        });
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
    }

    public function groupById($id)
    {
        $data = group::with('paket', 'jemaah.bioJemaah')->where('id', $id)->first();
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => [],
            ]);
        }

        $data->jumlahTerdaftar = $data->jemaah->count();
        $data->jemaah->map(function ($item) {
            $totalBayar = $item->pembayaran->sum('harga');

            $namaLengkap = $item->bioJemaah->nama_lengkap;
            $item->nama_lengkap = $namaLengkap;
            $item->total_pembayaran = $totalBayar;

            unset(
                $item->bioJemaah,
                $item->pembayaran,
                $item->created_at,
                $item->updated_at,
                $item->id_bio,
                $item->jemaah_id,
                $item->group_id,
                $item->no_hp,
                $item->alamat,
                $item->tanggal_pembatalan,
                $item->alasan_pembatalan,
                $item->sumber_info,
                $item->detail_info,
                $item->pembatalan,
            );
        });
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
    }

    public function searchGroupByName($name)
    {
        $data = group::with('paket')->where('nama', 'like', '%' . $name . '%')->get();
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => [],
            ]);
        }

        $data->map(function ($item) {
            $item->jumlahTerdaftar = $item->jemaah->count();
        });
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
    }
}
