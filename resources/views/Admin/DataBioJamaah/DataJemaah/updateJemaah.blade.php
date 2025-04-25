@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>{{ isset($Jemaah) ? 'Update Jemaah' : 'Tambah Jemaah' }}</h3>
         <p class="text-subtitle text-muted">Data jemaah dalam group {{$group->nama}} - {{$group->paket->nama}}</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         Formulir Data Jemaah
      </h5>
   </div>
   <div class="card-body">
      <p class="fw-bold mb-1">Sudah Pernah Daftar?</p>
      <div class="form-group">
         <label for="cari_nik">Cari NIK</label>
         <form action="{{route('admin.group.addJemaah.cariNik', ['id' => $group->id])}}" method="get">
            @csrf
            <div class="input-group mb-3">
               <input type="text" class="form-control" placeholder="Masukkan NIk" name="nik">
               <button class="input-group-text" id="cari-nik" type="submit">
                  <i class="fas fa-search"></i>
               </button>
            </div>
         </form>
      </div>


      <form enctype="multipart/form-data" method="post" action="{{ isset($jemah) ? route('admin.jemaah.update', $jemaah->id) : route('admin.group.storeJemaah', ['id' => $group->id]) }}">
         @csrf
         <p class="fw-bold mb-1">Data Diri</p>
         <div class="row">
            <div class="col-md-6">
               <input type="hidden" name="idJemaah" value="{{ $bioJemaah->id ?? '' }}">
               <div class="form-group">
                  <label for="namaLengkap">Nama Lengkap</label>
                  <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" value="{{ old('namaLengkap', $bioJemaah->nama_lengkap ?? '') }}" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" value="{{ old('nik', $bioJemaah->nik ?? '') }}" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tanggalLahir">Tanggal Lahir</label>
                  <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" value="{{ old('tanggalLahir', $bioJemaah->tanggal_lahir ?? '') }}" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tempatLahir">Tempat Lahir</label>
                  <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="{{ old('tempatLahir', $bioJemaah->tempat_lahir ?? '') }}" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
                     <option value="">Pilih Jenis Kelamin</option>
                     <option value="L" {{ (old('jenis_kelamin', $bioJemaah->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                     <option value="P" {{ (old('jenis_kelamin', $bioJemaah->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                  </select>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="no_hp">Nomor HP</label>
                  <input type="text" id="no_hp" name="no_hp" class="form-control" required value="{{ isset($jemaah) ? $jemaah->no_hp : '' }}">
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input id="alamat" name="alamat" class="form-control" required value="{{ isset($jemaah) ? $jemaah->alamat : '' }}">
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="kecamatan">Kecamatan</label>
                  <input type="text" id="kecamatan" name="kecamatan" class="form-control" required value="{{ isset($jemaah) ? $jemaah->kecamatan : '' }}">
               </div>
            </div>
         </div>

         <p class="fw-bold mb-1 mt-3">Kelengkapan File</p>
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_ktp">File KTP</label>
                  <input type="file" name="file_ktp" class="form-control" id="file_ktp">
                  @if(isset($bioJemaah) && $bioJemaah->file_ktp)
                  <small class="text-muted">File saat ini: <a href="{{ asset($bioJemaah->file_ktp) }}" target="_blank">Lihat</a></small>
                  @endif
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_paspor">File Paspor</label>
                  <input type="file" name="file_paspor" class="form-control" id="file_paspor">
                  @if(isset($bioJemaah) && $bioJemaah->file_paspor)
                  <small class="text-muted">File saat ini: <a href="{{ asset($bioJemaah->file_paspor) }}" target="_blank">Lihat</a></small>
                  @endif
               </div>
            </div>

         </div>
         <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ isset($bioJemaah) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>

@endsection

@section('js')

@endsection