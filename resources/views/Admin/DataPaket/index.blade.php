@extends('template.index', ['pageTitle' => 'Data Paket'])

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
   <div class="card-header">
      <h5 class="card-title">
         Tabel Paket
      </h5>
   </div>
   <div class="card-body">
      <table class="table table-striped table-hover" id="table1">
         <thead>
            <tr>
               <th>No.</th>
               <th>Code</th>
               <th>Name</th>
               <th>Keberangkatan</th>
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
               <td>{{$j->paket_keberangkatan->count()}} Keberangkatan</td>
               <td>{{$j->durasi}} hari</td>
               <td>{{$j->kuota}} jemaah</td>
               <td>Rp. {{ number_format($j->harga)}}</td>
               <td>
                  <a href="{{route('admin.paket.edit', ['id' => $j->id]) }}" class="btn btn-outline-primary btn-sm">
                     <i class="fas fa-pencil-alt"></i>
                  </a>
                  <form method="post" action="{{ route('admin.paket.delete') }}" class="d-inline">
                     @csrf
                     <input type="hidden" name="id" value="{{$j->id}}">
                     <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                     </button>
                  </form>
                  <a href="{{route('admin.paket.detail', ['id' => $j->id])}}" class="btn btn-outline-info btn-sm">
                     <i class="fas fa-info-circle"></i>
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