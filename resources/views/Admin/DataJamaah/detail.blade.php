@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Detail Jemaah </h3>
         <p class="text-subtitle text-muted">Jamaah haji dan umroh</p>
      </div>
   </div>
</div>

<div class="card mb-2">
   <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><b>Nama : {{$data->nama_lengkap}}</b></h5>
      <a href="{{route('admin.jemaah.edit', ['id'=>$data->id])}}" class="btn btn-sm btn-outline-primary">
         <i class="fas fa-eye"></i>
      </a>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5><b>Riwayat Pendaftaran</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <th>Nama Paket</th>
               <th>Keberangakatan</th>
               <th>Durasi</th>
               <th>Status</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>

      <div class="text-end">
         <a href="{{route('admin.pendaftaran.create')}}" class="btn btn-sm btn-primary">Tambah Pendaftaran</a>
      </div>
   </div>


   @endsection

   @section('js')
   @endsection