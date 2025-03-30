@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Pendaftaran Paket : <a href="{{route('admin.paket.edit', ['id'=>$paket->id])}}">{{$paket->nama}}</a></h3>
         <p class="text-subtitle text-muted mb-0">Keberangkatan tanggal {{$paket->tanggal}} selama {{$paket->durasi}} hari</p>
         <p class="text-subtitle text-muted">Harga Rp. {{number_format($paket->harga)}}</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5><b>List Pendaftar</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <th>Nama</th>
               <th>Usia</th>
               <th>Kecamatan</th>
               <th>Progres</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($paket->pendaftarans as $p)
            <tr>
               <td>{{$p->jemaah->nama_lengkap}}</td>
               <td>{{$p->usia}}</td>
               <td>{{$p->kecamatan}}</td>
               <td>
                  <span class="badge bg-primary">{{number_format(($p->pembayaran->sum('harga') / $p->kategori->harga) * 100, 0)}}%</span>
               </td>
               <td>
                  <a href="{{route('admin.pendaftaran.detail', ['id'=>$p->id])}}" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></a>
               </td>
            </tr>
            @empty

            @endforelse
         </tbody>
      </table>

      <div class="text-end">
         <a href="{{route('admin.pendaftaran.create', ['ip' => $paket->code])}}" class="btn btn-primary">Tambah Pendaftar</a>
      </div>
   </div>
</div>


@endsection

@section('js')
@endsection