<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\faq;
use Illuminate\Http\Request;

class FaQController extends Controller
{
    public function list()
    {
        $data = faq::latest()->get();
        // return $data;
        return view('Admin.DataFaq.list', [
            'faqs' => $data,
            'pageTitle' => 'List FAQ',
        ]);
    }

    public function create()
    {
        return view('Admin.DataFaq.update');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('admin.faq.list')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('Admin.DataFaq.update', compact('faq'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:faq,id',
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        $faq = Faq::findOrFail($request->id);
        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('admin.faq.list')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:faq,id',
        ]);

        $faq = Faq::findOrFail($request->id);
        $faq->delete();

        return redirect()->route('admin.faq.list')->with('success', 'FAQ berhasil dihapus.');
    }
}
