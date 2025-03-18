<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\pendaftaran;
use Illuminate\Http\Request;

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

    public function daftar1()
    {
        return view('Admin.DataPendaftaran.daftar1');
    }
    public function daftar2()
    {
        return view('Admin.DataPendaftaran.daftar2');
    }
    public function daftar3()
    {
        return view('Admin.DataPendaftaran.daftar3');
    }
    public function detail()
    {
        return view('Admin.DataPendaftaran.detail');
    }

    public function store(Request $request)
    {
        return $request;
    }

    public function edit($id) {}

    public function update(Request $request) {}

    public function delete(Request $request) {}
}
