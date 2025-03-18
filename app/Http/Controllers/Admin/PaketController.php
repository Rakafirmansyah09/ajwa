<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $data = kategori::paginate(50);
        return view('Admin.DataPaket.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('Admin.DataPaket.update');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date|before:today',
            'durasi' => 'required|integer',
            'harga' => 'required|integer',
            'detail' => 'required|string',
        ]);

        kategori::create([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'durasi' => $request->durasi,
            'harga' => $request->harga,
            'detail' => $request->detail,
        ]);

        // return $request;
        return redirect()->back()->with('success', 'Berhasil menambah paket');
    }

    public function edit($id) {}

    public function update(Request $request) {}

    public function delete(Request $request) {}
}
