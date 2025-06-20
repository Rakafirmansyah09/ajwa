@extends('template.index')

@section('main')

<div class="page-title">
   <h3>Tambah Admin</h3>
   <p class="text-subtitle text-muted">Tambah admin</p>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between">
      <h4 class="card-title">Admin</h4>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.admin.store') }}" method="POST">
         @csrf
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input type="text" name="name" class="form-control" required>
               </div>
            </div>

            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" required>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-group">
                  <label for="role">Role</label>
                  <select name="role" class="form-control" required>
                     <!-- <option value="super_admin">Super Admin</option> -->
                     <option value="admin">Admin</option>
                     <option value="front_office">Front Office</option>
                  </select>
               </div>
            </div>
            <div class="mt-4 text-end">
               <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection