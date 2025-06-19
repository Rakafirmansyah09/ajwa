@extends('template.index')

@section('main')
<div class="page-title">
   <h3>List Admin</h3>
   <p class="text-subtitle text-muted">List admin</p>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between">
      <h4 class="card-title">Tabel Admin</h4>
      <a href="{{ route('admin.admin.create') }}" class="btn btn-primary">Tambah Admin</a>
   </div>

   <div class="card-body">
      <table class="table table-striped" id="table1">
         <thead>
            <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Email</th>
               <th>Role</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            @foreach($admins as $key => $admin)
            <tr>
               <td>{{ $key + 1 }}</td>
               <td>{{ $admin->name }}</td>
               <td>{{ $admin->email }}</td>
               <td>{{ ucfirst($admin->admin_role) }}</td>
               <td>
                  @if ($admin->admin_role !== 'super_admin')
                  <a href="{{ route('admin.admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <form action="{{ route('admin.admin.delete') }}" method="POST" style="display:inline-block;">
                     @csrf
                     <input type="hidden" name="id" value="{{ $admin->id }}">
                     <button type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="confirmDanger(
                           'Hapus akun admin',
                           'Yakin akan menghapus akun admin {{ $admin->name }}?!',
                           () => { this.form.submit(); }
                        )">
                        Hapus
                     </button>
                  </form>
                  @endif
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection