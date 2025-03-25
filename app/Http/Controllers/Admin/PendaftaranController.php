<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\jemaah;
use App\Models\kategori;
use App\Models\pendaftaran;
use Illuminate\Http\Request;

use function App\Providers\admin_abort;

class PendaftaranController extends Controller
{
    public $upload;

    public function __construct(UploadFileController $upload)
    {
        $this->upload = $upload;
    }

    public function index()
    {
        $data = pendaftaran::paginate(50);
        return view('Admin.DataPendaftaran.index', [
            'data' => $data
        ]);
    }



    public function create(Request $request)
    {
        $ip = $request->ip; // code
        $ij = $request->ij; // nik
        $paket = (new Kategori())->paketQuery()->get();
        $jemaah = jemaah::where('nik', $ij)->first();
        if ($jemaah == null) {
            $ij = null;
        }
        return view('Admin.DataPendaftaran.create', [
            'ip' => $ip,
            'ij' => $ij,
            'paket' => $paket,
            'jemaah' => $jemaah
        ]);
    }
}
