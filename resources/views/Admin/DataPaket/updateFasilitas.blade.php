@extends('template.index')

@section('css')
<style>
   .table-custom tbody tr td {
      padding: 0;
   }

   .table-custom tbody tr td input {
      border: none;
      background-color: transparent;
   }

   .table-custom tbody tr td input:focus {
      outline: none;
   }

   .table-custom tbody tr td:first-child {
      width: 50px;
      text-align: center;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Paket {{ $paket->nama }}</h3>
         <p class="text-subtitle text-muted">Kelola fasilitas paket langsung</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">List Fasilitas</h5>
   </div>

   <div class="card-body">
      <form method="POST" action="{{ route('admin.paket.editFasilitas.Store') }}" id="form-fasilitas">
         @csrf

         <input type="hidden" name="paket_id" value="{{ $paket->id }}">

         <table class="table table-bordered table-custom table-hover" id="fasilitas-table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Nama Fasilitas</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($paket->list_fasilitas as $index => $f)
               <tr>
                  <td class="number">{{ $loop->iteration }}</td>
                  <td>
                     <input type="text" name="fasilitas[{{ $loop->iteration }}]" value="{{ is_array($f) ? $f['nama'] : $f }}" class="form-control">
                  </td>
                  <td>
                     <button type="button" class="btn btn-outline-primary btn-sm" onclick="moveRowUp(this)">
                        <i class="fas fa-arrow-up"></i>
                     </button>
                     <button type="button" class="btn btn-outline-primary btn-sm" onclick="moveRowDown(this)">
                        <i class="fas fa-arrow-down"></i>
                     </button>
                     <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteRow(this)">
                        <i class="fas fa-trash-alt"></i>
                     </button>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>

         <button type="button" class="btn btn-outline-primary btn-sm" id="add-fasilitas" onclick="addnew()">Tambah Fasilitas</button>

         <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">Simpan Semua</button>
         </div>
      </form>
   </div>
</div>
@endsection

@section('js')
<script>
   function addnew() {
      const table = document.getElementById('fasilitas-table').querySelector('tbody');
      const row = document.createElement('tr');

      row.innerHTML = `
         <td class="number"></td>
         <td><input type="text" name="fasilitas[]" class="form-control"></td>
         <td>
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="moveRowUp(this)">
               <i class="fas fa-arrow-up"></i>
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="moveRowDown(this)">
               <i class="fas fa-arrow-down"></i>
            </button>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteRow(this)">
               <i class="fas fa-trash-alt"></i>
            </button>
         </td>
      `;

      table.appendChild(row);
      updateRowNumbers();
   }

   function deleteRow(button) {
      const row = button.closest('tr');
      row.remove();
      updateRowNumbers();
   }

   function moveRowUp(button) {
      const row = button.closest('tr');
      const prev = row.previousElementSibling;
      if (prev) {
         row.parentNode.insertBefore(row, prev);
         updateRowNumbers();
      }
   }

   function moveRowDown(button) {
      const row = button.closest('tr');
      const next = row.nextElementSibling;
      if (next) {
         row.parentNode.insertBefore(next, row);
         updateRowNumbers();
      }
   }

   function updateRowNumbers() {
      document.querySelectorAll('#fasilitas-table tbody tr').forEach((row, index) => {
         row.querySelector('.number').textContent = index + 1;
      });
   }
</script>
@endsection