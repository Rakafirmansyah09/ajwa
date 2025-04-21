@extends('template.index', ['pageTitle' => 'Detail Data Paket'])

@section('css')

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
      <h5><b>List Keberangkatan</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
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