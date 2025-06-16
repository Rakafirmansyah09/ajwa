<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\group;
use App\Models\kategori;
use App\Models\paket;
use Illuminate\Http\Request;


class PaketController extends Controller
{
    public $upload;

    public function __construct(UploadFileController $upload)
    {
        $this->upload = $upload;
    }

    public function index()
    {
        $data = paket::paginate(50);
        return view('Admin.DataPaket.index', [
            'data' => $data,
            'pageTitle' => 'Data Paket',
        ]);
    }

    public function listAllGroup()
    {
        $data = group::with('paket')
            ->whereDate('tanggal_keberangkatan', '>=', now())
            ->orderBy('tanggal_keberangkatan', 'asc')
            ->paginate(20);

        return view('Admin.DataPaket.listAllGroup', [
            'groups' => $data,
            'pageTitle' => 'All Data Group Paket',
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => 'required|string',
        ]);

        $paket = paket::create([
            'code' => $request->code,
            'nama' => $request->nama,
            'durasi' => $request->durasi,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'detail' => $request->detail,
        ]);

        if (isset($request->gambar)) {
            $url =  $this->upload->create($paket->id, 'paket',   $request->gambar);
            $paket->gambar = $url;
            $paket->save();
        }

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => 'required|string',
        ]);

        $paket = paket::find($request->id);
        if (!$paket) {
            abort(404);
        }

        if (isset($request->gambar)) {
            if ($paket->gambar) {
                $url =  $this->upload->update($paket->gambar, $request->gambar);
            } else {
                $url =  $this->upload->create($paket->id, 'paket',   $request->gambar);
            }

            $paket->update([
                'code' => $request->code,
                'nama' => $request->nama,
                'durasi' => $request->durasi,
                'kuota' => $request->kuota,
                'harga' => $request->harga,
                'gambar' => $url,
                'detail' => $request->detail,
            ]);
        } else {
            $paket->update([
                'code' => $request->code,
                'nama' => $request->nama,
                'durasi' => $request->durasi,
                'kuota' => $request->kuota,
                'harga' => $request->harga,
                'detail' => $request->detail,
            ]);
        }

        return redirect()->route('admin.paket.list')->with('success', 'Berhasil mengubah paket');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|string|exists:pakets,id',
        ]);

        $paket = paket::with('group')->find($request->id);
        if ($paket->group->count() > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus paket karena sudah ada Keberangkatan');
        }
        $paket->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus paket');
    }

    public function detail($id)
    {
        $paket = paket::with(['group' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        // return $paket;

        if (!$paket) {
            abort(404);
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

        $paket = paket::find($request->paket_id);
        $paket->fasilitas = array_map(function ($item, $index) {
            return ['nama' => $item];
        }, $request->fasilitas, array_keys($request->fasilitas));
        $paket->save();

        return redirect()->route('admin.paket.detail', ['id' => $request->paket_id])->with('success', 'Berhasil mengubah fasilitas paket');
    }

    public function editItinerary($id)
    {
        $paket = paket::find($id);

        // return $paket->list_itinerary;
        return view('Admin.DataPaket.updateItinerary', [
            'paket' => $paket,
            'pageTitle' => 'Edit Itinerary Paket',
        ]);
    }

    public function editItineraryStore(Request $request)
    {
        // return $request;
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'judul' => 'required|array',
            'deskripsi' => 'required|array',
            'lokasi' => 'required|array',
        ]);

        $paket = paket::find($request->paket_id);
        $itinerary = [];
        foreach ($request->judul as $key => $judul) {
            $itinerary[] = [
                'judul' => $judul,
                'deskripsi' => $request->deskripsi[$key] ?? '',
                'lokasi' => $request->lokasi[$key] ?? '',
            ];
        }

        $paket->itinerary = $itinerary;
        $paket->save();

        return redirect()->route('admin.paket.detail', ['id' => $request->paket_id])->with('success', 'Berhasil mengubah itinerary paket');
    }
}
