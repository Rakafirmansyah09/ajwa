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
                  <td>{{$jemaah->bioJemaah->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
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
                  <td>Harga</td>
                  <td>:</td>
                  <td>Rp {{ number_format($group->paket->harga, 0, ',', '.') }}</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <!-- ====================== -->
      <div class="row">
         <div class="col-12 col-md-3">
            <h5><b>Sales</b></h5>
            <p>{{$jemaah->infoSales->label }} - {{$jemaah->infoSales->nama}} - {{$jemaah->detail_info}}</p>
         </div>
         <div class="col-12 col-md-7">
            <h5><b>Pembayaran</b></h5>
            <p>Total : Rp {{ number_format($jemaah->pembayaran->sum('harga'), 0, ',', '.') }} / Rp {{ number_format($group->paket->harga, 0, ',', '.') }}</p>
            @php
            $progress = ($jemaah->pembayaran->sum('harga') / $group->paket->harga) * 100;
            @endphp
            <div class="progress" style="height: 20px;">
               <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($progress, 1) }}%</div>
            </div>
         </div>
         <div class="col-12 col-md-2">
            <a href="" class="btn btn-sm btn-warning w-100 mb-2 mt-3 mt-md-0">
               <b>Batalkan Pendaftaran</b>
            </a>
            <a href="" class="btn btn-sm btn-warning w-100 mb-2">
               <b>Ganti Group / Paket</b>
            </a>
         </div>
      </div>
      <!-- ====================== -->
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Riwayat Pembayaran</b></h5>
      <a href="{{route('admin.group.jemaah.addPembayaran', ['id' => $jemaah->id])}}" class="btn btn-sm btn-info"><b>Tambah Pembayaran</b></a>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-borderless table-striped ">
            <thead>
               <tr class="bg-primary-subtle">
                  <td>No. </td>
                  <td>Tanggal</td>
                  <td>Dibayar Oleh</td>
                  <td>Harga</td>
                  <td>Bukti</td>
                  <td>Method</td>
                  <td>Status</td>
                  <td></td>
               </tr>
            </thead>
            <tbody>
               @forelse ( $jemaah->pembayaran as $item)
               <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->dibayar_oleh}}</td>
                  <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                  <td>
                     <a href="{{asset($item->bukti)}}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                  </td>
                  <td>{{$item->method}}</td>
                  <td>{{$item->status}}</td>
                  <td>
                     <form action="{{route('admin.group.jemaah.deletePembayaran')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <button type="submit" style="border: none;">
                           <i class="fas fa-trash-alt" style="color: #ff0000;"></i>
                        </button>
                     </form>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="8" class="text-center">Data Kosong</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>


   @endsection

   @section('js')
   @endsection