<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use App\Models\paket;
use Illuminate\Http\Request;

use function App\Providers\admin_abort;

class PaketController extends Controller
{
    public function index()
    {
        $data = paket::paginate(50);
        return view('Admin.DataPaket.index', [
            'data' => $data,
            'pageTitle' => 'Data Paket',
        ]);
    }

    public function create()
    {
        return view('Admin.DataPaket.update', [
            'pageTitle' => 'Tambah Data Paket',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'kuota' => 'required|integer',
            'harga' => 'required|numeric|min:0',
            'detail' => 'required|string',
        ]);

        paket::create([
            'code' => $request->code,
            'nama' => $request->nama,
            'durasi' => $request->durasi,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'detail' => $request->detail,
        ]);

        // return $request;
        return redirect()->route('admin.paket.list')->with('success', 'Berhasil menambah paket');
    }

    public function edit($id)
    {
        $paket = paket::find($id);
        return view('Admin.DataPaket.update', [
            'paket' => $paket,
            'pageTitle' => 'Edit Paket',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|string|exists:pakets,id',
            'code' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'kuota' => 'required|integer',
            'harga' => 'required|numeric|min:0',
            'detail' => 'required|string',
        ]);

        $paket = paket::find($request->id);
        if (!$paket) {
            return admin_abort(404, 'Paket tidak ditemukan');
        }
        $paket->update([
            'code' => $request->code,
            'nama' => $request->nama,
            'durasi' => $request->durasi,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'detail' => $request->detail,
        ]);

        return redirect()->route('admin.paket.list')->with('success', 'Berhasil mengubah paket');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|string|exists:pakets,id',
        ]);

        $paket = paket::with('paket_keberangkatan')->find($request->id);
        if ($paket->paket_keberangkatan->count() > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus paket karena sudah ada Keberangkatan');
        }
        $paket->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus paket');
    }

    public function detail($id)
    {
        $paket = Paket::with(['group' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        // return $paket;

        if (!$paket) {
            return admin_abort(404, 'Paket tidak ditemukan');
        }

        // return $paket;
        return view('Admin.DataPaket.detail', [
            'paket' => $paket,
            'pageTitle' => 'Detail Paket',
        ]);
    }

    public function editFasilitas($id)
    {
        $paket = paket::find($id);
        // return $paket->fasilitas;
        return view('Admin.DataPaket.updateFasilitas', [
            'paket' => $paket,
            'pageTitle' => 'Edit Fasilitas Paket',
        ]);
    }

    public function editFasilitasStore(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'fasilitas' => 'required|array'
        ]);

        $paket = Paket::find($request->paket_id);
        $paket->fasilitas = array_map(function ($item, $index) {
            return ['nama' => $item];
        }, $request->fasilitas, array_keys($request->fasilitas));
        $paket->save();

        return redirect()->route('admin.paket.list')->with('success', 'Berhasil mengubah fasilitas paket');
    }
}
