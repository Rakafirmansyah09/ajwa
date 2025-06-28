<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\group;
use App\Models\jemaah;
use App\Models\paket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {

        Log::info('Dashboard User');

        // pendafataran
        $data1 = jemaah::count();
        // keberangakatan
        $data2 = group::count();
        // total paket
        $data3 = paket::count();
        // pembatalan
        $data4 = jemaah::where('pembatalan', true)->count();
        // notifikasi
        $data5 = $this->getnotive();
        // kebrangkatan per bulan
        $data6 = $this->getKeberangkatanPerBulan();
        // data jemaah per paket
        $data7 = $this->getJemaahPaket();

        // return $data7;

        return view('Admin.Dashboard.index', [
            'pageTitle' => 'Dashboard',
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
            'data7' => $data7,
        ]);
    }

    private function getnotive()
    {
        $jemaah = jemaah::with([
            'group.paket', // untuk ambil harga dari paket
            'pembayaran' => function ($query) {
                $query->where('status', 'success');
            }
        ])
            ->whereHas('group', function ($query) {
                $query->whereDate('tanggal_keberangkatan', '>=', Carbon::now())
                    ->whereDate('tanggal_keberangkatan', '<=', Carbon::now()->addDays(50));
            })
            ->get()
            ->map(function ($j) {
                return [
                    'nama' => $j->BioJemaah->nama_lengkap,
                    'group_id' => $j->group_id,
                    'nama_group' => $j->group->nama,
                    'nama_paket' => $j->group->paket->nama,
                    'tanggal_keberangkatan' => $j->group->tanggal_keberangkatan ?? null,
                    'harga_paket' => $j->group->paket->harga ?? 0,
                    'total_pembayaran_sukses' => $j->pembayaran->sum('harga'),
                ];
            });

        $message = [];

        foreach ($jemaah as $j) {
            if ($j['total_pembayaran_sukses'] < $j['harga_paket']) {
                $message[] = "Jamaah atas nama {$j['nama']} belum melunasi pembayaran";
            }
        }

        return $message;
    }

    public function getKeberangkatanPerBulan()
    {
        $keberangkatanPerBulan = jemaah::selectRaw('COUNT(*) as total, MONTH(group.tanggal_keberangkatan) as bulan')
            ->join('group', 'pendaftaran.group_id', '=', 'group.id')
            ->groupBy('bulan')
            ->get();

        return $keberangkatanPerBulan;
    }

    public function getJemaahPaket()
    {
        $paket = Paket::with(['group.jemaah.BioJemaah', 'group.jemaah.pembayaran'])
            ->whereHas('group', function ($query) {
                $query->whereDate('tanggal_keberangkatan', '>=', Carbon::now());
                // ->whereDate('tanggal_keberangkatan', '<=', Carbon::now()->addDays(60))
            })
            ->get();

        $data = [];
        foreach ($paket as $p) {
            $jemaahLunas = 0;
            $jemaahBelumLunas = 0;

            foreach ($p->group as $group) {
                foreach ($group->jemaah as $j) {
                    $totalPembayaran = $j->pembayaran->sum('harga');

                    if ($totalPembayaran >= $p->harga) {
                        $jemaahLunas++;
                    } else {
                        $jemaahBelumLunas++;
                    }
                }
            }

            $data[] = [
                'id' => $p->id,
                'nama_paket' => $p->nama,
                'jemaah_lunas' => $jemaahLunas,
                'jemaah_belum_lunas' => $jemaahBelumLunas
            ];
        }

        return $data;
    }
}
