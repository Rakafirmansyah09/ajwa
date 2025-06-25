@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Biodata Jamaah</h3>
         <p class="text-subtitle text-muted">List biodata jamaah</p>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title">
         Tabel Jamaah
      </h5>
      <form class="d-flex" method="GET" action="{{ route('admin.biojemaah.list') }}">
         <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Nama/NIK jemaah...">
         <button type="submit" class="btn btn-sm btn-primary ms-2">Cari</button>
      </form>
   </div>
   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <th>No. </th>
               <th>Nama</th>
               <th>Akun</th>
               <th>Jenis Kelamin</th>
               <th>Tempat Lahir</th>
               <th>Tanggal Lahir</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @forelse($data as $j)
            <tr>
               <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
               <td>{{$j->nama_lengkap}}</td>
               <td>{{$j->email}}</td>
               <td>{{$j->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
               <td>{{$j->tempat_lahir}}</td>
               <td>{{$j->tanggal_lahir}}</td>
               <td>
                  <form method="post" action="{{ route('admin.biojemaah.delete') }}" class="d-inline">
                     @csrf
                     <input type="hidden" name="id" value="{{$j->id}}">
                     <button
                        type="submit"
                        class="btn btn-sm btn-danger"
                        onclick="confirmDanger('Hapus Biodata Jemaah', 
                           'Yakin akan menghapsu jemaah : {{$j->nama_lengkap}}?', 
                           ()=>{this.form.submit();})"><b>Hapus</b></button>
                  </form>
                  <a href="{{route('admin.biojemaah.detail', ['id'=>$j->id])}}" class="btn btn-sm btn-info">
                     <!-- <i class="fas fa-info-circle"></i> -->
                     <b>Detail</b>
                  </a>
               </td>
            </tr>
            @empty

            <tr>
               <td colspan="7" class="text-center"><i>Data tidak ditemukan</i></td>
            </tr>

            @endforelse
         </tbody>
      </table>
      <div class="d-flex justify-content-center mt-3">
         {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
      </div>

   </div>
</div>


@endsection

@section('js')
@endsection