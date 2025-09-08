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
         <h3>Akomodasi {{ $paket->nama }}</h3>
         <p class="text-subtitle text-muted">Kelola data akomodasi paket</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">Data Akomodasi</h5>
   </div>

   <div class="card-body">
      <form method="POST" action="{{ route('admin.group.editAkomodasiStore') }}" id="form-akomodasi">
         @csrf

         <input type="hidden" name="group_id" value="{{ $group->id }}">

         <table class="table table-bordered table-custom table-hover table-striped" id="akomodasi-table">
            <thead>
               <tr class="bg-primary-subtle">
                  <th>#</th>
                  <th>Nama Hotel</th>
                  <th>Kota</th>
                  <th>Alamat</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Rating</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($group->list_akomodasi as $index => $akomodasi)
               <tr>
                  <td class="number">{{ $loop->iteration }}</td>
                  <td>
                     <input type="text" name="nama_hotel[]" value="{{ $akomodasi->nama_hotel }}" class="form-control">
                  </td>
                  <td>
                     <input type="text" name="kota[]" value="{{ $akomodasi->kota }}" class="form-control">
                  </td>
                  <td>
                     <input type="text" name="alamat[]" value="{{ $akomodasi->alamat }}" class="form-control">
                  </td>
                  <td>
                     <input type="date" name="tanggal_checkin[]" value="{{ $akomodasi->tanggal_checkin }}" class="form-control">
                  </td>
                  <td>
                     <input type="date" name="tanggal_checkout[]" value="{{ $akomodasi->tanggal_checkout }}" class="form-control">
                  </td>
                  <td>
                     <input type="number" name="rating[]" value="{{ $akomodasi->rating }}" class="form-control" min="1" max="5">
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

         <button type="button" class="btn btn-outline-primary btn-sm" id="add-akomodasi" onclick="addnew()">Tambah Akomodasi</button>

         <div class="text-end mt-2">
            <a href="{{ route('admin.paket.detail', ['id' => $paket->id]) }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Semua</button>
         </div>
      </form>
   </div>
</div>
@endsection

@section('js')
<script>
   function addnew() {
      const table = document.getElementById('akomodasi-table').querySelector('tbody');
      const row = document.createElement('tr');

      row.innerHTML = `
         <td class="number"></td>
         <td><input type="text" name="nama_hotel[]" class="form-control"></td>
         <td><input type="text" name="kota[]" class="form-control"></td>
         <td><input type="text" name="alamat[]" class="form-control"></td>
         <td><input type="date" name="tanggal_checkin[]" class="form-control"></td>
         <td><input type="date" name="tanggal_checkout[]" class="form-control"></td>
         <td><input type="number" name="rating[]" class="form-control" min="1" max="5"></td>
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
      document.querySelectorAll('#akomodasi-table tbody tr').forEach((row, index) => {
         row.querySelector('.number').textContent = index + 1;
      });
   }
</script>
@endsection