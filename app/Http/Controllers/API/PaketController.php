<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\bioJemaah;
use App\Models\group;
use App\Models\jemaah;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    // GET: /api/allGroupPaket
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

        $group = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'paket' => $item->paket->nama,
                'jumlah_terdaftar' =>  $item->jemaah->count(),
                'tanggal_keberangkatan' => $item->tanggal_keberangkatan,
                'penerbangan' => $item->list_penerbangan ? $item->list_penerbangan[0]->maskapai : null,
                'durasi' => $item->paket->durasi,
                'kuota' => $item->paket->kuota,
                'jemaah_terdaftar' => $item->jemaah->count(),
                'harga' => $item->paket->harga,
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $group,
        ]);
    }

    // GET: /api/groupById/{id}
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

    // GET: /api/searchGroupByName/{name}
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

        $group = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'paket' => $item->paket->nama,
                'jumlah_terdaftar' =>  $item->jemaah->count(),
                'tanggal_keberangkatan' => $item->tanggal_keberangkatan,
                'penerbangan' => $item->list_penerbangan ? $item->list_penerbangan[0]->maskapai : null,
                'durasi' => $item->paket->durasi,
                'kuota' => $item->paket->kuota,
                'jemaah_terdaftar' => $item->jemaah->count(),
                'harga' => $item->paket->harga,
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $group,
        ]);
    }
    // GET: /api/allMyPaket
    public function allMyPaket(Request $request)
    {
        $user = $request->user();
        $dataBio = bioJemaah::where('id_akun', $user->id)->first();

        $data = $dataBio->jemaah->map(function ($item) {
            return [
                'id' => $item->group->id,
                'nama' => $item->group->nama,
                'paket' => $item->group->paket->nama,
                'jumlah_terdaftar' =>  $item->group->jemaah->count(),
                'tanggal_keberangkatan' => $item->group->tanggal_keberangkatan,
                'penerbangan' => $item->group->list_penerbangan ? $item->group->list_penerbangan[0]->maskapai : null,
                'durasi' => $item->group->paket->durasi,
                'kuota' => $item->group->paket->kuota,
                'jemaah_terdaftar' => $item->group->jemaah->count(),
                'harga' => $item->group->paket->harga,
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ]);
    }

    public function myPaket($id, Request $request)
    {
        $user = $request->user();
        $dataBio = bioJemaah::where('id_akun', $user->id)->first();
        $group = group::find($id);

        if (!$group) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => [],
            ], 404);
        }

        $data['group'] = [
            'id' => $group->id,
            'nama' => $group->nama,
            'paket' => $group->paket->nama,
            'jumlah_terdaftar' =>  $group->jemaah->count(),
            'tanggal_keberangkatan' => $group->tanggal_keberangkatan,
            'penerbangan' => $group->list_penerbangan ? $group->list_penerbangan[0]->maskapai : null,
            'durasi' => $group->paket->durasi,
            'kuota' => $group->paket->kuota,
            'jemaah_terdaftar' => $group->jemaah->count(),
            'harga' => $group->paket->harga,
        ];

        $jemaah = $group->jemaah->where('jemaah_id', $dataBio->id)->first();
        $rombongan = jemaah::where('id_rombongan', $jemaah->id_rombongan)->get();
        $data['jemaah'] = $rombongan->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->bioJemaah->nama_lengkap,
                'usia' => $item->usia,
                'jenis_kelamin' => $item->bioJemaah->jenis_kelamin,
                'terbayar' => $item->pembayaran->where('status', 'success')->sum('harga'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $data,
        ], 200);
    }
}
