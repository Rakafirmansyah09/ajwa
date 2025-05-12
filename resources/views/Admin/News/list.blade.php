@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>List Berita</h3>
         <p class="text-subtitle text-muted">List berita</p>
      </div>
   </div>
</div>


<div class="card">
   <div class="card-header d-flex justify-content-between">
      <h5 class="card-title">
         Tabel Berita
      </h5>
      <a href="{{ route('admin.news.create') }}" class="btn btn-success">Tambah News</a>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-striped table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Judul</th>
                  <th>Gambar</th>
                  <th>Author</th>
                  <th>Status</th>
                  <th>Tanggal Publish</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $index => $berita)
               <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $berita->judul }}</td>
                  <td>
                     @if($berita->gambar)
                     <img src="{{ asset($berita->gambar) }}" alt="Gambar" width="80">
                     @else
                     <span class="text-muted">Tidak ada</span>
                     @endif
                  </td>
                  <td>{{ $berita->author }}</td>
                  <td>
                     <span class="badge bg-{{ $berita->status == 'publish' ? 'success' : 'secondary' }}">
                        {{ ucfirst($berita->status) }}
                     </span>
                  </td>
                  <td>{{ \Carbon\Carbon::parse($berita->tanggal_publish)->format('d M Y') }}</td>
                  <td>
                     <a href="{{ route('admin.news.edit', ['id' => $berita->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                     <form action="{{ route('admin.news.delete') }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                        @csrf
                        <input type="hidden" name="id" value="{{$berita->id}}">
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                     </form>
                     <!-- tombol show dan publis -->
                     <a href="{{ route('admin.news.detail', ['id' => $berita->id]) }}" class="btn btn-sm btn-info">Lihat</a>
                     @if($berita->status == 'draft')
                     <a href="{{ route('admin.news.publish', ['id' => $berita->id]) }}" class="btn btn-sm btn-success">Publish</a>
                     @endif
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="7" class="text-center">Tidak ada data berita</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
      <div class="d-flex justify-content-center mt-3">
         {{ $data->links('pagination::bootstrap-5') }}
      </div>
   </div>
</div>


@endsection

@section('js')
@endsection