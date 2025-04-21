<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\bioJemaah;
use App\Models\group;
use App\Models\jemaah;
use App\Models\paket;
use Illuminate\Http\Request;

class JemaahController extends Controller
{
    public $upload;

    public function __construct(UploadFileController $upload)
    {
        $this->upload = $upload;
    }

    public function addJemaah($id, Request $request)
    {
        $group = group::find($id);
        $bioJemaah = null;
        if (isset($request->idj)) {
            $bioJemaah = bioJemaah::find($request->idj);
        }
        return view('Admin.DataBioJamaah.DataJemaah.updateJemaah', [
            'group' => $group,
            'bioJemaah' => $bioJemaah,
            'pageTitle' => 'Tambah Data Jamaah',
        ]);
    }

    public function cariNIK($id, Request $request)
    {
        $paket = group::find($id);
        if (!$paket) {
            return redirect()->route('admin.group.addJemaah', ['id' => $id])->withErrors('Paket tidak ditemukan!');
        }
        $Jemaah = bioJemaah::where('nik', $request->nik)->first();
        if (!$Jemaah) {
            return redirect()->route('admin.group.addJemaah', ['id' => $id])->withErrors('NIK jemaah tidak ditemukan!');
        }
        // return  $Jemaah;
        return redirect()->route('admin.group.addJemaah', ['id' => $id, 'idj' => $Jemaah->id])->with('success', 'Data jemaah ditemukan!');
    }

    public function storeJemaah($id, Request $request)
    {
        $request->validate([
            'idJemaah' => 'string|nullable|exists:bioJemaahs,id',

            'namaLengkap' => 'string|nullable',
            'nik' => 'string|nullable',
            'tanggalLahir' => 'date|nullable',
            'jenis_kelamin' => 'string|nullable',
            'tempatLahir' => 'string|nullable',

            'no_hp' => 'string|required',
            'alamat' => 'string|required',
            'kecamatan' => 'string|required',

            'file_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1048',

            'file_foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_ijazah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',

        ]);

        // return $request;

        // create or update bioJemaah
        if (!isset($request->idJemaah)) {
            $fileKtp = null;
            $filePaspor = null;

            $bioJemaah = bioJemaah::where('nik', $request->nik)->first();
            if (!$bioJemaah) {
                $bioJemaah = bioJemaah::create([
                    'nama_lengkap' => $request->namaLengkap,
                    'nik' => $request->nik,
                    'tanggal_lahir' => $request->tanggalLahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempatLahir,
                ]);
            }

            if ($request->hasFile('file_ktp')) {
                $fileKtp = $this->upload->create($bioJemaah->id, 'Biojemaah', $request->file('file_ktp'));
            }

            if ($request->hasFile('file_paspor')) {
                $filePaspor = $this->upload->create($bioJemaah->id, 'Jemaah', $request->file('file_paspor'));
            }

            $bioJemaah->update([
                'file_ktp' => $fileKtp,
                'file_paspor' => $filePaspor,
            ]);

            $request->merge(['idJemaah' => $bioJemaah->id]);
        } else {
            $bioJemaah = bioJemaah::where('id', $request->idJemaah)->first();

            if ($request->hasFile('file_ktp')) {
                $fileKtp = $this->upload->update($bioJemaah->file_ktp, $request->file('file_ktp'));
                $bioJemaah->update(['file_ktp' => $fileKtp]);
            }

            if ($request->hasFile('file_paspor')) {
                $filePaspor = $this->upload->update($bioJemaah->file_paspor, $request->file('file_paspor'));
                $bioJemaah->update(['file_paspor' => $filePaspor]);
            }
        }

        // create jemaah
        $file_foto = $this->upload->create($request->idJemaah, 'Jemaah', $request->file('file_foto'));
        $file_ijazah = $this->upload->create($request->idJemaah, 'Jemaah', $request->file('file_ijazah'));
        $file_kk = $this->upload->create($request->idJemaah, 'Jemaah', $request->file('file_kk'));
        $usia = date_diff(date_create($bioJemaah->tanggal_lahir), date_create('today'))->y;

        $bioJemaah->jemaah()->create([
            'group_id' => $id,

            'no_hp' => $request->no_hp,
            'usia' => $usia,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,

            'file_foto' => $file_foto,
            'file_ijazah' => $file_ijazah,
            'file_kk' => $file_kk,

            'sumber_info' => '',
            'sumber_ket' => '',
            'detail_info' => '',
        ]);

        return redirect()->back()->with('success', 'Data jemaah berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $jemaah = jemaah::find($id);
        $group = group::find($jemaah->group_id);
        return view(
            'Admin.DataBioJamaah.DataJemaah.detail',
            [
                'pageTitle' => 'Detail Pendaftaran Jemaah',
                'jemaah' => $jemaah,
                'group' => $group,
            ]
        );
    }

    
    public function delete(Request $request)
    {
        $jemaah = jemaah::find($request->idJemaah);
        $jemaah->delete();
        return redirect()->back()->with('success', 'Data jemaah berhasil dihapus!');
    }
}
