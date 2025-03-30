<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\jemaah;
use App\Models\kategori;
use App\Models\pembayaran;
use App\Models\pendaftaran;
use Carbon\Carbon;
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
            'data' => $data,
            'pageTitle' => 'Data Pendaftaran',
        ]);
    }

    public function create(Request $request)
    {
        $ip = $request->ip; // code
        $ij = $request->ij; // nik

        $message = [];

        $paket = kategori::where('code', $ip)->first();
        if ($paket == null) {
            $message[] = 'Paket tidak ditemukan';
            $ip = null;
        }
        $jemaah = jemaah::where('nik', $ij)->first();
        if ($jemaah == null) {
            $message[] = 'Jemaah tidak ditemukan';
            $ij = null;
        }

        // return $message;

        return view('Admin.DataPendaftaran.create', [
            'ip' => $ip,
            'ij' => $ij,
            'paket' => $paket,
            'jemaah' => $jemaah,
            'pageTitle' => 'Tambah Data Pendaftaran',
        ])->with('error', $message);
    }

    public function search(Request $request)
    {
        $key = $request->query('k');
        $search = $request->query('q');

        if ($key == 'jemaah') {
            $data = jemaah::where('nik', 'like', "%$search%")
                ->orWhere('nama_lengkap', 'like', "%$search%")
                ->limit(5) // Batasi hasilnya
                ->get();
        } else if ($key == 'paket') {
            $data = kategori::where('code', 'like', "%$search%")
                ->orWhere('nama', 'like', "%$search%")
                ->limit(5) // Batasi hasilnya
                ->get();
        } else {
            $data = null;
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jamaah' => 'required|exists:jemaahs,nik',
            'id_paket' => 'required|exists:kategoris,code',

            'no_hp' => 'required|string|max:13',
            'alamat' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'file_ijazah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',

            'sumber_info' => 'required|string',
            'sumber_ket' => 'required|string',
            'detail_info' => 'required|string',
        ]);

        // simpan file upload
        $fileKk = $this->upload->create($request->id_jamaah, 'Pendaftaran', $request->file('file_kk'));
        $fileFoto = $this->upload->create($request->id_jamaah, 'Pendaftaran', $request->file('file_foto'));
        $fileIjazah = $this->upload->create($request->id_jamaah, 'Pendaftaran', $request->file('file_ijazah'));

        // ambil data jemaah dan paket
        $jemaah = jemaah::where('nik', $request->id_jamaah)->first();
        $paket = kategori::where('code', $request->id_paket)->first();

        // hitung umur jemaah
        $umur = Carbon::parse($jemaah->tanggal_lahir)->diffInYears(now());

        // simpan data pendaftaran
        $pendaftaran = pendaftaran::create([
            'jemaah_id' => $jemaah->id,
            'kategori_id' => $paket->id,
            'no_hp' => $request->no_hp,
            'usia' => $umur,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,
            'file_kk' => $fileKk,
            'file_foto' => $fileFoto,
            'file_ijazah' => $fileIjazah,
            'sumber_info' => $request->sumber_info,
            'sumber_ket' => $request->sumber_ket,
            'detail_info' => $request->detail_info,
        ]);

        return redirect()
            ->route('admin.pendaftaran.detail', ['id' => $pendaftaran->id])
            ->with('success', 'Berhasil menambahkan data pendaftaran baru');
    }

    public function detail($id)
    {
        $data = pendaftaran::with('jemaah', 'kategori', 'pembayaran')->find($id);
        return view('Admin.DataPendaftaran.detail', [
            'data' => $data,
            'pageTitle' => 'Detail Data Pendaftaran',
        ]);
    }

    public function edit($id)
    {
        $pendafataran = pendaftaran::with('jemaah', 'kategori')->find($id);
        return view('Admin.DataPendaftaran.create', [
            'pendaftaran' => $pendafataran,
            'ij' => $ij ?? '',
            'ip' => $ip ?? '',
            'pageTitle' => 'Edit Data Pendaftaran',
        ]);
    }
    public function update(Request $request)
    {
        return $request;
    }
    public function destroy($id) {}

    public function addPembayaran($id)
    {
        $data = pendaftaran::find($id);
        return view('Admin.DataPendaftaran.addPembayaran', [
            'data' => $data,
            'pageTitle' => 'Tambah Pembayaran',
        ]);
    }

    public function addPembayaranStore(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'harga' => 'required|numeric',
            'method' => 'required|string',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            'detail' => 'required|string',
        ]);

        $pendaftar = pendaftaran::find($request->pendaftaran_id);
        // upload bukti
        $bukti = $this->upload->create($pendaftar->jemaah_id . '/pembayaran', 'Pendaftaran', $request->file('bukti'));

        pembayaran::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'harga' => $request->harga,
            'bukti' => $bukti,
            'method' => $request->method,
            'detail' => $request->detail,
            'status' => 'success',
        ]);

        return redirect()->route('admin.pendaftaran.detail', ['id' => $request->pendaftaran_id])
            ->with('success', 'Berhasil menambahkan pembayaran');
    }
}
