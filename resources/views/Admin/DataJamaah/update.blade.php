@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>{{ isset($jemaah) ? 'Edit Jemaah' : 'Tambah Jemaah' }}</h3>
         <p class="text-subtitle text-muted">Data biodata jemaah</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         Biodata KTP
      </h5>
   </div>
   <div class="card-body">
      <form enctype="multipart/form-data" method="post" action="{{ isset($jemaah) ? route('admin.jemaah.update', $jemaah->id) : route('admin.jemaah.store') }}">
         @csrf

         <div class="row">
            <div class="col-md-6">
               <input type="hidden" name="id" value="{{ $jemaah->id ?? '' }}">
               <div class="form-group">
                  <label for="namaLengkap">Nama Lengkap</label>
                  <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" value="{{ old('namaLengkap', $jemaah->nama_lengkap ?? '') }}">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" value="{{ old('nik', $jemaah->nik ?? '') }}">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tanggalLahir">Tanggal Lahir</label>
                  <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" value="{{ old('tanggalLahir', $jemaah->tanggal_lahir ?? '') }}">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tempatLahir">Tempat Lahir</label>
                  <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="{{ old('tempatLahir', $jemaah->tempat_lahir ?? '') }}">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_ktp">File KTP</label>
                  <input type="file" name="file_ktp" class="form-control" id="file_ktp">
                  @if(isset($jemaah) && $jemaah->file_ktp)
                  <small class="text-muted">File saat ini: <a href="{{ asset($jemaah->file_ktp) }}" target="_blank">Lihat</a></small>
                  @endif
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_paspor">File Paspor</label>
                  <input type="file" name="file_paspor" class="form-control" id="file_paspor">
                  @if(isset($jemaah) && $jemaah->file_paspor)
                  <small class="text-muted">File saat ini: <a href="{{ asset($jemaah->file_paspor) }}" target="_blank">Lihat</a></small>
                  @endif
               </div>
            </div>
         </div>
         <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ isset($jemaah) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>

@endsection

@section('js')

@endsection