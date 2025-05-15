@extends('template.index')

@section('css')
<style>
   /* style untuk tabel */
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Detail Sales</h3>
         <p class="text-subtitle text-muted mb-0">Detail {{$sales->kantor}} - {{$sales->label}} - {{ $sales->nama }}</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>List Jemaah Sales</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <td>No.</td>
               <td>Nama</td>
               <td>Paket</td>
               <td>Detail</td>
               <td>Tanggal</td>
               <td></td>
            </tr>
         </thead>
         <tbody>
            @forelse ($jemaahSales as $jemaah)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $jemaah->bioJemaah->nama_lengkap }}</td>
               <td>{{ $jemaah->group->nama }}</td>
               <td>{{ $jemaah->detail_info }}</td>
               <td>{{ $jemaah->created_at }}</td>
               <td>
                  <a href="{{route('admin.jemaah.detail', ['id'=> $jemaah->id])}}" class="btn btn-info btn-sm" target="_blank"><b>Lihat</b></a>
               </td>
            </tr>
            @empty
            <tr>
               <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
         </tbody>
         <div class="d-flex justify-content-center mt-3">
            {{ $jemaahSales->links('pagination::bootstrap-5') }}
         </div>
      </table>
   </div>
</div>

@endsection

@section('js')
@endsection