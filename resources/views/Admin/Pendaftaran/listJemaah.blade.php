@extends('template.index', ['pageTitle' => 'Detail Data Paket'])

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last mb-3">
         <h3>Paket {{$paket->nama}} - {{$group->nama}}</h3>
         <p class="text-subtitle text-muted mb-1">Keberangkatan {{$group->tanggal_keberangkatan}} - {{$group->tanggal_kepulangan}}</p>
         <!-- tombol kembali -->
         <a href="{{route('admin.pendaftaran')}}" class="btn btn-sm btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
         </a>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5><b>List Jemaah</b></h5>
   </div>
   <div class="card-body">
      <table class="table table-striped table-hover" id="table1">
         <thead>
            <tr>
               <td>No.</td>
               <td>Nama</td>
               <td>Usia</td>
               <td>Jenis Kelamin</td>
               <td>Pembayaran</td>
               <td>Pembatalan</td>
               <td>Aksi</td>
            </tr>
         </thead>
         <tbody>
            @forelse ( $group->jemaah as $j)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{$j->bioJemaah->nama_lengkap}}</td>
               <td>{{$j->usia}}</td>
               <td>{{$j->bioJemaah->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan'}}</td>
               @php
               $totalBayar = $j->pembayaran ? $j->pembayaran->sum('harga') : 0;
               @endphp
               <td>
                  Rp. {{ number_format($totalBayar, 0, ',', '.') }} /
                  Rp. {{ number_format($group->paket->harga, 0, ',', '.') }}
               </td>
               <td>{{$j->pembatalan ? 'Dibatalkan' : '-'}}</td>
               <td>
                  <a href="{{route('admin.group.jemaah.detail', ['id' => $j->id])}}" class="btn btn-sm btn-info" target="_blank">
                     <b>Detail</b>
                  </a>
                  <form action="{{route('admin.group.jemaah.delete')}}" method="post" class="d-inline">
                     @csrf
                     <input type="hidden" name="idJemaah" value="{{$j->id}}">
                     <button type="submit" class="btn btn-sm btn-danger">
                        <b>Hapus</b>
                     </button>
                  </form>
               </td>
            </tr>

            @empty
            <tr>
               <td colspan="7" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
         </tbody>
      </table>

      <div class="mt-2 text-end">
         <a href="{{route('admin.group.addJemaah', ['id' => $group->id])}}" class="btn btn-primary">Tambah Jamaah</a>
      </div>
   </div>
</div>



@endsection

@section('js')
@endsection