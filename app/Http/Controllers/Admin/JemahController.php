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

        return redirect()->route('admin.jemaah.list')->with('success', 'Berhasil menambahakan data jemaah baru');
    }

    public function edit($id)
    {
        $data = jemaah::find($id);
        // return $data;
        return view('Admin.DataJamaah.update', [
            'jemaah' => $data
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'namaLengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'tanggalLahir' => 'required|date|before:today',
            'tempatLahir' => 'required|string|max:255',
            'file_ktp' => 'file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_paspor' => 'file|mimes:jpg,jpeg,png,pdf|max:1048',
        ]);
        $jemaah = jemaah::find($request->id);
        $jemaah->update([
            'nama_lengkap' => $request->namaLengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempatLahir
        ]);
        if ($request->file('file_ktp')) {
            $fileKtp = $this->upload->update($jemaah->file_ktp, $request->file('file_ktp'));
            $jemaah->update([
                'file_ktp' => $fileKtp
            ]);
        }
        if ($request->file('file_paspor')) {
            $filePaspor = $this->upload->update($jemaah->file_paspor, $request->file('file_paspor'));
            $jemaah->update([
                'file_paspor' => $filePaspor
            ]);
        }
        return redirect()->route('admin.jemaah.list')->with('success', 'Berhasil mengubah data jemaah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:kategoris,id',
        ]);
        $jemaah = jemaah::find($request->id);
        $this->upload->delete($jemaah->file_ktp);
        $this->upload->delete($jemaah->file_paspor);
        $jemaah->delete();
        return redirect()->route('admin.jemaah.list')->with('success', 'Berhasil menghapus data jemaah');
    }

    public function detail($id)
    {
        $data = jemaah::find($id);
        return view('Admin.DataJamaah.detail', [
            'data' => $data
        ]);
    }
}
