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

    public function index()
    {
        $data = bioJemaah::paginate(20);
        return view('Admin.DataBioJamaah.index', [
            'data' => $data,
            'pageTitle' => 'List Biodata Jemaah',
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|string|exists:bioJemaahs,id',
        ]);
        // return $request->all();
        $bioJemaah = bioJemaah::find($request->id);
        if ($bioJemaah->jemaah->count() > 0) {
            return redirect()->route('admin.jemaah.list')->with('error', 'Data jemaah tidak dapat dihapus karena memiliki data pendaftaran');
        }
        $this->upload->delete($bioJemaah->file_ktp);
        $this->upload->delete($bioJemaah->file_paspor);
        $bioJemaah->delete();
        return redirect()->route('admin.jemaah.list')->with('success', 'Berhasil menghapus data jemaah');
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
