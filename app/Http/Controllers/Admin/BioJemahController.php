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
            'pageTitlee' => 'Data Jamaah',
        ]);
    }

    public function delete(Request $request)
    {
        // $request->validate([
        //     'id' => 'required|string|exists:kategoris,id',
        // ]);
        // $jemaah = jemaah::find($request->id);
        // $this->upload->delete($jemaah->file_ktp);
        // $this->upload->delete($jemaah->file_paspor);
        // $jemaah->delete();
        // return redirect()->route('admin.jemaah.list')->with('success', 'Berhasil menghapus data jemaah');
    }

    public function detail($id)
    {
        // $data = jemaah::with('pendaftarans', 'pendaftarans.kategori')->find($id);
        // return view('Admin.DataBioJamaah.detail', [
        //     'data' => $data,
        //     'pageTitle' => 'Detail Jamaah',
        // ]);
    }
}
