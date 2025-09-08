<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\UploadFileController;
use App\Models\news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public $upload;

    public function __construct()
    {
        $this->upload = new UploadFileController();
    }

    // list news
    public function list(Request $request)
    {
        if (isset($request->search)) {
            $data = news::where('judul', 'like', '%' . $request->search . '%')->paginate(20);
        } else {
            $data = news::paginate(20);
        }

        return view('Admin.News.list', [
            'data' => $data,
            'pageTitle' => 'List Berita',
        ]);
    }

    // create news
    public function create()
    {
        return view('Admin.News.update', [
            'pageTitle' => 'Tambah Berita',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'author' => 'required|string',
            'status' => 'required|in:draft,publish',
            'tanggal_publish' => 'nullable|date',
            'content' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // return $request;

        $berita = news::create([
            'judul' => $request->judul,
            'author' => $request->author,
            'status' => $request->status,
            'tanggal_publish' => $request->tanggal_publish,
            'content' => $request->content,
            'gambar' => 'FILE'
        ]);

        $upload = $this->upload->create($berita->id, 'news',  $request->file('gambar'));
        $berita->gambar = $upload;
        $berita->save();

        return redirect()->route('admin.news.list')->with('success', 'Berhasil menambahkan berita');
    }

    // edit news
    public function edit($id)
    {
        $data = news::find($id);
        return view('Admin.News.update', [
            'news' => $data,
            'pageTitle' => 'Edit Berita',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:news,id',
            'judul' => 'required|string',
            'author' => 'required|string',
            'status' => 'required|in:draft,publish',
            'tanggal_publish' => 'nullable|date',
            'content' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = news::find($request->id);
        if ($request->hasFile('gambar')) {
            $upload = $this->upload->update($data->gambar, $request->file('gambar'));
            $data->gambar = $upload;
        }
        $data->judul = $request->judul;
        $data->author = $request->author;
        $data->status = $request->status;
        $data->tanggal_publish = $request->tanggal_publish;
        $data->content = $request->content;
        $data->save();
        return redirect()->route('admin.news.list')->with('success', 'Berhasil mengubah berita');
    }

    // delete news
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:news,id',
        ]);
        $data = news::find($request->id);
        //    cek apakah gambar bukan string kosomg
        if ($data->gambar != '') {
            $this->upload->delete($data->gambar);
        }
        $data->delete();
        return redirect()->route('admin.news.list')->with('success', 'Berhasil menghapus berita');
    }

    // detail news
    public function detail($id)
    {
        $data = news::find($id);
        return view('Admin.News.detail', [
            'news' => $data,
            'pageTitle' => 'Detail Berita',
        ]);
    }

    // publish news
    public function publish($id)
    {
        $data = news::find($id);
        $data->status = 'publish';
        $data->save();
        return redirect()->route('admin.news.list')->with('success', 'Berhasil mempublish berita');
    }
}
