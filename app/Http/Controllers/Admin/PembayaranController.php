<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\MidtransController;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\jemaah;
use App\Models\pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    public $midtrans;

    public function __construct()
    {
        $this->midtrans = new MidtransController();
    }

    public function create($id)
    {
        $jemaah = jemaah::find($id);

        $terbayar = $jemaah->pembayaran->sum('harga');
        $harga = $jemaah->group->paket->harga;
        $belumBayar = $harga - $terbayar;

        return view('Admin.DataBioJamaah.DataJemaah.updatePembayaran', [
            'pageTitle' => 'Tambah Pembayaran',
            'jemaah' => $jemaah,
            'belumBayar' => $belumBayar,
        ]);
    }

    public function apiCreateSnap(Request $request)
    {
        $request->validate([
            'jemaah_id' => 'required|exists:pendaftaran,id',
            'harga' => 'required|numeric|min:10000',
        ]);

        $jemaah = jemaah::find($request->jemaah_id);

        $pembayaran = $jemaah->pembayaran()->create([
            'harga' => $request->harga,
            'method' => 'digital',
            'status' => 'pending',
            'dibayar_oleh' => 'admin',
            'detail' => '-',
        ]);

        // pisah firstname lastname dari nama_lengkap
        $nama = explode(' ', $jemaah->nama_lengkap);
        $firstName = $nama[0];
        $lastName = '';

        if (count($nama) > 1) {
            unset($nama[0]);
            $lastName = implode(' ', $nama);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $pembayaran->id,
                'gross_amount' => $request->harga,
            ],
            'customer_details' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $jemaah->bioJemaah->email,
                'phone' => $jemaah->no_hp,
            ],
        ];

        $result = $this->midtrans->generateSnapToken($params);

        $pembayaran->update([
            'snap_token' =>  $result['data'],
        ]);

        return response()->json($result);
    }

    // pembayaran manual
    public function storeManual(Request $request)
    {
        $request->validate([
            'jemaah_id' => 'required|exists:pendaftaran,id',
            'harga' => 'required|numeric',
            'method' => 'required|string',
            'detail' => 'required|string',
        ]);

        $jemaah = jemaah::find($request->jemaah_id);

        $jemaah->pembayaran()->create([
            'harga' => $request->harga,
            'method' => $request->method,
            'status' => 'success',
            'dibayar_oleh' => 'admin',
            'detail' => $request->detail,
        ]);
        return redirect()->route('admin.jemaah.detail', ['id' => $request->jemaah_id])->with('success', 'Data pembayaran berhasil ditambahkan!');
    }

    // webhook midtrans
    public function webhook(Request $request)
    {
        $notification = json_decode($request->getContent(), true);

        // masukkan ke log
        Log::info('Midtrans webhook notification:', $notification);

        $status = $notification['transaction_status'];
        $fraud = $notification['fraud_status'];
        $order_id = $notification['order_id'];

        $pembayaran = pembayaran::find($order_id);

        if ($status == 'capture') {
            if ($fraud == 'challenge') {
                $pembayaran->update(['status' => 'pending']);
            } else if ($fraud == 'accept') {
                $pembayaran->update(['status' => 'success']);
            }
        } else if ($status == 'settlement') {
            $pembayaran->update(['status' => 'success']);
        } else if ($status == 'cancel' || $status == 'deny' || $status == 'expire') {
            $pembayaran->update(['status' => 'failed']);
        } else if ($status == 'pending') {
            $pembayaran->update(['status' => 'pending']);
        }

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pembayarans,id',
        ]);

        $pembayaran = pembayaran::find($request->id);
        if ($pembayaran->dibayar_oleh != 'admin') {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus pembayaran yang dilakukan oleh jemaah!');
        }

        $pembayaran->delete();
        return redirect()->back()->with('success', 'Data pembayaran berhasil dihapus!');
    }
}
