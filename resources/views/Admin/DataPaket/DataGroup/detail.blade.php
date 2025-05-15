@extends('template.index', ['pageTitle' => 'Detail Data Paket'])

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-8 order-md-1 order-last mb-3">
         <h3>Paket {{$paket->nama}} - {{$group->nama}}</h3>
         <p class="text-subtitle text-muted mb-1">Keberangkatan {{$group->tanggal_keberangkatan}} - {{$group->tanggal_kepulangan}}</p>
         <!-- tombol kembali -->
         <a href="{{route('admin.paket.detail', ['id'=>$paket->id])}}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
         </a>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Jadwal Penerbangan</b></h5>
      <a href="{{route('admin.group.editPenerbangan', ['id' => $group->id])}}" class="btn btn-sm btn-info"><b>Edit Penerbangan</b></a>

   </div>

   <div class="card-body">
      <table class="table table-borderless table-striped table-hover">
         <thead>
            <tr class="bg-primary-subtle">
               <td>No.</td>
               <td>Judul</td>
               <td>Maskapai</td>

               <td>Penerbangan</td>

               <td>Lama Penerbangan</td>
               <td>Bagasi</td>
               <td>Kursi</td>

            </tr>
         </thead>
         <tbody>

            @forelse ($group->list_penerbangan as $penerbangan)
            <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$penerbangan->judul}}</td>
               <td>{{$penerbangan->maskapai}}</td>
               <!-- ----- -->
               <td>
                  <p>{{$penerbangan->tanggal_berangkat}} | {{$penerbangan->kota_asal}} | {{$penerbangan->bandara_asal}}</p>
                  <p>{{$penerbangan->tanggal_tiba}} | {{$penerbangan->kota_tujuan}} | {{$penerbangan->bandara_tujuan}}</p>
               </td>
               <!-- ----- -->
               <td>{{$penerbangan->lama_penerbangan}}</td>
               <td>{{$penerbangan->bagasi}} kg <br> {{$penerbangan->bagasi_kabin}} kg kabin</td>
               <td>{{$penerbangan->kursi}}</td>
            </tr>
            @empty
            <tr>
               <td colspan="11" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
         </tbody>
      </table>
   </div>

</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Akomodasi</b></h5>
      <a href="{{route('admin.group.editAkomodasi', ['id' => $group->id])}}" class="btn btn-sm btn-info"><b>Edit Akomodasi</b></a>
   </div>

   <div class="card-body">
      <table class="table table-borderless table-striped table-hover">
         <thead>
            <tr class="bg-primary-subtle">
               <td>No.</td>
               <td>Nama Hotel</td>
               <td>Kota</td>
               <td>Alamat</td>
               <td>Tanggal Checkin</td>
               <td>Tanggal Checkout</td>
               <td>Rating</td>
            </tr>
         </thead>
         <tbody>
            @forelse ( $group->list_akomodasi as $akomodasi )
            <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$akomodasi->nama_hotel}}</td>
               <td>{{$akomodasi->kota}}</td>
               <td>{{$akomodasi->alamat}}</td>
               <td>{{$akomodasi->tanggal_checkin}}</td>
               <td>{{$akomodasi->tanggal_checkout}}</td>
               <td>{{$akomodasi->rating}}</td>
            </tr>
            @empty
            <tr>
               <td colspan="11" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
         </tbody>
      </table>
   </div>
</div>





@endsection

@section('js')
@endsection