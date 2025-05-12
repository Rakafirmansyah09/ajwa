@extends('template.index')

@section('css')
<link rel="stylesheet" href="{{ asset('mazer/extensions/sweetalert2/sweetalert2.css') }}">
<style>
   /* style untuk tabel */
   .table-custom td {
      padding-top: 2px;
      padding-bottom: 2px;
   }

   .table-custom .tdNamaFile {
      width: 100px;
   }

   .table-custom .tdPembatas {
      width: 70px;
      text-align: center;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Detail Pendaftaran Jemaah </h3>
         <p class="text-subtitle text-muted">Data jemaah dalam group {{$group->nama}} - {{$group->paket->nama}}</p>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-12 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5><b>Jemaah</b></h5>
         </div>
         <div class="card-body">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>Nama Lengkap</td>
                  <td>:</td>
                  <td>{{$jemaah->bioJemaah->nama_lengkap}}</td>
               </tr>
               <tr>
                  <td>Rombongan</td>
                  <td>:</td>
                  @if($jemaah->rombongan_id == null)
                  <td>Belum ada rombongan</td>
                  @else
                  <td>{{$jemaah->ketuaRombongan->bioJemaah->nama_lengkap}}</td>
                  @endif
               </tr>
               <tr>
                  <td>Usia</td>
                  <td>:</td>
                  <td>{{$jemaah->usia}}</td>
               </tr>
               <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>{{$jemaah->bioJemaah->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
   <div class="col-12 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5><b>Paket</b></h5>
         </div>
         <div class="card-body">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>Nama Paket</td>
                  <td>:</td>
                  <td>{{$group->paket->nama}}</td>
               </tr>
               <tr>
                  <td>Group</td>
                  <td>:</td>
                  <td>{{$group->nama}}</td>
               </tr>
               <tr>
                  <td>Usia</td>
                  <td>:</td>
                  <td>{{$group->tanggal_keberangkatan}}</td>
               </tr>
               <tr>
                  <td>Harga</td>
                  <td>:</td>
                  <td>Rp {{ number_format($group->paket->harga, 0, ',', '.') }}</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <!-- ====================== -->
      <div class="row">
         <div class="col-12 col-md-3">
            <h5><b>Sales</b></h5>
            <p>{{$jemaah->infoSales->label }} - {{$jemaah->infoSales->nama}} - {{$jemaah->detail_info}}</p>
         </div>
         <div class="col-12 col-md-7">
            <h5><b>Pembayaran</b></h5>
            <p>Total : Rp {{ number_format($jemaah->pembayaran->sum('harga'), 0, ',', '.') }} / Rp {{ number_format($group->paket->harga, 0, ',', '.') }}</p>
            @php
            $progress = ($jemaah->pembayaran->sum('harga') / $group->paket->harga) * 100;
            @endphp
            <div class="progress" style="height: 20px;">
               <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($progress, 1) }}%</div>
            </div>
         </div>
         <div class="col-12 col-md-2">
            <!-- batal pendaftaran -->
            <a href="" class="btn btn-sm btn-warning w-100 mb-2 mt-3 mt-md-0">
               <b>Batalkan Pendaftaran</b>
            </a>
            <!-- ganti group paket -->
            <a href="" class="btn btn-sm btn-warning w-100 mb-2 @if($jemaah->id_rombongan) disabled @endif">
               <b>Ganti Group Keberangkatan</b>
            </a>
            <!-- batal Rombongan -->
            @if($jemaah->id_rombongan)
            <a href="#" data-url="{{ route('admin.jemaah.deleteRombongan', ['idJemaah' => $jemaah->id]) }}"
               onclick="confirmDelete(event, this)" class="btn btn-sm btn-danger w-100 mb-2">
               <b>Keluar Rombongan</b>
            </a>

            <script>
               function confirmDelete(event, el) {
                  event.preventDefault(); // Mencegah link langsung dieksekusi

                  const url = el.dataset.url;

                  Swal.fire({
                     title: 'Apakah Anda yakin?',
                     text: "Anda akan mengeluarkan jemaah dari rombongan!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Ya, keluarkan!',
                     cancelButtonText: 'Batal'
                  }).then((result) => {
                     if (result.isConfirmed) {
                        window.location.href = url;
                     }
                  });
               }
            </script>

            @else
            <a href="" class="btn btn-sm btn-warning w-100 mb-2" data-bs-toggle="modal" data-bs-target="#default">
               <b>Tambah Rombongan</b>
            </a>
            <div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Basic Modal</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                           </svg>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form action="{{route('admin.jemaah.addRombongan')}}" method="post" id="form-tambah-rombongan">
                           @csrf
                           <div class="form-group">
                              <input type="hidden" name="idJemaah" value="{{$jemaah->id}}">
                              <label for="ketuaRombongan">Jemaah</label>
                              <select name="ketuaRombongan" id="ketuaRombongan" class="form-control" required>
                                 <option value="" selected disabled> Pilih Rombongan Jemaah </option>
                                 @foreach ($ketuaRombongan as $ketua)
                                 <option value="{{$ketua->id}}">{{$ketua->bioJemaah->nama_lengkap }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </form>
                        <div class="modal-footer">
                           <button type="button" class="btn" data-bs-dismiss="modal">
                              <i class="bx bx-x d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Close</span>
                           </button>
                           <button type="submit" class="btn btn-primary ms-1" form="form-tambah-rombongan">
                              <i class="bx bx-check d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Accept</span>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
            @endif
         </div>
         <!-- ====================== -->
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Riwayat Pembayaran</b></h5>
      <a href="{{route('admin.jemaah.addPembayaran', ['id' => $jemaah->id])}}" class="btn btn-sm btn-info"><b>Tambah Pembayaran</b></a>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-borderless table-striped ">
            <thead>
               <tr class="bg-primary-subtle">
                  <td>No. </td>
                  <td>Tanggal</td>
                  <td>Dibayar Oleh</td>
                  <td>Harga</td>
                  <td>Bukti</td>
                  <td>Method</td>
                  <td>Status</td>
                  <td></td>
               </tr>
            </thead>
            <tbody>
               @forelse ( $jemaah->pembayaran as $item)
               <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->dibayar_oleh}}</td>
                  <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                  <td>
                     <a href="{{asset($item->bukti)}}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                  </td>
                  <td>{{$item->method}}</td>
                  <td>{{$item->status}}</td>
                  <td>
                     <form action="{{route('admin.jemaah.deletePembayaran')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <button type="submit" style="border: none;">
                           <i class="fas fa-trash-alt" style="color: #ff0000;"></i>
                        </button>
                     </form>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="8" class="text-center">Data Kosong</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>


   @endsection

   @section('js')
   <script src="{{asset('mazer/extensions/sweetalert2/sweetalert2.all.js')}}"></script>
   @endsection