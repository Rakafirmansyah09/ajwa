<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\jemaah;
use Illuminate\Http\Request;

class JemahController extends Controller
{
    public $upload;

    public function __construct(UploadFileController $upload)
    {
        $this->upload = $upload;
    }

    public function index()
    {
        $data = jemaah::paginate(50);
        return view('Admin.DataJamaah.index', [
            'data' => $data
        ]);
    }
    public function create()
    {
        return view('Admin.DataJamaah.update');
    }
    public function store(Request $request)
    {
        $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'tanggalLahir' => 'required|date|before:today',
            'tempatLahir' => 'required|string|max:255',
            'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_paspor' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
        ]);

        $jemaah = jemaah::create([
            'nama_lengkap' => $request->namaLengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempatLahir
        ]);

        $fileKtp = $this->upload->create($jemaah->id, 'Jemaah', $request->file('file_ktp'));
        $filePaspor = $this->upload->create($jemaah->id, 'Jemaah', $request->file('file_paspor'));

        $jemaah->update([
            'file_ktp' => $fileKtp,
            'file_paspor' => $filePaspor
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahakan data jemaah baru');
    }

    public function edit($id) {}

    public function update(Request $request) {}

    public function delete(Request $request) {}
}
