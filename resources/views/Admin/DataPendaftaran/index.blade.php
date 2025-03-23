@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Pemdaftaran</h3>
         <p class="text-subtitle text-muted">Data pendaftaran umroh dan haji</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         Tabel Pendaftaran
      </h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <th>Kategori</th>
               <th>Nama</th>
               <th>Progres</th>
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
                  <a href=""><span class="fa-fw select-all fas"></span></a>
                  <a href="google.com"><span class="fa-fw select-all fas"></span></a>
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