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
         <form action="{{route('admin.pendaftaran.addJemaah.cariNik', ['id' => $group->id])}}" method="get">
            @csrf
            <div class="input-group mb-3">
               <input type="number" class="form-control" placeholder="Masukkan NIk" name="nik">
               <button class="input-group-text" id="cari-nik" type="submit">
                  <i class="fas fa-search"></i>
               </button>
            </div>
         </form>
      </div>


      <form enctype="multipart/form-data" method="post" action="{{ isset($jemah) ? route('admin.jemaah.update', $jemaah->id) : route('admin.pendaftaran.storeJemaah', ['id' => $group->id]) }}">
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
                  <input type="number" name="nik" class="form-control" id="nik" placeholder="NIK" value="{{ old('nik', $bioJemaah->nik ?? '') }}" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
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
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" required value="{{ old('email', $bioJemaah->email ?? '') }}" placeholder="Email" {{ isset($bioJemaah) ? 'readonly disabled' : '' }}>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="no_hp">Nomor HP</label>
                  <div class="input-group">
                     <span class="input-group-text">+62</span>
                     <input type="text" id="no_hp" name="no_hp" class="form-control" required value="{{ isset($jemaah) ? substr($jemaah->no_hp, 3) : '' }}" placeholder="8xxxxxxxxxx" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                  </div>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="kecamatan">Kecamatan</label>
                  <input type="text" id="kecamatan" name="kecamatan" class="form-control" required value="{{ isset($jemaah) ? $jemaah->kecamatan : '' }}" placeholder="Kecamatan">
               </div>
            </div>
            <div class="col-12">
               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input id="alamat" name="alamat" class="form-control" required value="{{ isset($jemaah) ? $jemaah->alamat : '' }}" placeholder="Alamat">
               </div>
            </div>
         </div>

         <!-- {{-- <p class="fw-bold mb-1 mt-3">Kelengkapan File</p>
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="file_ktp">File KTP</label>
                  <input type="file" name="file_ktp" class="form-control" id="file_ktp">
                  @if(isset($bioJemaah) && $bioJemaah->file_ktp)<small class="text-muted">File saat ini: <a href="{{ asset($bioJemaah->file_ktp) }}" target="_blank">Lihat</a></small>@endif
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
            </div> --}} -->

         <p class="fw-bold mb-1 mt-3">Sumber Informasi</p>
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="sumber_info">Sales</label>
                  <select name="sumber_info" id="sumber_informasi" class="form-control" required>
                     <option value="" selected disabled> Pilih Sales </option>
                     @forelse ($sales as $s)
                     <option value="{{$s->id}}">{{$s->label}} {{$s->nama}}</option>
                     @empty
                     <option value="">Tidak ada Sales</option>
                     @endforelse
                  </select>
               </div>
            </div>
            <div class="col-md-8">
               <!-- {{-- <div class="form-group">
                  <label for="detail_info">Detail Sumber Informasi</label>
                  <input type="text" name="detail_info" class="form-control" id="detail_info" placeholder="Detail Sumber Informasi" value="{{ old('detail_info', $jemaah->detail_info ?? '') }}" required>
               </div> --}} -->
            </div>
         </div>

         <div class="text-end">
            <button type="submit" class="btn btn-warning">{{ isset($bioJemaah) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>

@endsection

@section('js')

@endsection