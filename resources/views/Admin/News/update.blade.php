@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>{{ isset($news)? 'Update News' : 'Tambah News' }}</h3>
         <p class="text-subtitle text-muted">Data News</p>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         Tabel News
      </h5>
   </div>
   <div class="card-body">
      <form method="post" action="{{ isset($news) ? route('admin.news.update') : route('admin.news.store') }}" enctype="multipart/form-data">
         @csrf
         <div class="row">

            <div class="col-md-6">
               <input type="hidden" name="id" value="{{ $news->id ?? '' }}">
               <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" name="judul" class="form-control" id="judul" placeholder="Nama Lengkap" value="{{ old('judul', $news->judul ?? '') }}">
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="author">Author</label>
                  <input type="text" name="author" class="form-control" id="author" placeholder="Nama Lengkap" value="{{ old('author', $news->author ?? '') }}">
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label for="gambar">File Gambar</label>
                  <input type="file" name="gambar" class="form-control" id="gambar">
                  @if(isset($news) && $news->gambar)
                  <small class="text-muted">File saat ini: <a href="{{ asset($news->gambar) }}" target="_blank">Lihat</a></small>
                  @endif
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" class="form-control" id="status">
                     <option value="draft" {{ old('status', $news->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                     <option value="publish" {{ old('status', $news->status ?? '') == 'publish' ? 'selected' : '' }}>Publish</option>
                  </select>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="tanggal_publish">Tanggal Publish</label>
                  <input type="date" name="tanggal_publish" class="form-control" id="tanggal_publish" value="{{ old('tanggal_publish', $news->tanggal_publish ?? '') }}">
               </div>
            </div>


            <div class="col-md-12">
               <div class="form-group">
                  <label for="content">Content</label>
                  <textarea name="content" class="form-control" id="content" rows="5" id="editor">{{ old('content', $news->content ?? '') }}</textarea>
               </div>
            </div>
         </div>

         <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ isset($news) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>


@endsection

@section('js')
<!-- <script src="assets/static/js/pages/ckeditor.js"></script> -->

<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script src="{{asset('mazer/static/js/pages/ckeditor.js')}}"></script>
@endsection