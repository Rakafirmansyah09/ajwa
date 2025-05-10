<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\bioJemaah;
use App\Models\jemaah;
use Illuminate\Http\Request;

class BioJemahController extends Controller
{
    public $upload;

    public function __construct(UploadFileController $upload)
    {
        $this->upload = $upload;
    }

    public function index(Request $request)
    {

        if (isset($request->search)) {
            $data = bioJemaah::where('nama_lengkap', 'like', '%' . $request->search . '%')->orWhere('nik', 'like', '%' . $request->search . '%')->paginate(20);
        } else {
            $data = bioJemaah::paginate(20);
        }


        return view('Admin.DataBioJamaah.index', [
            'data' => $data,
            'pageTitle' => 'List Biodata Jemaah',
        ]);
    }

    public function add()
    {
        return view('Admin.DataBioJamaah.add', [
            'pageTitle' => 'Tambah Biodata Jemaah',
        ]);
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'namaLengkap' => 'required|string',
            'nik' => 'required|string',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required|string',
            'jenisKelamin' => 'required|in:L,P',
            'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bioJemaah = bioJemaah::create([
            'nama_lengkap' => $request->namaLengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggalLahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempatLahir,
        ]);
        $fileKtp = $this->upload->create($bioJemaah->id, 'Biojemaah', $request->file('file_ktp'));
        $fileKk = $this->upload->create($bioJemaah->id, 'Biojemaah', $request->file('file_kk'));

        $bioJemaah->update([
            'file_ktp' => $fileKtp,
            'file_kk' => $fileKk,
        ]);

        return redirect()->route('admin.biojemaah.list')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = bioJemaah::find($id);
        return view('Admin.DataBioJamaah.update', [
            'jemaah' => $data,
            'pageTitle' => 'Edit Biodata Jemaah',
        ]);
    }

    public function editPost(Request $request)
    {
        // return $request->all();
        $request->validate([
            'id' => 'required|string|exists:bioJemaahs,id',
            'namaLengkap' => 'required|string',
            'nik' => 'required|string',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required|string',
            'jenisKelamin' => 'required|in:L,P',
            'file_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $bioJemaah = bioJemaah::find($request->id);

        $fileKtp = null;
        if ($request->hasFile('file_ktp')) {
            $fileKtp = $this->upload->update($request->file('file_ktp'), $bioJemaah->file_ktp);
        }
        $filePaspor = null;
        if ($request->hasFile('file_paspor')) {
            $filePaspor = $this->upload->update($request->file('file_paspor'), $bioJemaah->file_paspor);
        }
        $bioJemaah->update([
            'nama_lengkap' => $request->namaLengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempatLahir,
            'jenis_kelamin' => $request->jenisKelamin,
            'file_ktp' => $fileKtp,
            'file_paspor' => $filePaspor,
        ]);

        return redirect()->route('admin.biojemaah.detail', $bioJemaah->id)->with('success', 'Berhasil mengubah data jemaah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|string|exists:bioJemaahs,id',
        ]);
        // return $request->all();
        $bioJemaah = bioJemaah::find($request->id);
        if ($bioJemaah->jemaah->count() > 0) {
            return redirect()->route('admin.biojemaah.list')->with('error', 'Data jemaah tidak dapat dihapus karena memiliki data pendaftaran');
        }
        $this->upload->delete($bioJemaah->file_ktp);
        $this->upload->delete($bioJemaah->file_paspor);
        $bioJemaah->delete();
        return redirect()->route('admin.biojemaah.list')->with('success', 'Berhasil menghapus data jemaah');
    }

    public function detail($id)
    {
        $data = bioJemaah::find($id);
        // return $data->jemaah[0]->group->tanggal_keberangkatan;
        return view('Admin.DataBioJamaah.detail', [
            'pageTitle' => 'Detail Jemaah : ' . $data->nama_lengkap,
            'data' => $data,
        ]);
    }
}
