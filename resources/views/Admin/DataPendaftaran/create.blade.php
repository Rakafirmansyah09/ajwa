@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Pemdaftaran</h3>
         <p class="text-subtitle text-muted">Data pendaftaran umroh dan haji</p>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-12 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">
               Biodata Jemaah
            </h5>
         </div>
         <div class="card-body">

            @if (!isset($pendaftaran))
            <div class="mb-3">
               <label for="src-nik" class="form-label">NIK Jemaah</label>
               <form method="get" action="{{ route('admin.pendaftaran.create') }}">
                  <div class="input-group mb-3">
                     <input type="text" id="src-nik" name="ij" class="form-control" placeholder="Cari NIK atau Nama" aria-label="Cari NIK" aria-describedby="button-addon2" value="{{ $ij }}">
                     <input type="hidden" name="ip" value="{{ $ip }}">
                     <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="fas fa-search"></i>
                     </button>
                  </div>
               </form>

               <!-- Tempat untuk menampilkan hasil pencarian -->
               <div id="search-results-nik" class="list-group position-absolute w-50"></div>
            </div>
            @endif

            <fieldset disabled>
               <div class="mb-3">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" id="nama" name="nama" class="form-control" value="{{ $pendaftaran->jemaah ? $pendaftaran->jemaah->nama_lengkap : '' }}">
               </div>
               <div class="row">
                  <div class="col-6">
                     <label for="tanggal" class="form-label">Tanggal Lahir</label>
                     <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $pendaftaran->jemaah ? $pendaftaran->jemaah->tanggal_lahir : '' }}">
                  </div>
                  <div class="col-6">
                     <label for="tempat" class="form-label">Tampat Lahir</label>
                     <input type="text" id="tempat" name="tempat" class="form-control" value="{{ $pendaftaran->jemaah ? $pendaftaran->jemaah->tempat_lahir : '' }}">
                  </div>
               </div>
            </fieldset>
         </div>
      </div>
   </div>
   <div class="col-12 col-md-6">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">
               Paket
            </h5>
         </div>
         <div class="card-body">
            @if (!isset($pendaftaran))
            <div class="mb-3">
               <label for="src-paket" class="form-label">Kode Paket</label>
               <form method="get" action="{{route('admin.pendaftaran.create')}}">
                  <div class="input-group mb-3">
                     <input type="text" id="src-paket" name="ip" class="form-control" placeholder="Cari Paket" aria-label="Cari Paket" aria-describedby="button-addon2" value="{{ $ip }}">
                     <input type="hidden" name="ij" value="{{ $ij }}">
                     <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="fas fa-search"></i>
                     </button>
                  </div>
               </form>

               <div id="search-results-paket" class="list-group position-absolute w-50"></div>
            </div>
            @endif

            <fieldset disabled>
               <div class="mb-3">
                  <label for="nama_paket" class="form-label">Nama</label>
                  <input type="text" id="nama_paket" name="nama_paket" class="form-control" value="{{ $pendaftaran->kategori ? $pendaftaran->kategori->nama : '' }}">
               </div>
               <div class="row">
                  <div class="col-6">
                     <label for="tanggal" class="form-label">Tanggal Kebrangkatan</label>
                     <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $pendaftaran->kategori ? $pendaftaran->kategori->tanggal : '' }}">
                  </div>
                  <div class="col-6">
                     <label for="durasi" class="form-label">Durasi</label>
                     <input type="text" id="durasi" name="durasi" class="form-control" value="{{ $pendaftaran->kategori ? $pendaftaran->kategori->durasi.' Hari' : '' }}">
                  </div>
               </div>
            </fieldset>
         </div>
      </div>
   </div>
</div>

<form method="post" action="{{ isset($pendafataran) ? route('admin.pendaftaran.store') : route('admin.pendaftaran.update') }}" enctype="multipart/form-data">
   @csrf


   <div class="card">
      <div class="card-header">
         <h5 class="card-title">
            Kelengkapan Data
         </h5>
      </div>
      <div class="card-body">
         <input type="hidden" name="id_jamaah" value="{{$ij}}">
         <input type="hidden" name="id_paket" value="{{ $ip }}">

         <div class="row">
            <div class="col-12 col-md-6">
               <label for="no_hp" class="form-label">Nomor HP</label>
               <input type="text" id="no_hp" name="no_hp" class="form-control" required value="{{ $pendaftaran ? $pendaftaran->no_hp : '' }}">
            </div>
            <div class="col-12 col-md-6">
               <label for="alamat" class="form-label">Alamat</label>
               <input id="alamat" name="alamat" class="form-control" required value="{{ $pendaftaran ? $pendaftaran->alamat : '' }}">
            </div>
            <div class="col-12 col-md-6">
               <label for="kecamatan" class="form-label">Kecamatan</label>
               <input type="text" id="kecamatan" name="kecamatan" class="form-control" required value="{{ $pendaftaran ? $pendaftaran->kecamatan : '' }}">
            </div>
            <div class="col-12 col-md-6">
               <label for="file_kk" class="form-label">Upload KK</label>
               <input type="file" id="file_kk" name="file_kk" class="form-control" required>
               @if(isset($pendaftaran) && $pendaftaran->file_kk)
               <small class="text-muted">File saat ini: <a href="{{ asset($pendaftaran->file_kk) }}" target="_blank">Lihat</a></small>
               @endif
            </div>
            <div class="col-12 col-md-6">
               <label for="file_foto" class="form-label">Upload Foto</label>
               <input type="file" id="file_foto" name="file_foto" class="form-control" required>
               @if(isset($pendaftaran) && $pendaftaran->file_foto)
               <small class="text-muted">File saat ini: <a href="{{ asset($pendaftaran->file_foto) }}" target="_blank">Lihat</a></small>
               @endif
            </div>
            <div class="col-12 col-md-6">
               <label for="file_ijazah" class="form-label">Upload Ijazah</label>
               <input type="file" id="file_ijazah" name="file_ijazah" class="form-control" required>
               @if(isset($pendaftaran) && $pendaftaran->file_ijazah)
               <small class="text-muted">File saat ini: <a href="{{ asset($pendaftaran->file_ijazah) }}" target="_blank">Lihat</a></small>
               @endif
            </div>
         </div>
      </div>
   </div>

   <div class="card">
      <div class="card-header">
         <h5 class="card-title">
            Sumber Info
         </h5>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="mb-3">
                  <label for="sumber_info" class="form-label">Sumber Informasi</label>
                  <select id="sumber_info" name="sumber_info" class="form-select" required>
                     <option value="">Pilih Sumber Informasi</option>
                     <option value="media_sosial" {{ $pendaftaran && $pendaftaran->sumber_info == 'media_sosial' ? 'selected' : '' }}>Media Sosial</option>
                     <option value="teman" {{ $pendaftaran && $pendaftaran->sumber_info == 'teman' ? 'selected' : '' }}>Teman/Kerabat</option>
                     <option value="brosur" {{ $pendaftaran && $pendaftaran->sumber_info == 'brosur' ? 'selected' : '' }}>Brosur</option>
                     <option value="lainnya" {{ $pendaftaran && $pendaftaran->sumber_info == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                  </select>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <label for="sumber_ket" class="form-label">Keterangan Sumber</label>
               <input type="text" id="sumber_ket" name="sumber_ket" class="form-control" required value="{{ $pendaftaran ? $pendaftaran->sumber_ket : '' }}">
            </div>
            <div class="col-12">
               <label for="detail_info" class="form-label">Detail Informasi</label>
               <textarea id="detail_info" name="detail_info" class="form-control" rows="3" required>{{ $pendaftaran ? $pendaftaran->detail_info : '' }}</textarea>
            </div>
         </div>
      </div>
   </div>

   <div class="card">
      <div class="card-body py-3 text-end">
         <button type="reset" class="btn btn-secondary">Reset</button>
         <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
   </div>
</form>

@endsection

@section('js')
<script>
   document.addEventListener("DOMContentLoaded", function() {
      const NikInput = document.getElementById("src-nik");
      const paketInput = document.getElementById("src-paket");

      const resultsNikContainer = document.getElementById("search-results-nik");
      const resultsPeketContainer = document.getElementById("search-results-paket");
      const form = NikInput.closest("form"); // Ambil form terdekat dari input

      paketInput.addEventListener("keyup", function() {
         let query = paketInput.value.trim();

         if (query.length > 1) { // Mulai mencari setelah 3 karakter
            fetch("{{ route('admin.pendaftaran.search') }}?k=paket&q=" + encodeURIComponent(query))
               .then(response => response.json())
               .then(data => {
                  resultsPeketContainer.innerHTML = "";
                  if (data.length > 0) {
                     data.forEach(paket => {
                        let item = document.createElement("a");
                        item.href = "#";
                        item.classList.add("list-group-item", "list-group-item-action", "search-item");
                        item.dataset.code = paket.code;
                        item.innerHTML = `
                                <div><strong>${paket.code}</strong></div>
                                <div>${paket.nama}</div>
                            `;
                        resultsPeketContainer.appendChild(item);
                     });
                     resultsPeketContainer.style.display = "block";
                  } else {
                     resultsPeketContainer.innerHTML = `<div class="list-group-item">Tidak ditemukan</div>`;
                     resultsPeketContainer.style.display = "block";
                  }
               });
         } else {
            resultsPeketContainer.style.display = "none";
         }
      });


      NikInput.addEventListener("keyup", function() {
         let query = NikInput.value.trim();

         if (query.length > 2) { // Mulai mencari setelah 3 karakter
            fetch("{{ route('admin.pendaftaran.search') }}?k=jemaah&q=" + encodeURIComponent(query))
               .then(response => response.json())
               .then(data => {
                  resultsNikContainer.innerHTML = "";
                  if (data.length > 0) {
                     data.forEach(jemaah => {
                        let item = document.createElement("a");
                        item.href = "#";
                        item.classList.add("list-group-item", "list-group-item-action", "search-item");
                        item.dataset.nik = jemaah.nik;
                        item.innerHTML = `
                                <div><strong>${jemaah.nik}</strong></div>
                                <div>${jemaah.nama_lengkap}</div>
                            `;
                        resultsNikContainer.appendChild(item);
                     });
                     resultsNikContainer.style.display = "block";
                  } else {
                     resultsNikContainer.innerHTML = `<div class="list-group-item">Tidak ditemukan</div>`;
                     resultsNikContainer.style.display = "block";
                  }
               });
         } else {
            resultsNikContainer.style.display = "none";
         }
      });

      // Pilih hasil pencarian dan masukkan ke input + submit form otomatis
      resultsNikContainer.addEventListener("click", function(e) {
         let targetItem = e.target.closest(".search-item");
         if (targetItem) {
            e.preventDefault();
            NikInput.value = targetItem.dataset.nik;
            resultsNikContainer.style.display = "none";
            const form = NikInput.closest("form");
            form.submit(); // 🚀 Submit form otomatis setelah memilih NIK
         }
      });

      resultsPeketContainer.addEventListener("click", function(e) {
         let targetItem = e.target.closest(".search-item");
         if (targetItem) {
            e.preventDefault();
            paketInput.value = targetItem.dataset.code;
            resultsPeketContainer.style.display = "none";
            const form = paketInput.closest("form");
            form.submit(); // 🚀 Submit form otomatis setelah memilih NIK
         }
      });

      // Sembunyikan hasil jika klik di luar
      document.addEventListener("click", function(e) {
         if (!NikInput.contains(e.target) && !resultsNikContainer.contains(e.target)) {
            resultsNikContainer.style.display = "none";
         }
      });
   });
</script>
@endsection