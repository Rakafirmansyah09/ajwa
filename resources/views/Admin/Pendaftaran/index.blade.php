@extends('template.index')

@section('css')
<style>
   .card-pendaftaran {
      cursor: pointer;
   }

   .card-pendaftaran:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      background-color: #c9d0e3;
   }
</style>

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>List Group Paket</h3>
         <p class="text-subtitle text-muted">List group paket umroh</p>
      </div>
   </div>
</div>

<div class="row">
   @forelse ($paket as $p)
   <div class="col-lg-4 col-md-6 mb-4">
      <div class="card shadow-sm hover-shadow card-pendaftaran" data-bs-toggle="modal" data-bs-target="#ModalPaket{{$loop->iteration}}">
         <div class="card-header bg-transparent">
            <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i><b>Paket {{$p->nama}}</b></h5>
         </div>
         <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
               <div class="d-flex gap-4">
                  <p class="mb-0"><i class="bi bi-people-fill me-2"></i>{{$p->kuota}} jemaah</p>
                  <p class="mb-0"><i class="bi bi-calendar-event me-2"></i>{{$p->durasi}} hari</p>
                  <p class="mb-0"><i class="bi bi-tag-fill me-2"></i>Rp {{number_format($p->harga, 0, ',', '.')}}</p>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="ModalPaket{{$loop->iteration}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="ModalPaket{{$loop->iteration}}Label"><b>{{$p->nama}}</b></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <!-- ====================== -->
                  <p class="mb-1 text-black"><b>Itinerary</b></p>
                  <p>
                     @forelse ($p->list_itinerary as $itinerary)
                     {{$itinerary['judul']}}{{ $loop->last ? '.' : ',' }}
                     @empty
                     Belum ada itinerary
                     @endforelse
                  </p>
                  <!-- ====================== -->
                  <p class="mb-1 text-black"><b>Fasilitas</b></p>
                  <p>
                     @forelse ($p->list_fasilitas as $fasilitas)
                     {{$fasilitas['nama']}}{{ $loop->last ? '.' : ',' }}
                     @empty
                     Belum ada Fasilitas
                     @endforelse
                  </p>
                  <!-- ====================== -->
                  <p class="mb-1 text-black"><b>Group Penerbangan</b></p>
                  <ul class="list-unstyled">
                     @forelse ($p->group as $group)
                     <li>
                        <a href="{{ route('admin.pendaftaran.addJemaah', ['id' => $group->id]) }}" class="btn btn-primary w-100 text-start mb-2 d-flex justify-content-between align-items-center">
                           <div>
                              {{$group->nama}} - {{$group->tanggal_keberangkatan}}
                           </div>
                           <div class="badge">
                              {{$group->jemaah->count()}}/{{$p->kuota}}
                           </div>
                        </a>
                     </li>
                     @empty
                     <li>Belum ada group keberangkatan</li>
                     @endforelse
                  </ul>

               </div>
            </div>
         </div>
      </div>
   </div>
   @empty
   <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
         <h4 class="alert-heading">Tidak ada paket yang aktif</h4>
         <p>Data yang kamu cari tidak ada.</p>
      </div>
   </div>
   @endforelse
</div>

@endsection

@section('js')
@endsection