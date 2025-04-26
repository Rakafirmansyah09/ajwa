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
         <h3>Penerbangan {{ $paket->nama }}</h3>
         <p class="text-subtitle text-muted">Kelola data penerbangan paket</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">Data Penerbangan</h5>
   </div>
</div>

<form method="POST" action="{{ route('admin.group.editPenerbanganStore') }}" id="form-penerbangan">
   @csrf
   <input type="hidden" name="group_id" value="{{$group->id}}">
   @forelse ($group->list_penerbangan as $penerbangan)
   <div class="card" id="penerbangan-{{$loop->iteration}}">
      <div class="card-header d-flex justify-content-between align-items-center">
         <h5><b>Penenerbangan {{$loop->iteration}}</b></h5>
         <button type="button" class="btn btn-sm btn-danger" onclick="hapusPenerbangan( 'penerbangan-{{ $loop->iteration }}')">
            <i class="fas fa-trash"></i> Hapus
         </button>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" name="judul[]" value="{{ $penerbangan->judul }}" required>
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="maskapai">Maskapai</label>
                  <input type="text" class="form-control" name="maskapai[]" value="{{ $penerbangan->maskapai }}" required>
               </div>
            </div>
            <div class="col-md-5">
               <div class="form-group">
                  <label for="tanggal_berangkat">Tanggal Berangkat</label>
                  <input type="date" class="form-control" name="tanggal_berangkat[]" value="{{ $penerbangan->tanggal_berangkat }}" required>
               </div>
            </div>
            <div class="col-md-5">
               <div class="form-group">
                  <label for="tanggal_tiba">Tanggal Tiba</label>
                  <input type="date" class="form-control" name="tanggal_tiba[]" value="{{ $penerbangan->tanggal_tiba }}" required>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="lama_penerbangan">Lama Penerbangan</label>
                  <input type="text" class="form-control" name="lama_penerbangan[]" value="{{ $penerbangan->lama_penerbangan }}" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bagasi">Bagasi</label>
                  <input type="number" class="form-control" name="bagasi[]" value="{{ $penerbangan->bagasi }}" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bagasi_kabin">Bagasi Kabin</label>
                  <input type="number" class="form-control" name="bagasi_kabin[]" value="{{ $penerbangan->bagasi_kabin }}" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="kursi">Kursi</label>
                  <input type="text" class="form-control" name="kursi[]" value="{{ $penerbangan->kursi }}" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="bandara_asal">Bandara Asal</label>
                  <input type="text" class="form-control" name="bandara_asal[]" value="{{ $penerbangan->bandara_asal }}" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="kota_asal">Kota Bandara Asal</label>
                  <input type="text" class="form-control" name="kota_asal[]" value="{{ $penerbangan->kota_asal }}" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="bandara_tujuan">Bandara Tujuan</label>
                  <input type="text" class="form-control" name="bandara_tujuan[]" value="{{ $penerbangan->bandara_tujuan }}" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="kota_tujuan">Kota Bandara Tujuan</label>
                  <input type="text" class="form-control" name="kota_tujuan[]" value="{{ $penerbangan->kota_tujuan }}" required>
               </div>
            </div>
         </div>
      </div>
   </div>
   @empty
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" name="judul[]" value="" required>
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="maskapai">Maskapai</label>
                  <input type="text" class="form-control" name="maskapai[]" value="" required>
               </div>
            </div>
            <div class="col-md-5">
               <div class="form-group">
                  <label for="tanggal_berangkat">Tanggal Berangkat</label>
                  <input type="date" class="form-control" name="tanggal_berangkat[]" value="" required>
               </div>
            </div>
            <div class="col-md-5">
               <div class="form-group">
                  <label for="tanggal_tiba">Tanggal Tiba</label>
                  <input type="date" class="form-control" name="tanggal_tiba[]" value="" required>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="lama_penerbangan">Lama Penerbangan</label>
                  <input type="text" class="form-control" name="lama_penerbangan[]" value="" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bagasi">Bagasi</label>
                  <input type="number" class="form-control" name="bagasi[]" value="" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bagasi_kabin">Bagasi Kabin</label>
                  <input type="number" class="form-control" name="bagasi_kabin[]" value="" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="kursi">Kursi</label>
                  <input type="text" class="form-control" name="kursi[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="bandara_asal">Bandara Asal</label>
                  <input type="text" class="form-control" name="bandara_asal[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="kota_asal">Kota Bandara Asal</label>
                  <input type="text" class="form-control" name="kota_asal[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="bandara_tujuan">Bandara Tujuan</label>
                  <input type="text" class="form-control" name="bandara_tujuan[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="kota_tujuan">Kota Bandara Tujuan</label>
                  <input type="text" class="form-control" name="kota_tujuan[]" value="" required>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforelse
</form>

<div class="card">
   <div class="card-body">
      <button type="button" class="btn btn-primary" id="add-akomodasi" onclick="addnew()">Tambah Penerbangan</button>
      <div class="float-end">
         <a href="{{ route('admin.paket.detail', ['id' => $paket->id]) }}" class="btn btn-secondary ms-2">Kembali</a>
         <button type="submit" class="btn btn-primary ms-2" form="form-penerbangan">Simpan Semua</button>
      </div>
   </div>
</div>
@endsection

@section('js')
<script>
   function hapusPenerbangan(id) {
      const card = document.getElementById(id);
      card.remove();
   }

   function addnew() {
      const form = document.getElementById('form-penerbangan');
      form.innerHTML += `
      <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" name="judul[]" value="" required>
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <label for="maskapai">Maskapai</label>
                  <input type="text" class="form-control" name="maskapai[]" value="" required>
               </div>
            </div>
            <div class="col-md-5">
               <div class="form-group">
                  <label for="tanggal_berangkat">Tanggal Berangkat</label>
                  <input type="date" class="form-control" name="tanggal_berangkat[]" value="" required>
               </div>
            </div>
            <div class="col-md-5">
               <div class="form-group">
                  <label for="tanggal_tiba">Tanggal Tiba</label>
                  <input type="date" class="form-control" name="tanggal_tiba[]" value="" required>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="lama_penerbangan">Lama Penerbangan</label>
                  <input type="text" class="form-control" name="lama_penerbangan[]" value="" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bagasi">Bagasi</label>
                  <input type="number" class="form-control" name="bagasi[]" value="" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bagasi_kabin">Bagasi Kabin</label>
                  <input type="number" class="form-control" name="bagasi_kabin[]" value="" required>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="kursi">Kursi</label>
                  <input type="text" class="form-control" name="kursi[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="bandara_asal">Bandara Asal</label>
                  <input type="text" class="form-control" name="bandara_asal[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="kota_asal">Kota Bandara Asal</label>
                  <input type="text" class="form-control" name="kota_asal[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="bandara_tujuan">Bandara Tujuan</label>
                  <input type="text" class="form-control" name="bandara_tujuan[]" value="" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="kota_tujuan">Kota Bandara Tujuan</label>
                  <input type="text" class="form-control" name="kota_tujuan[]" value="" required>
               </div>
            </div>
         </div>
      </div>
   </div>
   `;
   }
</script>
@endsection