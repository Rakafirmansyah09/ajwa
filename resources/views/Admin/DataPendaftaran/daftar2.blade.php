@extends('template.index')

@section('css')


@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Daftar</h3>
         <p class="text-subtitle text-muted"></p>
      </div>
   </div>
</div>

<div class="page-content">
   @include('Admin.DataPendaftaran.progres', ['value'=>2])
   <div class="card mb-3">
      <div class="card-header pb-0">
         <h5 class="card-title">
            Biodata Jemaah
         </h5>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK Jamaah">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nama">Nama Lengkap</label>
                  <input type="date" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tanggal">Tanggal Lahir</label>
                  <input type="number" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal Lahir" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tempat">Tempat Lahir</label>
                  <input type="text" name="tempat" class="form-control" id="tempat" placeholder="Tempat Lahir" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nohp">No Hp</label>
                  <input type="text" name="nohp" class="form-control" id="nohp" placeholder="No Hp">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="kecamatan">Kecamatan</label>
                  <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="kecamatan">
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_ktp">File KTP</label>
                  <input type="file" name="file_ktp" class="form-control" id="file_ktp" placeholder="Tanggal Lahir" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_paspor">File Paspor</label>
                  <input type="file" name="file_paspor" class="form-control" id="file_paspor" placeholder="Tanggal Lahir" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_foto">File Foto</label>
                  <input type="file" name="file_foto" class="form-control" id="file_foto" placeholder="Tanggal Lahir">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_kk">File KK</label>
                  <input type="file" name="file_kk" class="form-control" id="file_kk" placeholder="Tanggal Lahir">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_ijazah">File Ijazah</label>
                  <input type="file" name="file_ijazah" class="form-control" id="file_ijazah" placeholder="Tanggal Lahir">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card">
      <div class="card-body py-3">
         <div class="row">
            <div class="col-4 text-start">
               <a href="{{route('admin.pendaftaran.daftar1')}}" class="btn btn-primary">Sebelumnya</a>
            </div>
            <div class="col-4 text-center">

            </div>
            <div class="col-4 text-end">
               <a href="{{route('admin.pendaftaran.daftar3')}}" class="btn btn-primary">Selanjutnya</a>
            </div>
         </div>
      </div>
   </div>



</div>

@endsection

@section('js')

@endsection