<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Mail\AkunJemaahCreated;
use App\Models\bioJemaah;
use App\Models\jemaah;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BioJemahController extends Controller
{
    public $upload;

    public function __construct(UploadFileController $upload)
    {
        $this->upload = $upload;
    }

    public function index(Request $request)
    {
        $data = isset($request->search)
            ? bioJemaah::where('nama_lengkap', 'like', '%' . $request->search . '%')
            ->orWhere('nik', 'like', '%' . $request->search . '%')
            ->paginate(20)
            : bioJemaah::paginate(20);

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

        $bio = bioJemaah::create([
            'nama_lengkap' => $request->namaLengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempatLahir,
            'jenis_kelamin' => $request->jenisKelamin,
        ]);

        $fileKtp = $this->upload->create($bio->id, 'Biojemaah', $request->file('file_ktp'));
        $fileKk  = $this->upload->create($bio->id, 'Biojemaah', $request->file('file_kk'));

        $bio->update([
            'file_ktp' => $fileKtp,
            'file_kk' => $fileKk,
        ]);

        return redirect()->route('admin.biojemaah.list')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = bioJemaah::findOrFail($id);
        return view('Admin.DataBioJamaah.update', [
            'jemaah' => $data,
            'pageTitle' => 'Edit Biodata Jemaah',
        ]);
    }

    public function editPost(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bioJemaahs,id',
            'namaLengkap' => 'required|string',
            'nik' => 'required|string',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required|string',
            'jenisKelamin' => 'required|in:L,P',
            'file_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bio = bioJemaah::findOrFail($request->id);

        if ($request->hasFile('file_ktp')) {
            $this->upload->delete($bio->file_ktp);
            $bio->file_ktp = $this->upload->create($bio->id, 'Biojemaah', $request->file('file_ktp'));
        }

        if ($request->hasFile('file_paspor')) {
            $this->upload->delete($bio->file_paspor);
            $bio->file_paspor = $this->upload->create($bio->id, 'Biojemaah', $request->file('file_paspor'));
        }

        $bio->update([
            'nama_lengkap' => $request->namaLengkap,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempatLahir,
            'jenis_kelamin' => $request->jenisKelamin,
            'file_ktp' => $bio->file_ktp,
            'file_paspor' => $bio->file_paspor,
        ]);

        return redirect()->route('admin.biojemaah.detail', $bio->id)->with('success', 'Data berhasil diperbarui');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bioJemaahs,id',
        ]);

        $bio = bioJemaah::findOrFail($request->id);

        if ($bio->jemaah->count() > 0) {
            return redirect()->route('admin.biojemaah.list')->with('error', 'Tidak dapat menghapus karena sudah terdaftar di pendaftaran.');
        }

        $this->upload->delete($bio->file_ktp);
        $this->upload->delete($bio->file_paspor);
        $bio->delete();

        return redirect()->route('admin.biojemaah.list')->with('success', 'Data berhasil dihapus.');
    }

    public function detail($id)
    {
        $data = bioJemaah::findOrFail($id);

        return view('Admin.DataBioJamaah.detail', [
            'pageTitle' => 'Detail Jemaah : ' . $data->nama_lengkap,
            'data' => $data,
        ]);
    }

    public function updateAkun(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bioJemaahs,id',
            'email' => 'required|email|unique:users,email',
        ]);

        $bio = bioJemaah::findOrFail($request->id);

        if ($bio->id_akun !== null) {
            return redirect()->route('admin.biojemaah.detail', $bio->id)->with('error', 'Akun sudah tersedia');
        }

        $password = Str::random(8);
        $user = User::create([
            'name' => $bio->nama_lengkap,
            'email' => $request->email,
            'password' => bcrypt($password),
            'type' => 'jemaah',
        ]);

        $bio->update([
            'id_akun' => $user->id,
            'email' => $request->email,
        ]);

        Mail::to($request->email)->send(new AkunJemaahCreated(
            $bio->nama_lengkap,
            $request->email,
            $password
        ));

        return redirect()->route('admin.biojemaah.detail', $bio->id)->with('success', 'Akun berhasil dibuat');
    }

    public function deleteAkun(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bioJemaahs,id',
            'email' => 'required|email|exists:users,email',
        ]);

        $bio = bioJemaah::findOrFail($request->id);

        if (!$bio->id_akun) {
            return redirect()->route('admin.biojemaah.detail', $bio->id)->with('error', 'Akun belum tersedia');
        }

        $user = User::find($bio->id_akun);
        $bio->update(['id_akun' => null]);
        $user->delete();

        return redirect()->route('admin.biojemaah.detail', $bio->id)->with('success', 'Akun berhasil dihapus');
    }

    public function uploadKtp(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bioJemaahs,id',
            'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bio = bioJemaah::findOrFail($request->id);

        $this->upload->delete($bio->file_ktp);
        $fileBaru = $this->upload->create($bio->id, 'Biojemaah', $request->file('file_ktp'));

        $bio->update(['file_ktp' => $fileBaru]);

        return redirect()->route('admin.biojemaah.detail', $bio->id)->with('success', 'File KTP berhasil diperbarui');
    }

    public function uploadPaspor(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bioJemaahs,id',
            'file_paspor' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bio = bioJemaah::findOrFail($request->id);

        $this->upload->delete($bio->file_paspor);
        $fileBaru = $this->upload->create($bio->id, 'Biojemaah', $request->file('file_paspor'));

        $bio->update(['file_paspor' => $fileBaru]);

        return redirect()->route('admin.biojemaah.detail', $bio->id)->with('success', 'File paspor berhasil diperbarui');
    }
}
