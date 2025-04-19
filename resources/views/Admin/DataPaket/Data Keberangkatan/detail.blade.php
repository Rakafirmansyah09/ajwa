@extends('template.index', ['pageTitle' => 'Detail Data Paket'])

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Paket : <a href="{{route('admin.paket.detail', ['id'=>$paket->id])}}">{{$paket->nama}}</a></h3>
         <h5>Keberangkatan : {{$keberangkatan->tanggal_keberangkatan}} - {{$keberangkatan->tanggal_kepulangan}}</h5>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5><b>List Rombongan</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped table-hover" id="table1">
         <thead>
            <tr>
               <td>No.</td>
               <td>Nama</td>
               <td>Pembayaran</td>
               <td>Jemaah</td>
               <td>Pembatalan</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            @forelse ( $keberangkatan->rombongan as $r)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{$j->nama}}</td>
               <td></td>
               <td>{{$j->jemaah->count()}}</td>
               <td>{{$j->pembatalan?'Ya':'Tidak' }}</td>
            </tr>

            @empty
            <tr>
               <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
         </tbody>
      </table>

      <div class="mt-2 text-end">
         <a href="" class="btn btn-primary">Tambah Rombongan</a>
      </div>
   </div>
</div>



@endsection

@section('js')
@endsection