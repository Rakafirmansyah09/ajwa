<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\group;
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
            'paket_id' => 'required|exists:pakets,id',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'nullable|date',
        ]);

        $paket = paket::find($request->paket_id);
        $lastGroup = $paket->group->last();

        if ($lastGroup && preg_match('/Batch (\d+)/i', $lastGroup->nama, $match)) {
            $nextNumber = intval($match[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        $namaGroup = 'Batch ' . $nextNumber;

        group::create([
            'paket_id' => $request->paket_id,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'tanggal_kepulangan' => $request->tanggal_kepulangan,
            'nama' => $namaGroup,
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
            'keberangkatan_id' => 'required|exists:group,id',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan' => 'nullable|date',
        ]);

        $group = group::find($request->keberangkatan_id);
        $paket = $group->paket;
        $group->update([
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

        // return $group->list_penerbangan;
        $paket = $group->paket;
        return view('Admin.DataPaket.DataGroup.detail', [
            'group' => $group,
            'paket' => $paket,
        ]);
    }
}
