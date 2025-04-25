@extends('template.index', ['pageTitle' => 'Data Biodata Jemaah'])

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>List Group Paket</h3>
         <p class="text-subtitle text-muted">List group pekat umroh</p>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         list Group Aktif
      </h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <td>No. </td>
               <td>Nama Paket</td>
               <td>Group</td>
               <td>Kuota</td>
               <td>Harga</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            @forelse ($group as $g)
            <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$g->paket->nama}}</td>
               <td>{{$g->nama}}</td>
               <td>{{$g->jemaah->count()}} / {{$g->paket->kuota}} Jemaah</td>
               <td>Rp {{number_format($g->paket->harga)}}</td>
               <td>
                  <a href="{{route('admin.group.listJemaah', ['id' => $g->id])}}" class="btn btn-sm btn-info">
                     <b>Detail</b>
                  </a>
                  <a href="{{route('admin.group.addJemaah', ['id' => $g->id])}}" class="btn btn-sm btn-success">
                     <b>Tambah Jemaah</b>
                  </a>
               </td>
            </tr>
            @empty
            <tr>
               <td colspan="6" class="text-center">Data Kosong</td>
            </tr>
            @endforelse
         </tbody>
      </table>
   </div>
</div>


@endsection

@section('js')
@endsection