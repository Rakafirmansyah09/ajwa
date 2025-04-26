<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\group;
use App\Models\paket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        // cari paket yang paket->group->tanggal_keberangkatan >= now()
        $paket = paket::whereHas('group', function ($query) {
            $query->where('tanggal_keberangkatan', '>=', Carbon::now());
        })->get();

        return view('Admin.Pendaftaran.index', [
            'pageTitle' => 'Pendaftaran paket',
            'paket' => $paket
        ]);
    }

    public function listJemaah($id)
    {
        $group = group::find($id);

        // return $group->jemaah[0]->bioJemaah;
        $paket = $group->paket;
        return view('Admin.Pendaftaran.listJemaah', [
            'pageTitle' => 'List Jemaah ' . $paket->nama . ' - ' . $group->nama,
            'group' => $group,
            'paket' => $paket,
        ]);
    }
}
