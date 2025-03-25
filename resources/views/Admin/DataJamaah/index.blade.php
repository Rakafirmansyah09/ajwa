@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Jemaah</h3>
         <p class="text-subtitle text-muted">List biodata jemaah</p>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         Tabel Jemaah
      </h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <th>Name</th>
               <th>NIK</th>
               <th>Tempat Lahir</th>
               <th>Tanggal Lahir</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($data as $j)
            <tr>
               <td>{{$j->nama_lengkap}}</td>
               <td>{{$j->nik}}</td>
               <td>{{$j->tempat_lahir}}</td>
               <td>{{$j->tanggal_lahir}}</td>
               <td>
                  <a href="{{route('admin.jemaah.edit', ['id' => $j->id])}}" class="btn btn-sm btn-outline-primary">
                     <i class="fas fa-pencil-alt"></i>
                  </a>
                  <form method="post" action="{{ route('admin.jemaah.delete') }}" class="d-inline">
                     @csrf
                     <input type="hidden" name="id" value="{{$j->id}}">
                     <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash-alt"></i>
                     </button>
                  </form>
                  <a href="{{route('admin.jemaah.detail', ['id'=>$j->id])}}" class="btn btn-sm btn-outline-info">
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