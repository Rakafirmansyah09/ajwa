@extends('template.index')

@section('css')
<style>
   /* style untuk tabel */
   .table-custom td {
      padding-top: 2px;
      padding-bottom: 2px;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Detail Jamaah </h3>
         <p class="text-subtitle text-muted">Jamaah haji dan umroh</p>
      </div>
   </div>
</div>

<div class="card mb-2">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><b>Biodata : {{$data->nama_lengkap}}</b></h5>
      <a href="{{route('admin.biojemaah.edit', ['id' => $data->id])}}" class="btn btn-sm btn-info"><b>Edit Jemaah</b></a>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-12 col-md-6">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>NIK</td>
                  <td>:</td>
                  <td>{{$data->nik}}</td>
               </tr>
               <tr>
                  <td>Tempat Lahir</td>
                  <td>:</td>
                  <td>{{$data->tempat_lahir}}</td>
               </tr>
               <tr>
                  <td>Tanggal Lahir</td>
                  <td>:</td>
                  <td>{{$data->tanggal_lahir}}</td>
               </tr>
               <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>{{$data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
               </tr>
            </table>
         </div>
         <div class="col-12 col-md-6">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>File KTP</td>
                  <td>:</td>
                  <td>
                     <a href="{{asset($data->file_ktp)}}" target="_blank">
                        <b>Lihat File</b>
                     </a>
                  </td>
               </tr>
               <tr>
                  <td>File Paspor</td>
                  <td>:</td>
                  <td>
                     <a href="{{asset($data->file_paspor)}}" target="_blank">
                        <b>Lihat File</b>
                     </a>
                  </td>
               </tr>
            </table>
         </div>
      </div>
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
               <th>Pembatalan</th>
               <th>Pembayaran</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($data->jemaah as $p)
            <tr>
               <td>{{$p->group->nama}}</td>
               <td>{{$p->group->tanggal_keberangkatan}}</td>
               <td>{{$p->group->paket->durasi}} Hari</td>
               <td>Tidak</td>

               @php
               $totalBayar = $p->pembayaran ? $p->pembayaran->sum('harga') : 0;
               @endphp
               <td>
                  Rp. {{number_format($totalBayar, 0, ',', '.')}} /
                  Rp. {{number_format($p->group->paket->harga, 0, ',', '.')}}
               </td>
               <td>
                  <a href="{{route('admin.jemaah.detail', ['id'=>$p->id])}}" class="btn btn-sm btn-info">
                     <!-- <i class="fas fa-info-circle"></i> -->
                     <b>Detail</b>
                  </a>
               </td>
            </tr>
            @empty
            <tr>
               <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
         </tbody>
      </table>

      <!-- <div class="text-end">
         <a href="" class="btn btn-sm btn-primary">Tambah Pendaftaran</a>
      </div> -->
   </div>


   @endsection

   @section('js')
   @endsection