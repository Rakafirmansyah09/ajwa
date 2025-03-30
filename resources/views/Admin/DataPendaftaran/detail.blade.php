@extends('template.index')

@section('css')
<style>
   .box {
      padding: 15px;
      border-radius: 10px;
      background: #f8f9fa;
      margin-bottom: 15px;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Detail Pendaftaran</h3>
         <p class="text-subtitle text-muted">Informasi lengkap pendaftaran jemaah</p>
      </div>
   </div>
</div>

<div class="row">
   <!-- Biodata Jemaah -->
   <div class="col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">Biodata Jemaah</h5>
         </div>
         <div class="card-body">
            <div class="tabel-responsive">
               <table>
                  <tr>
                     <td class="fw-bold">Nama</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->jemaah->nama_lengkap}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">NIK</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->jemaah->nik}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Tempat Lahir</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->jemaah->tempat_lahir}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Alamat</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->alamat}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Kecamatan</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->kecamatan}}</td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- Kategori Paket -->
   <div class="col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">Kategori Paket</h5>
         </div>
         <div class="card-body">
            <div class="tabel-responsive">
               <table>
                  <tr>
                     <td class="fw-bold">Nama</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->kategori->nama}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Kode</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->kategori->code}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Harga</td>
                     <td class="px-2"> : </td>
                     <td>Rp {{ number_format($data->kategori->harga, 2, ',', '.') }}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Tanggal</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->kategori->tanggal}}</td>
                  </tr>
                  <tr>
                     <td class="fw-bold">Durasi</td>
                     <td class="px-2"> : </td>
                     <td>{{$data->kategori->durasi}} Hari</td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body d-flex justify-content-between align-items-center">
      <div>
         <a href="{{ asset($data->file_foto) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="far fa-file-pdf"></i> File Foto</a>
         <a href="{{ asset($data->jemaah->file_ktp) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="far fa-file-pdf"></i> File KTP</a>
         <a href="{{ asset($data->file_kk) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="far fa-file-pdf"></i> File KK</a>
         <a href="{{ asset($data->file_ijazah) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="far fa-file-pdf"></i> File Ijazah</a>
         <a href="{{ asset($data->jemaah->file_paspor) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="far fa-file-pdf"></i> File Paspor</a>
      </div>
      <a href="{{route('admin.pendaftaran.edit', ['id' => $data->id ])}}" class="btn btn-sm btn-primary">Edit Pendaftaran</a>
   </div>

</div>

<!-- Pembayaran -->
@if (!empty($data['pembayaran']))
<div class="card mt-3">
   <div class="card-header">
      <h5 class="card-title">Pembayaran</h5>
   </div>
   <div class="card-body">
      <table class="table table-striped">
         <thead>
            <tr>
               <th>Tanggal</th>
               <th>Waktu</th>
               <th>Jumlah</th>
               <th>Metode</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($data['pembayaran'] as $payment)
            <tr>
               <td>{{ $payment->created_at->format('Y-m-d') }}</td>
               <td>{{ $payment->created_at->format('H:i:s') }}</td>
               <td>Rp {{ number_format($payment->harga, 2, ',', '.') }}</td>
               <td>{{ $payment->method }}</td>
               <td><span class="badge bg-success">{{ $payment['status'] }}</span></td>
            </tr>
            @endforeach
         </tbody>
      </table>


      <div class="text-end">
         <a href="{{route('admin.pendaftaran.addPembayaran', ['id' => $data->id ])}}" class="btn btn-primary">Tambah Pembayaran</a>
      </div>
   </div>
</div>
@endif

@endsection