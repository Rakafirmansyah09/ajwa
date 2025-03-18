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

   @include('Admin.DataPendaftaran.progres', ['value'=>1])

   <div class="card mb-3">
      <div class="card-header pb-0">
         <h5 class="card-title">
            Jenis Paket
         </h5>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <input type="hidden" name="id" value="">
               <div class="form-group">
                  <label for="nama">Nama Paket</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Paket">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tanggal">Tanggal Keberangakatan</label>
                  <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal Keberangakatn" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="durasi">Durasi</label>
                  <input type="number" name="durasi" class="form-control" id="durasi" placeholder="Durasi Hari" disabled>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Rp." disabled>
               </div>
            </div>

         </div>
      </div>
   </div>
   <div class="card">
      <div class="card-body py-3">
         <div class="row">
            <div class="col-4 text-start">

            </div>
            <div class="col-4 text-center">

            </div>
            <div class="col-4 text-end">
               <a href="{{route('admin.pendaftaran.daftar2')}}" class="btn btn-primary">Selanjutnya</a>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('js')

@endsection