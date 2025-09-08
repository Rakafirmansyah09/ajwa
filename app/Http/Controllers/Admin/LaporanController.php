<?php

namespace App\Http\Controllers\admin;

use App\Exports\JemaahExport;
use App\Http\Controllers\Controller;
use App\Models\group;
use App\Models\jemaah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $group = group::with('paket')->get();

        if ($request->group_id) {
            $jemaah = jemaah::where('group_id', $request->group_id)->where('pembatalan', false)->get();
            // return $jemaah;
        } else {
            $jemaah = null;
        }

        return view('Admin.laporan.index', [
            'pageTitle' => 'Laporan',
            'groups' => $group,
            'jemaah' => $jemaah
        ]);
    }

    public function download() {}
    public function downloadExcel($id)
    {
        return Excel::download(new JemaahExport($id), 'laporan_jemaah.xlsx');
    }
}
