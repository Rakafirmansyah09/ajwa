<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\MidtransController;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\bioJemaah;
use App\Models\group;
use App\Models\jemaah;
use App\Models\paket;
use App\Models\pembayaran;
use App\Models\pengaturan_web;
use App\Models\sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JemaahController extends Controller
{
    public $upload;
    public $midtrans;

    public function __construct()
    {
        $this->upload = new UploadFileController();
        $this->midtrans = new MidtransController();
    }

    public function addJemaah($id, Request $request)
    {
        $group = group::find($id);
        $bioJemaah = null;
        if (isset($request->idj)) {
            $bioJemaah = bioJemaah::find($request->idj);
        }
        $sales = sales::where('aktif', 1)->get();

        return view('Admin.DataBioJamaah.DataJemaah.updateJemaah', [
            'group' => $group,
            'bioJemaah' => $bioJemaah,
            'pageTitle' => 'Tambah Data Jamaah',
            'sales' => $sales,
        ]);
    }

    public function cariNIK($id, Request $request)
    {
        $paket = group::find($id);
        if (!$paket) {
            return redirect()->route('admin.pendaftaran.addJemaah', ['id' => $id])->withErrors('Paket tidak ditemukan!');
        }
        $Jemaah = bioJemaah::where('nik', $request->nik)->first();
        if (!$Jemaah) {
            return redirect()->route('admin.pendaftaran.addJemaah', ['id' => $id])->withErrors('NIK jemaah tidak ditemukan!');
        }
        // return  $Jemaah;
        return redirect()->route('admin.pendaftaran.addJemaah', ['id' => $id, 'idj' => $Jemaah->id])->with('success', 'Data jemaah ditemukan!');
    }

    public function storeJemaah($id, Request $request)
    {
        $request->validate([
            'idJemaah' => 'string|nullable|exists:bioJemaahs,id',

            'namaLengkap' => 'string|nullable',
            'nik' => 'string|nullable',
            'tanggalLahir' => 'date|nullable',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempatLahir' => 'string|nullable',
            'email' => 'string|nullable',
            'no_hp' => 'string|required',
            'alamat' => 'string|required',
            'kecamatan' => 'string|required',

            'sumber_info' => 'string|required',
            // 'detail_info' => 'string|required',

            // 'file_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1048',
            // 'file_paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1048',

        ]);

        // return $request;

        // create or update bioJemaah
        if (!isset($request->idJemaah)) {

            $request->validate([
                'nik' => 'required|string|unique:bioJemaahs,nik',
                'namaLengkap' => 'required|string',
                'tanggalLahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'tempatLahir' => 'required|string',
                'email' => 'nullable|string',

                // 'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            ]);


            // $fileKtp = null;
            // $filePaspor = null;

            $bioJemaah = bioJemaah::where('nik', $request->nik)->first();
            $bioJemaah = bioJemaah::create([
                'nama_lengkap' => $request->namaLengkap,
                'nik' => $request->nik,
                'tanggal_lahir' => $request->tanggalLahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempatLahir,
                'email' => $request->email,
            ]);


            // if ($request->hasFile('file_ktp')) {
            //     $fileKtp = $this->upload->create($bioJemaah->id, 'Biojemaah', $request->file('file_ktp'));
            // }

            // if ($request->hasFile('file_paspor')) {
            //     $filePaspor = $this->upload->create($bioJemaah->id, 'Jemaah', $request->file('file_paspor'));
            // }

            // $bioJemaah->update([
            //     'file_ktp' => $fileKtp,
            //     'file_paspor' => $filePaspor,
            // ]);

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
        $usia = date_diff(date_create($bioJemaah->tanggal_lahir), date_create('today'))->y;
        $sales = sales::find($request->sumber_info);

        $bioJemaah->jemaah()->create([
            'group_id' => $id,

            'no_hp' => $request->no_hp,
            'usia' => $usia,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,

            'sumber_info' => $sales->id,
            'detail_info' => $request->detail_info,
        ]);

        // return redirect()->back()->with('success', 'Data jemaah berhasil ditambahkan!');
        return redirect()->route('admin.group.listJemaah', ['id' => $id])->with('success', 'Data jemaah berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $jemaah = jemaah::find($id);
        $paket = paket::find($jemaah->group->paket_id);
        $group = group::find($jemaah->group_id);

        $ketuaRombongan = $jemaah->listRombongan($jemaah->group_id);
        $memberRombongan = $jemaah->id_rombongan ? $jemaah->memberRombongan($jemaah->id_rombongan) : [];

        return view(
            'Admin.DataBioJamaah.DataJemaah.detail',
            [
                'pageTitle' => 'Detail Pendaftaran Jemaah',
                'jemaah' => $jemaah,
                'group' => $group,
                'ketuaRombongan' => $ketuaRombongan,
                'memberRombongan' => $memberRombongan,
                'paket' => $paket,
            ]
        );
    }

    public function addRombongan(Request $request)
    {
        $request->validate([
            'idJemaah' => 'required|string|exists:pendaftaran,id',
            'ketuaRombongan' => 'required|string|exists:pendaftaran,id'
        ]);

        jemaah::addRombongan($request->idJemaah, $request->ketuaRombongan);
        return redirect()->back()->with('success', 'Data rombongan berhasil ditambahkan!');
    }

    public function deleteRombongan($id)
    {
        jemaah::deleteRombongan($id);
        return redirect()->back()->with('success', 'Data rombongan berhasil dihapus!');
    }

    public function batalBerangkat(Request $request,  $id)
    {
        $request->validate([
            'alasan_pembatalan' => 'required|string',
        ]);

        $jemaah = jemaah::find($id);
        $jemaah->update([
            'pembatalan' => true,
            'tanggal_pembatalan' => date('Y-m-d'),
            'alasan_pembatalan' => $request->alasan_pembatalan
        ]);

        return redirect()->back()->with('success', 'Data jemaah berhasil dibatalkan!');
    }

    public function lanjuttBerangkat($id)
    {
        $jemaah = jemaah::find($id);

        // if($jemaah->group)

        $jemaah->update([
            'pembatalan' => false,
            'tanggal_pembatalan' => null,
            'alasan_pembatalan' => null
        ]);

        return redirect()->back()->with('success', 'Data jemaah berhasil dilanjutkan!');
    }

    public function gantiGrup($idjemaah, $idgrup)
    {
        $jemaah = jemaah::find($idjemaah);

        if (jemaah::memberRombongan($jemaah->id)->count() >  1) {
            return redirect()->back()->with('error', 'Data jemaah tidak dapat diganti grup karena memiliki rombongan!');
        }

        $group = group::find($idgrup);
        if ($group->paket_id != $jemaah->group->paket_id) {
            return redirect()->back()->with('error', 'Data jemaah tidak dapat diganti grup karena paket tidak sama!');
        }
        if ($group->paket->kuota - $group->jemaah->count() == 0) {
            return redirect()->back()->with('error', 'Data jemaah tidak dapat diganti grup karena paket sudah penuh!');
        }

        $jemaah->update([
            'group_id' => $idgrup,
        ]);

        return redirect()->back()->with('success', 'Data jemaah berhasil diganti grup!');
    }
    public function delete(Request $request)
    {
        $jemaah = jemaah::find($request->idJemaah);
        if ($jemaah->pembayaran->count() > 0) {
            return redirect()->back()->with('error', 'Data jemaah tidak dapat dihapus karena sudah ada pembayaran!');
        }

        $jemaah->delete();
        return redirect()->back()->with('success', 'Data jemaah berhasil dihapus!');
    }

    public function addPembayaran($id)
    {
        $jemaah = jemaah::find($id);

        // dd(config('midtrans.clientKey'));
        // dd(env('MIDTRANS_CLIENT_KEY'));



        $terbayar = $jemaah->pembayaran->sum('harga');
        $harga = $jemaah->group->paket->harga;
        $belumBayar = $harga - $terbayar;
        // isset
        return view('Admin.DataBioJamaah.DataJemaah.updatePembayaran', [
            'pageTitle' => 'Tambah Pembayaran',
            'jemaah' => $jemaah,
            'belumBayar' => $belumBayar,
        ]);
    }

    public function apiGenerateSnap(Request $request)
    {
        $request->validate([
            'jemaah_id' => 'required|exists:pendaftaran,id',
            'harga' => 'required|numeric|min:10000',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $request->harga,
            ],
            'customer_details' => [
                'first_name' => 'Jemaah',
                'last_name' => '',
                'email' => 'jemaah@example.com',
                'phone' => '08123456789',
            ],
        ];

        $result = $this->midtrans->generateSnapToken($params);
        return response()->json($result);
    }

    public function storePembayaran(Request $request)
    {
        // return $request;

        $request->validate([
            'jemaah_id' => 'required|exists:pendaftaran,id',
            'harga' => 'required|numeric',
            'method' => 'required|string',
            'detail' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1048',
        ]);

        if ($request->method == 'transfer') {
            $request->validate([
                'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1048',
            ]);
        }

        $jemaah = jemaah::find($request->jemaah_id);
        $bukti = '-';
        if ($request->hasFile('bukti')) {
            $bukti = $this->upload->create($jemaah->id, 'Pembayaran', $request->file('bukti'));
        }

        $jemaah->pembayaran()->create([
            'harga' => $request->harga,
            'method' => $request->method,
            'status' => 'success',
            'dibayar_oleh' => 'admin',
            'detail' => $request->detail,
            'bukti' => $bukti,
        ]);
        return redirect()->route('admin.jemaah.detail', ['id' => $request->jemaah_id])->with('success', 'Data pembayaran berhasil ditambahkan!');
    }

    public function deletePembayaran(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pembayarans,id',
        ]);

        $pembayaran = pembayaran::find($request->id);
        if ($pembayaran->dibayar_oleh != 'admin') {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus pembayaran yang dilakukan oleh jemaah!');
        }

        $this->upload->delete($pembayaran->bukti);
        $pembayaran->delete();
        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus!');
    }


    public function showInvoice($id)
    {
        $jemaah = jemaah::with(['bioJemaah', 'pembayaran', 'group.paket'])->findOrFail($id);
        $totalBayar = $jemaah->pembayaran->sum('harga');
        $hargaPaket = $jemaah->group->paket->harga ?? 0;

        $namaPerusahaan = pengaturan_web::where('code', 'nama_perusahaan')->first()->value;
        $noTelpPerusahaan = pengaturan_web::where('code', 'no_telp_perusahaan')->first()->value;
        $emailPerusahaan = pengaturan_web::where('code', 'email_perusahaan')->first()->value;
        $webPerusahaan = pengaturan_web::where('code', 'web_perusahaan')->first()->value;

        return view('Admin.DataBioJamaah.DataJemaah.invoice', compact(
            'jemaah',
            'totalBayar',
            'hargaPaket',
            'namaPerusahaan',
            'noTelpPerusahaan',
            'emailPerusahaan',
            'webPerusahaan'
        ));

        $pdf = Pdf::loadView('Admin.DataBioJamaah.DataJemaah.invoice', compact(
            'jemaah',
            'totalBayar',
            'hargaPaket',
            'namaPerusahaan',
            'noTelpPerusahaan',
            'emailPerusahaan',
            'webPerusahaan'
        ));

        $filename = 'invoice-jemaah-' . $jemaah->bioJemaah->nama_lengkap . '.pdf';
        return $pdf->download($filename);
    }
}
