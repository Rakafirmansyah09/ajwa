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
         <div class="card-header d-flex justify-content-between align-items-center">
            <h5><b>Jemaah</b></h5>
            @if ($jemaah->pembatalan)
            <span class="badge bg-danger">Dibatalkan</span>
            @endif
         </div>
         <div class="card-body">
            <table class="table table-borderless table-custom">
               <tr>
                  <td>Nama Lengkap</td>
                  <td>:</td>
                  <td>{{$jemaah->bioJemaah->nama_lengkap ?? '-'}} </td>
               </tr>
               <tr>
                  <td>Rombongan</td>
                  <td>:</td>
                  @if($jemaah->id_rombongan == null)
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
                  <td>Tanggal Keberangkatan</td>
                  <td>:</td>
                  <td>{{ \Carbon\Carbon::parse($group->tanggal_keberangkatan)->translatedFormat('d F Y') }}</td>
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
            $totalBayar = $jemaah->pembayaran->sum('harga');
            $hargaPaket = $group->paket->harga;
            $progress = ($hargaPaket > 0) ? ($totalBayar / $hargaPaket) * 100 : 0;
            @endphp

            <div class="progress" style="height: 20px;">
               <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($progress, 1) }}%</div>
            </div>
         </div>
         <div class="col-12 col-md-2">
            <!-- batal pendaftaran -->
            @if($jemaah->pembatalan)
            <a href="" class="btn btn-sm btn-warning w-100 mb-2 mt-3 mt-md-0" data-url="{{ route('admin.jemaah.lanjuttBerangkat', ['id' => $jemaah->id]) }}"
               onclick="confirmPendaftaran(event, this)">
               <b>Lanjutkan Pendaftaran</b>
            </a>
            @else
            <a href="" class="btn btn-sm btn-danger w-100 mb-2 mt-3 mt-md-0" data-bs-toggle="modal" data-bs-target="#modal-batal-keberangkatan">
               <b>Batalkan Pendaftaran</b>
            </a>
            <div class="modal fade text-left" id="modal-batal-keberangkatan" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Batal Keberangkatan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                           </svg>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form action="{{route('admin.jemaah.batalBerangkat', ['id' => $jemaah->id])}}" method="post" id="form-batal-keberangkatan">
                           @csrf
                           <div class="form-group">
                              <label for="alasan_pembatalan" class="form-label">Alasan Pembatalan</label>
                              <textarea name="alasan_pembatalan" id="alasan_pembatalan" class="form-control" rows="4" required></textarea>
                           </div>
                        </form>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                           <i class="bx bx-x d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" form="form-batal-keberangkatan">
                           <i class="bx bx-check d-block d-sm-none"></i>
                           <span class="d-none d-sm-block">Accept</span>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            @endif

            <a href="{{ route('invoice.show', $jemaah->id) }}" target="_blank" class="btn btn-sm btn-primary w-100 mb-2 mt-3 mt-md-0">
               <i class="bi bi-receipt"></i> Lihat Invoice
            </a>

            <!-- batal Rombongan -->
            @if($jemaah->id_rombongan)
            <a href="#" data-url="{{ route('admin.jemaah.deleteRombongan', ['idJemaah' => $jemaah->id]) }}"
               onclick="confirmDelete(event, this)" class="btn btn-sm btn-danger w-100 mb-2">
               <b>Keluar Rombongan</b>
            </a>

            <a href="" class="btn btn-sm btn-primary w-100 mb-2 mt-3 mt-md-0" data-bs-toggle="modal" data-bs-target="#modal-list-anggota-rombongan">
               <b>Anggota Rombongan</b>
            </a>
            <div class="modal fade text-left" id="modal-list-anggota-rombongan" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Anggota Rombongan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                           </svg>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead>
                                 <tr class="bg-primary-subtle">
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Usia</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Pembayaran</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse ( $memberRombongan as $j)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$j->bioJemaah->nama_lengkap}}</td>
                                    <td>{{$j->usia}}</td>
                                    <td>{{$j->bioJemaah->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
                                    @php
                                    $totalBayar = $j->pembayaran ? $j->pembayaran->sum('harga') : 0;
                                    @endphp
                                    <td>
                                       Rp. {{ number_format($totalBayar, 0, ',', '.') }} /
                                       Rp. {{ number_format($group->paket->harga, 0, ',', '.') }}
                                    </td>
                                 </tr>

                                 @empty
                                 <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                 </tr>
                                 @endforelse
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            @else
            <a href="" class="btn btn-sm btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#modal-tambah-rombongan">
               <b>Tambah Rombongan</b>
            </a>
            <div class="modal fade text-left" id="modal-tambah-rombongan" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Tambahkan ke rombongan</h5>
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
      <a href="{{route('admin.jemaah.addPembayaran', ['id' => $jemaah->id])}}" class="btn btn-sm btn-primary"><b>Tambah Pembayaran</b></a>
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

      function confirmPendaftaran(event, el) {
         event.preventDefault(); // Mencegah link langsung dieksekusi

         const url = el.dataset.url;

         Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan melanjutkan pendaftaran jemaah!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjutkan!',
            cancelButtonText: 'Batal'
         }).then((result) => {
            if (result.isConfirmed) {
               window.location.href = url;
            }
         });
      }
   </script>
   @endsection