@extends('template.index', ['pageTitle' => 'Detail Data Paket'])

@section('css')
<style>
   /* style untuk tabel */
   .table-custom tbody tr td {
      padding-top: 2px;
      padding-bottom: 2px;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Paket : {{$paket->nama}}</h3>
         <p class="text-subtitle text-muted mb-0">Keberangkatan {{$paket->kuota}} jemaah, selama {{$paket->durasi}} hari</p>
         <p class="text-subtitle text-muted">Harga Rp. {{number_format($paket->harga)}}</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5><b>Detail Paket</b></h5>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-md-4">
            <table class="table table-borderless table-custom mb-0">
               <tbody>
                  <tr>
                     <td>Kode Paket</td>
                     <td>:</td>
                     <td>{{$paket->code}}</td>
                  </tr>
                  <tr>
                     <td>Nama Paket</td>
                     <td>:</td>
                     <td>{{$paket->nama}}</td>
                  </tr>
                  <tr>
                     <td>Durasi</td>
                     <td>:</td>
                     <td>{{$paket->durasi}} Hari</td>
                  </tr>
                  <tr>
                     <td>Harga</td>
                     <td>:</td>
                     <td>Rp. {{number_format($paket->harga)}}</td>
                  </tr>
                  <tr>
                     <td>Kuota</td>
                     <td>:</td>
                     <td>{{$paket->kuota}} Jemaah</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-md-8">
            <table class="table table-borderless table-custom">
               <tbody>
                  <tr>
                     <td>Detail</td>
                     <td>:</td>
                     <td>{{$paket->detail}}</td>
                  </tr>
               </tbody>
            </table>
         </div>

      </div>
   </div>
</div>
<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseFasilitas" style="cursor: pointer;">
      <h5><b>Fasilitas</b></h5>
      <button class="btn btn-sm btn-outline-secondary">
         <i class="fas fa-chevron-down"></i>
      </button>
   </div>
   <div class="card-body pb-2">
      <div class="collapse" id="collapseFasilitas">
         <table class="table table-striped table-cutom">
            <thead>
               <tr class="bg-primary-subtle">
                  <td>No. </td>
                  <td></td>
               </tr>
            </thead>
            <tbody>

            </tbody>
         </table>
         <div class="d-flex justify-content-end mt-3 pb-3">
            <a href="{{route('admin.paket.editFasilitas', ['id' => $paket->id])}}" class="btn btn-info btn-sm">
               <b>Edit Fasilitas</b>
            </a>
         </div>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseItinerary" style="cursor: pointer;">
      <h5><b>Itinerary</b></h5>
      <button class="btn btn-sm btn-outline-secondary">
         <i class="fas fa-chevron-down"></i>
      </button>
   </div>
   <div class="card-body pb-2">
      <div class="collapse" id="collapseItinerary">
         <table class="table table-striped table-cutom">
            <thead>
               <tr class="bg-primary-subtle">
                  <td>No. </td>
                  <td>Tanggal</td>
                  <td>Tujuan</td>
                  <td>Deskripsi</td>
                  <td>Lokasi</td>
               </tr>
            </thead>
            <tbody>

            </tbody>

         </table>
         <div class="d-flex justify-content-end mt-3 pb-3">
            <button class="btn btn-info btn-sm">
               <b>Edit Fasilitas</b>
            </button>
         </div>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-header">
      <h5><b>List Keberangkatan</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr class="bg-primary-subtle">
               <th>No.</th>
               <th>Nama</th>
               <th>Tanggal Keberangkatan</th>
               <th>Tanggal Kepulangan</th>
               <th>Jemaah</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @foreach($paket->group as $item)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{$item->nama}}</td>
               <td>{{ \Carbon\Carbon::parse($item->tanggal_keberangkatan)->format('d M Y') }}</td>
               <td>{{ $item->tanggal_kepulangan ? \Carbon\Carbon::parse($item->tanggal_kepulangan)->format('d M Y') : '-' }}</td>
               <td>{{ $item->jemaah->count() }} / {{$paket->kuota}}</td>
               <td>
                  <form method="post" action="{{ route('admin.group.delete') }}" class="d-inline">
                     @csrf
                     <input type="hidden" name="keberangkatan_id" value="{{$item->id}}">
                     <button type="submit" class="btn btn-danger btn-sm">
                        <!-- <i class="fas fa-trash-alt"></i> -->
                        <b>Hapus</b>
                     </button>
                  </form>
                  <a href="{{route('admin.group.edit', ['id' => $item->id])}}" class="btn btn-sm btn-primary">
                     <!-- <i class="fas fa-pencil-alt"></i> -->
                     <b>Edit</b>
                  </a>
                  <a href="{{route('admin.group.detail', ['id' => $item->id])}}" class="btn btn-sm btn-info">
                     <!-- <i class="fas fa-info-circle"></i> -->
                     <b>Detail</b>
                  </a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>

      <div class="text-end mt-3">
         <a href="{{ route('admin.group.create', ['id' => $paket->id]) }}" class="btn btn-primary">Tambah Keberangkatan</a>
      </div>
   </div>
</div>



@endsection

@section('js')
@endsection