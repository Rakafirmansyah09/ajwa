@extends('template.index')

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Profile</h3>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title">Biodata</h5>
   </div>
   <div class="card-body">
      <form id="biodata" action="{{ route('profile.updateBiodata') }}" method="POST">
         @csrf
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="name" class="form-control" id="nama" placeholder="Nama Lengkap" value="{{ old('name', $user->name) }}" required>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control bg-light-secondary" id="email" value="{{ $user->email }}" readonly>
               </div>
            </div>
         </div>
         <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#gantiEmailModal">Ganti Email</button> -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#gantiPasswordModal">Ganti Password</button>
         </div>
      </form>
   </div>
</div>

<!-- Modal Ganti Email -->
<div class="modal fade" id="gantiEmailModal" tabindex="-1" aria-labelledby="gantiEmailLabel" aria-hidden="true">
   <div class="modal-dialog">
      <form method="POST" action="{{ route('profile.updateEmail') }}">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="gantiEmailLabel">Ganti Email</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>Email Baru</label>
                  <input type="email" name="email" class="form-control" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </form>
   </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal fade" id="gantiPasswordModal" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
   <div class="modal-dialog">
      <form method="POST" action="{{ route('profile.updatePassword') }}">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="gantiPasswordLabel">Ganti Password</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group mb-2">
                  <label>Password Lama</label>
                  <input type="password" name="old_password" class="form-control" required>
               </div>
               <div class="form-group mb-2">
                  <label>Password Baru</label>
                  <input type="password" name="password" class="form-control" required>
               </div>
               <div class="form-group">
                  <label>Konfirmasi Password Baru</label>
                  <input type="password" name="password_confirmation" class="form-control" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
               <button
                  type="submit"
                  class="btn btn-primary"
                  onclick="confirmWarning('Ganti Password?', 
                     'Apakah Anda yakin ingin mengganti password?', () => {
                     $('#gantiPasswordModal form').submit();
                  })">Simpan</button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection