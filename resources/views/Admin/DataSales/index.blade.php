@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Sales</h3>
         <p class="text-subtitle text-muted">Data sales haji dan umroh</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title">
         Tabel Sales
      </h5>
      <a href="{{route('admin.sales.create')}}" class="btn btn-sm btn-primary"><b>Tambah Sales</b></a>
   </div>
   <div class="card-body">
      <table class="table table-striped table-hover" id="table1">
         <thead>
            <tr>
               <th>No.</th>
               <th>Label</th>
               <th>Nama</th>
               <th>Aktif</th>
               <th>Deskripsi</th>
               <th>Jemaah</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($data as $d)
            <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$d->label}}</td>
               <td>{{$d->nama}}</td>
               <td>{{ $d->aktif ? 'Ya' : 'Tidak'}}</td>
               <td>{{$d->deskripsi}}</td>
               <td>{{$d->jemaahSales->count()}}</td>
               <td>
                  <a href="{{route('admin.sales.edit', $d->id)}}" class="btn btn-warning btn-sm">
                     <b>Edit</b>
                  </a>
                  <a href="{{route('admin.sales.detail', $d->id)}}" class="btn btn-info btn-sm">
                     <b>Detail</b>
                  </a>
                  <form method="post" action="{{ route('admin.sales.delete') }}" class="d-inline">
                     @csrf
                     <input type="hidden" name="id" value="{{$d->id}}">
                     <button type="submit" class="btn btn-danger btn-sm">
                        <b>Hapus</b>
                     </button>
                  </form>
               </td>
            </tr>
            @empty
            <tr>
               <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse

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