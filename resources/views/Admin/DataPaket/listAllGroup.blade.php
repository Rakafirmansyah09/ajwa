@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Group Paket</h3>
         <p class="text-subtitle text-muted">Data group paket haji dan umroh aktif</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between">
      <h5 class="card-title">
         Tabel Group Paket
      </h5>
   </div>
   <div class="card-body">
      <div class="tabel-responsive">
         <table class="table table-striped" id="table1">
            <thead>
               <tr class="bg-primary-subtle">
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Tanggal Keberangkatan</th>
                  <th>Tanggal Kepulangan</th>
                  <th>Jamaah</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach($groups as $item)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{ \Carbon\Carbon::parse($item->tanggal_keberangkatan)->format('d M Y') }}</td>
                  <td>{{ $item->tanggal_kepulangan ? \Carbon\Carbon::parse($item->tanggal_kepulangan)->format('d M Y') : '-' }}</td>
                  <td>{{ $item->jemaah->count() }} / {{$item->paket->kuota}}</td>
                  <td>
                     <form method="post" action="{{ route('admin.group.delete') }}" class="d-inline">
                        @csrf
                        <input type="hidden" name="keberangkatan_id" value="{{$item->id}}">
                        <button type="submit" class="btn btn-danger btn-sm">
                           <!-- <i class="fas fa-trash-alt"></i> -->
                           <b>Hapus</b>
                        </button>
                     </form>
                     <a href="{{route('admin.group.edit', ['id' => $item->id])}}" class="btn btn-sm btn-warning">
                        <!-- <i class="fas fa-pencil-alt"></i> -->
                        <b>Edit</b>
                     </a>
                     <a href="{{route('admin.group.listJemaah', ['id' => $item->id])}}" class="btn btn-sm btn-info">
                        <!-- <i class="fas fa-info-circle"></i> -->
                        <b>Detail</b>
                     </a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="d-flex justify-content-center mt-3">
         {{ $groups->links('pagination::bootstrap-5') }}
      </div>

   </div>
</div>

@endsection

@section('js')
@endsection