<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $data = sales::paginate(50);
        return view('Admin.DataSales.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('Admin.DataSales.update');
    }

    public function store(Request $request)
    {
        // return $request;

        $request->validate([
            'label' => 'required|string',
            'nama' => 'required|string',
            'aktif' => 'required|numeric',
            'deskripsi' => 'nullable|string'
        ]);
        sales::create($request->all());

        return redirect()->route('admin.sales.list')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = sales::find($id);
        $jemaahSales = $data->jemaahSales()->paginate(50);
        return view('Admin.DataSales.detail', [
            'sales' => $data,
            'jemaahSales' => $jemaahSales
        ]);
    }

    public function edit($id)
    {
        $data = sales::find($id);
        return view('Admin.DataSales.update', [
            'sales' => $data
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'sales_id' => 'required|string',
            'label' => 'required|string',
            'nama' => 'required|string',
            'aktif' => 'required|numeric',
            'deskripsi' => 'nullable|string'
        ]);
        $sales = sales::find($request->sales_id);
        $sales->update([
            'label' => $request->label,
            'nama' => $request->nama,
            'aktif' => $request->aktif,
            'deskripsi' => $request->deskripsi
        ]);
        return redirect()->route('admin.sales.list')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Request $request)
    {
        $sales = sales::find($request->id);
        if ($sales->jemaahSales->count() > 0) {
            return redirect()->route('admin.sales.list')->with('error', 'Data tidak dapat dihapus karena sudah memiliki jemaah');
        }
        $sales->delete();
        return redirect()->route('admin.sales.list')->with('success', 'Data berhasil dihapus');
    }
}
