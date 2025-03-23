<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use Illuminate\Http\Request;

use function App\Providers\admin_abort;

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
            'tanggal' => 'required|date|after:today',
            'durasi' => 'required|integer',
            'harga' => 'required|numeric|min:0',
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
        return redirect()->route('admin.paket.list')->with('success', 'Berhasil menambah paket');
    }

    public function edit($id)
    {
        $paket = kategori::find($id);
        return view('Admin.DataPaket.update', [
            'paket' => $paket
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date|after:today',
            'durasi' => 'required|integer',
            'harga' => 'required|numeric|min:0',
            'detail' => 'required|string',
        ]);

        $paket = kategori::find($request->id);
        $paket->update([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'durasi' => $request->durasi,
            'harga' => $request->harga,
            'detail' => $request->detail,
        ]);

        return redirect()->route('admin.paket.list')->with('success', 'Berhasil mengubah paket');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:kategoris,id',
        ]);

        $paket = kategori::with('pendaftar')->find($request->id);
        if ($paket->pendaftar->count() > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus paket karena sudah ada pendaftaran');
        }
        $paket->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus paket');
    }
}
