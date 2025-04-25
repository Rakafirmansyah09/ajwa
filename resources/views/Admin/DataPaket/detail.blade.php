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
         <h3>Paket {{$paket->nama}}</h3>
         <p class="text-subtitle text-muted mb-0">Keberangkatan {{$paket->kuota}} jemaah, selama {{$paket->durasi}} hari</p>
         <p class="text-subtitle text-muted">Harga Rp. {{number_format($paket->harga)}}</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Detail Paket</b></h5>
      <a href="{{route('admin.paket.edit', ['id' => $paket->id])}}" class="btn btn-sm btn-info"><b>Edit Detail Paket</b></a>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-md-4">
            <table class="table table-borderless table-custom mb-0">
               <tbody>
                  <tr>
                     <td class="fw-bold">Kode Paket</td>
                     <td>:</td>
                     <td>{{$paket->code}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Nama Paket</td>
                     <td>:</td>
                     <td>{{$paket->nama}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Durasi</td>
                     <td>:</td>
                     <td>{{$paket->durasi}} Hari</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Harga</td>
                     <td>:</td>
                     <td>Rp. {{number_format($paket->harga)}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Kuota</td>
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
                     <td class="fw-bold">Detail</td>
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
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Fasilitas</b></h5>
      <a href="{{route('admin.paket.editFasilitas', ['id' => $paket->id])}}" class="btn btn-info btn-sm">
         <b>Edit Fasilitas</b>
      </a>
   </div>
   <div class="card-body pb-2">
      <table class="table table-striped table-cutom">
         <thead>
            <tr class="bg-primary-subtle">
               <td style="width: 50px;">No. </td>
               <td></td>
            </tr>
         </thead>
         <tbody>
            @forelse ($paket->list_fasilitas as $f)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $f['nama'] }}</td>
            </tr>
            @empty
            <tr>
               <td colspan="2" class="text-center">Tidak ada fasilitas</td>
            </tr>
            @endforelse

         </tbody>
      </table>
   </div>
</div>
<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Itinerary</b></h5>
      <a href="{{route('admin.paket.editItinerary', ['id' => $paket->id])}}" class="btn btn-sm btn-info">
         <b>Edit Itinery</b>
      </a>
   </div>
   <div class="card-body pb-2">
      <table class="table table-striped table-cutom">
         <thead>
            <tr class="bg-primary-subtle">
               <td>No. </td>
               <td>Judul</td>
               <td>Deskripsi</td>
               <td>Lokasi</td>
            </tr>
         </thead>
         <tbody>
            @forelse ($paket->list_itinerary as $it)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $it['judul'] }}</td>
               <td>{{ $it['deskripsi'] }}</td>
               <td>{{ $it['lokasi'] }}</td>
            </tr>
            @empty
            <tr>
               <td colspan="5" class="text-center">Tidak ada itinerary</td>
            </tr>

            @endforelse
         </tbody>

      </table>

   </div>
</div>


<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>List Keberangkatan</b></h5>
      <a href="{{ route('admin.group.create', ['id' => $paket->id]) }}" class="btn btn-sm btn-primary">
         <b>Tambah Keberangkatan</b>
      </a>

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
   </div>
</div>



@endsection

@section('js')
@endsection