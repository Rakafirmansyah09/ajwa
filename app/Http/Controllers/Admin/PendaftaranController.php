<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\group;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $group = group::whereDate('tanggal_keberangkatan', '>=', Carbon::today())->get();

        return view('Admin.Pendaftaran.index', [
            'group' => $group
        ]);
    }

    public function listJemaah($id)
    {
        $group = group::find($id);

        // return $group->jemaah[0]->bioJemaah;
        $paket = $group->paket;
        return view('Admin.Pendaftaran.listJemaah', [
            'group' => $group,
            'paket' => $paket,
        ]);
    }
}
