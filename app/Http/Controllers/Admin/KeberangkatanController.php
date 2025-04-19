<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\paket;
use App\Models\paketKeberangkatan;
use Illuminate\Http\Request;

class KeberangkatanController extends Controller
{
    // public function index() {}

    public function create($id)
    {

        $paket = paket::find($id);
        return view('Admin.DataPaket.Data Keberangkatan.update', [
            'paket' => $paket,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'nullable|date',
        ]);

        $paket = paket::find($request->paket_id);

        paketKeberangkatan::create([
            'paket_id' => $request->paket_id,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'tanggal_kepulangan' => $request->tanggal_kepulangan,
            'harga_tiket' => $paket->harga,
        ]);

        return redirect()->route('admin.paket.detail', ['id' => $request->paket_id])->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $keberangkatan = paketKeberangkatan::find($id);
        $paket = $keberangkatan->paket;
        return view('Admin.DataPaket.Data Keberangkatan.update', [
            'keberangkatan' => $keberangkatan,
            'paket' => $paket,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'keberangkatan_id' => 'required|exists:paket_keberangkatan,id',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'nullable|date',
        ]);

        $keberangkatan = paketKeberangkatan::find($request->keberangkatan_id);
        $paket = $keberangkatan->paket;
        $keberangkatan->update([
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'tanggal_kepulangan' => $request->tanggal_kepulangan,
            'harga_tiket' => $paket->harga,
        ]);
        return redirect()->route('admin.paket.detail', ['id' => $request->paket_id])->with('success', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'keberangkatan_id' => 'required|exists:paket_keberangkatan,id',
        ]);
        $keberangkatan = paketKeberangkatan::find($request->keberangkatan_id);
        $keberangkatan->delete();

        return  redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function detail($id)
    {
        $keberangkatan = paketKeberangkatan::with('rombongan.jemaah')->find($id);
        $paket = $keberangkatan->paket;
        return view('Admin.DataPaket.Data Keberangkatan.detail', [
            'keberangkatan' => $keberangkatan,
            'paket' => $paket,
        ]);
    }
}
