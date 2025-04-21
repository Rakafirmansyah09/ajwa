@extends('template.index')

@section('css')
<style>
   /* style untuk tabel */
   .table-custom td {
      padding-top: 2px;
      padding-bottom: 2px;
   }

   .table-custom .tdNamaFile {
      width: 100px;
   }

   .table-custom .tdPembatas {
      width: 70px;
      text-align: center;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Detail Pendaftaran Jemaah </h3>
         <p class="text-subtitle text-muted">Data jemaah dalam group {{$group->nama}} - {{$group->paket->nama}}</p>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-12 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5><b>Jemaah</b></h5>
         </div>
         <div class="card-body">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>Nama Lengkap</td>
                  <td>:</td>
                  <td>{{$jemaah->bioJemaah->nama_lengkap}}</td>
               </tr>
               <tr>
                  <td>NIK</td>
                  <td>:</td>
                  <td>{{$jemaah->bioJemaah->nik}}</td>
               </tr>
               <tr>
                  <td>Usia</td>
                  <td>:</td>
                  <td>{{$jemaah->usia}}</td>
               </tr>
               <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>{{$jemaah->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan'}}</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
   <div class="col-12 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5><b>Paket</b></h5>
         </div>
         <div class="card-body">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>Nama Paket</td>
                  <td>:</td>
                  <td>{{$group->paket->nama}}</td>
               </tr>
               <tr>
                  <td>Group</td>
                  <td>:</td>
                  <td>{{$group->nama}}</td>
               </tr>
               <tr>
                  <td>Usia</td>
                  <td>:</td>
                  <td>{{$group->tanggal_keberangkatan}}</td>
               </tr>
               <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>Rp {{ number_format($group->paket->harga, 0, ',', '.') }}</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <h5><b>Kelengkapan Data</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-borderless table-custom">
         <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{$jemaah->bioJemaah->tanggal_lahir}}</td>
            <!-- -------------- -->
            <td>File Foto</td>
            <td>:</td>
            <td>
               <a href="{{asset($jemaah->file_foto)}}" target="_blank" class="btn btn-sm btn-info">
                  <b>Lihat file</b>
               </a>
            </td>
         </tr>
         <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td>{{$jemaah->bioJemaah->tempat_lahir}}</td>
            <!-- -------------- -->
            <td>File KTP</td>
            <td>:</td>
            <td>
               <a href="{{asset($jemaah->bioJemaah->file_ktp)}}" target="_blank" class="btn btn-sm btn-info">
                  <b>Lihat file</b>
               </a>
            </td>
         </tr>
         <tr>
            <td>No Hp</td>
            <td>:</td>
            <td>{{$jemaah->no_hp}}</td>
            <!-- -------------- -->
            <td>File KK</td>
            <td>:</td>
            <td>
               <a href="{{asset($jemaah->file_kk)}}" target="_blank" class="btn btn-sm btn-info">
                  <b>Lihat File</b>
               </a>
            </td>
         </tr>
         <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$jemaah->alamat}}</td>
            <!-- -------------- -->
            <td>File Paspor</td>
            <td>:</td>
            <td>
               <a href="{{asset($jemaah->bioJemaah->file_paspor)}}" target="_blank" class="btn btn-sm btn-info">
                  <b>Lihat File</b>
               </a>
            </td>
         </tr>
         <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td>{{$jemaah->kecamatan}}</td>
            <!-- -------------- -->
            <td>File Ijazah</td>
            <td>:</td>
            <td>
               <a href="{{asset($jemaah->file_ijazah)}}" target="_blank" class="btn btn-sm btn-info">
                  <b>Lihat File</b>
               </a>
            </td>
         </tr>
      </table>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5><b>Riwayat Pembayaran</b></h5>
   </div>
   <div class="card-body">

   </div>


   @endsection

   @section('js')
   @endsection