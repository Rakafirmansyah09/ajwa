@extends('template.index')

@section('css')


@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Tambah Jemaah</h3>
         <p class="text-subtitle text-muted">Data biodata jemaah</p>
      </div>
   </div>
</div>

<div class="page-content">
   <div class="card">
      <div class="card-header">
         <h5 class="card-title">
            Biodata KTP
         </h5>
      </div>
      <div class="card-body">
         <form enctype="multipart/form-data" method="post" action="{{route('admin.jemaah.store')}}">
            @csrf
            <div class="row">
               <div class="col-md-6">
                  <input type="hidden" name="id" value="">
                  <div class="form-group">
                     <label for="namaLengkap">Nama Lengkap</label>
                     <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" placeholder="Nama Lengkap">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nik">NIK</label>
                     <input type="text" name="nik" class="form-control" id="nik" placeholder="NIIK">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="tanggalLahir">Tanggal Lahir</label>
                     <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="Tanggal Lahir">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="tempatLahir">Tempat Lahir</label>
                     <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tanggal Lahir">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="file_ktp">File KTP</label>
                     <input type="file" name="file_ktp" class="form-control" id="file_ktp" placeholder="Tanggal Lahir">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="file_paspor">File Paspor</label>
                     <input type="file" name="file_paspor" class="form-control" id="file_paspor" placeholder="Tanggal Lahir">
                  </div>
               </div>
            </div>
            <div>
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

@section('js')

@endsection