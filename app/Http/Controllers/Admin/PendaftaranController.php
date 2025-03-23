<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
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

    public function detail($id)
    {
        $paket = kategori::with('pendaftar')->find($id);
        if (!$paket) {
            return admin_abort(404, 'Paket tidak ditemukan');
        }

        return view('Admin.DataPendaftaran.detailPaket', ['paket' => $paket]);
    }

    public function createByPaket($id)
    {
        $paket = kategori::find($id);
        if (!$paket) {
            return admin_abort(404, 'Paket tidak ditemukan');
        }

        return view('Admin.DataPendaftaran.pendaftaranPaket', ['paket' => $paket]);
        return $paket;
    }

    public function inputCode(Request $request) {}

    public function store(Request $request) {}

    public function edit($id) {}

    public function update(Request $request) {}

    public function delete(Request $request) {}
}
