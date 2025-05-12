@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Paket</h3>
         <p class="text-subtitle text-muted">Data paket haji dan umroh</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between">
      <h5 class="card-title">
         Tabel Paket
      </h5>
      <a href="{{ route('admin.paket.create') }}" class="btn btn-success">Tambah News</a>
   </div>
   <div class="card-body">
      <table class="table table-striped table-hover" id="table1">
         <thead>
            <tr>
               <th>No.</th>
               <th>Code</th>
               <th>Name</th>
               <th>Group</th>
               <th>Durasi</th>
               <th>Kuota</th>
               <th>Harga</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($data as $j)
            <tr>
               <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
               <td>{{$j->code}}</td>
               <td>{{$j->nama}}</td>
               <td>{{$j->group->count()}} Group</td>
               <td>{{$j->durasi}} hari</td>
               <td>{{$j->kuota}} jemaah</td>
               <td>Rp. {{ number_format($j->harga)}}</td>
               <td>
                  <form method="post" action="{{ route('admin.paket.delete') }}" class="d-inline">
                     @csrf
                     <input type="hidden" name="id" value="{{$j->id}}">
                     <button type="submit" class="btn btn-danger btn-sm">
                        <b>Hapus</b>
                        <!-- <i class="fas fa-trash-alt"></i> -->
                     </button>
                  </form>
                  <a href="{{route('admin.paket.edit', ['id' => $j->id, 'b' => 'admin.paket.list']) }}" class="btn btn-primary btn-sm">
                     <b>Edit</b>
                     <!-- <i class="fas fa-pencil-alt"></i> -->
                  </a>
                  <a href="{{route('admin.paket.detail', ['id' => $j->id])}}" class="btn btn-info btn-sm">
                     <b>Detail</b>
                     <!-- <i class="fas fa-info-circle"></i> -->
                  </a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
      <div class="d-flex justify-content-center mt-3">
         {{ $data->links('pagination::bootstrap-5') }}
      </div>

   </div>
</div>

@endsection

@section('js')
@endsection