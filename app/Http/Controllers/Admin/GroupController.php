<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\group;
use App\Models\jemaah;
use App\Models\paket;
use App\Models\paketKeberangkatan;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // public function index() {}

    public function create($id)
    {

        $paket = paket::find($id);
        return view('Admin.DataPaket.DataGroup.update', [
            'paket' => $paket,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'nullable|date',
        ]);

        group::create([
            'paket_id' => $request->paket_id,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'tanggal_kepulangan' => $request->tanggal_kepulangan,
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.paket.detail', ['id' => $request->paket_id])->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $group = group::find($id);
        $paket = $group->paket;
        return view('Admin.DataPaket.DataGroup.update', [
            'keberangkatan' => $group,
            'paket' => $paket,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'nama' => 'required|string',
            'keberangkatan_id' => 'required|exists:group,id',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'nullable|date',
        ]);

        $group = group::find($request->keberangkatan_id);
        $group->update([
            'nama' => $request->nama,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'tanggal_kepulangan' => $request->tanggal_kepulangan,
        ]);
        return redirect()->route('admin.paket.detail', ['id' => $request->paket_id])->with('success', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'keberangkatan_id' => 'required|exists:group,id',
        ]);
        $group = group::find($request->keberangkatan_id);
        if ($group->jemaah->count() > 0) {
            return redirect()->back()->withErrors('Group sudsha memiliki jemaah.');
        }
        $group->delete();

        return  redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function detail($id)
    {
        $group = group::find($id);

        // return jemaah::listRombongan($group->id);
        // return $group->jemaah->groupBy('id_rombongan');

        $paket = $group->paket;
        return view('Admin.DataPaket.DataGroup.detail', [
            'group' => $group,
            'paket' => $paket,
        ]);
    }

    public function editAkomodasi($id)
    {
        $group = group::find($id);
        $paket = $group->paket;
        return view('Admin.DataPaket.DataGroup.updateAkomodasi', [
            'group' => $group,
            'paket' => $paket,
        ]);
    }

    public function editAkomodasiStore(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:group,id',
            'nama_hotel' => 'required|array',
            'kota' => 'required|array',
            'alamat' => 'required|array',
            'tanggal_checkin' => 'required|array',
            'tanggal_checkout' => 'required|array',
            'rating' => 'required|array',
        ]);

        $group = group::find($request->group_id);

        $akomodasi = [];
        foreach ($request->nama_hotel as $key => $nama_hotel) {
            $akomodasi[] = [
                'nama_hotel' => $nama_hotel,
                'kota' => $request->kota[$key] ?? '',
                'alamat' => $request->alamat[$key] ?? '',
                'tanggal_checkin' => $request->tanggal_checkin[$key] ?? '',
                'tanggal_checkout' => $request->tanggal_checkout[$key] ?? '',
                'rating' => $request->rating[$key] ?? ''
            ];
        }

        $group->akomodasi = $akomodasi;

        $group->save();
        return redirect()->route('admin.group.detail', ['id' => $request->group_id])->with('success', 'Data berhasil diubah');
    }

    public function editPenerbangan($id)
    {
        $group = group::find($id);
        $paket = $group->paket;

        // return $group->list_penerbangan;
        return view('Admin.DataPaket.DataGroup.updatePenerbangan', [
            'group' => $group,
            'paket' => $paket,
        ]);
    }

    public function editPenerbanganStore(Request $request)
    {
        // return $request;
        $request->validate([
            'group_id' => 'required|exists:group,id',
            'judul' => 'required|array',
            'maskapai' => 'required|array',
            'tanggal_berangkat' => 'required|array',
            'tanggal_tiba' => 'required|array',
            'lama_penerbangan' => 'required|array',
            'bagasi' => 'required|array',
            'bagasi_kabin' => 'required|array',
            'kursi' => 'required|array',
            'bandara_asal' => 'required|array',
            'kota_asal' => 'required|array',
            'bandara_tujuan' => 'required|array',
            'kota_tujuan' => 'required|array',
        ]);

        $group = group::find($request->group_id);

        $penerbangan = [];
        foreach ($request->judul as $key => $judul) {
            $penerbangan[] = [
                'judul' => $judul,
                'maskapai' => $request->maskapai[$key] ?? '',
                'tanggal_berangkat' => $request->tanggal_berangkat[$key] ?? '',
                'tanggal_tiba' => $request->tanggal_tiba[$key] ?? '',
                'lama_penerbangan' => $request->lama_penerbangan[$key] ?? '',
                'bagasi' => $request->bagasi[$key] ?? '',
                'bagasi_kabin' => $request->bagasi_kabin[$key] ?? '',
                'kursi' => $request->kursi[$key ?? ''],
                'bandara_asal' => $request->bandara_asal[$key] ?? '',
                'kota_asal' => $request->kota_asal[$key] ?? '',
                'bandara_tujuan' => $request->bandara_tujuan[$key] ?? '',
                'kota_tujuan' => $request->kota_tujuan[$key] ?? '',
            ];
        }
        $group->jadwal_penerbangan = $penerbangan;
        $group->save();
        return redirect()->route('admin.group.detail', ['id' => $request->group_id])->with('success', 'Data berhasil diubah');
    }
}
