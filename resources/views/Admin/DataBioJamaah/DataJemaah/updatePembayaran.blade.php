@extends('template.index')

@section('css')
<style>
   .card-harga {
      border: 1px solid #D9D9D9;
      padding: 10px;
      background-color: #D9D9D9;
      border-radius: 5px;
   }

   .card-harga:hover {
      background-color: #94929B;
      cursor: pointer;
      color: white;
   }
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h4>{{ isset($pembayaran) ? 'Update Pembayaran Jemaah' : 'Tambah Pembayaran Jemaah' }}</h4>
         <p class="text-subtitle text-muted">Data pembayaran jemaah {{ $jemaah->nama }}</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <div class="row">
         @php
         $hargas = [1000000, 2000000, 5000000, 7000000, 10000000, 15000000];
         @endphp
         @foreach ($hargas as $harga)
         <div class=" col-sm-6 col-md-3 mb-3" onclick="setHarga({{$harga}})">
            <div class="card-harga">
               Rp. {{ number_format($harga, 0, ',', '.') }}
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <form action="{{ isset($pembayaran) ? route('admin.group.jemaah.updatePembayaran', $pembayaran->id) : route('admin.group.jemaah.storePembayaran') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="jemaah_id" value="{{ $jemaah->id }}">
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="harga_display">Jumlah Pembayaran</label>
                  <input type="text" id="harga_display" class="form-control" required>
                  <input type="hidden" name="harga" id="harga" value="{{ old('harga', $pembayaran->harga ?? '') }}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="method">Metode Pembayaran</label>
                  <select name="method" class="form-control" required>
                     <option value="">-- Pilih Metode --</option>
                     <option value="transfer" {{ old('method', $pembayaran->method ?? '') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                     <option value="tunai" {{ old('method', $pembayaran->method ?? '') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                     <!-- Tambahkan metode lain jika perlu -->
                  </select>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="bukti">Upload Bukti Pembayaran</label>
                  <input type="file" name="bukti" class="form-control">
                  @if(isset($pembayaran) && $pembayaran->bukti)
                  <a href="{{ asset('storage/' . $pembayaran->bukti) }}" target="_blank">Lihat Bukti</a>
                  @endif
               </div>
            </div>
            <div class="col-12">
               <div class="form-group">
                  <label for="detail">Catatan / Detail Tambahan</label>
                  <textarea name="detail" class="form-control" rows="3">{{ old('detail', $pembayaran->detail ?? '') }}</textarea>
               </div>
            </div>
         </div>
         <div class="text-end">
            <button type="submit" class="btn btn-primary">
               {{ isset($pembayaran) ? 'Update' : 'Simpan' }}
            </button>
         </div>
      </form>
   </div>
</div>
@endsection

@section('js')
<script>
   function formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID', {
         style: 'currency',
         currency: 'IDR',
         minimumFractionDigits: 0
      }).format(angka);
   }

   function setHarga(amount) {
      document.getElementById('harga').value = amount;
      document.getElementById('harga_display').value = formatRupiah(amount);
   }

   // Initialize display value
   document.addEventListener('DOMContentLoaded', function() {
      const initialValue = document.getElementById('harga').value;
      if (initialValue) {
         document.getElementById('harga_display').value = formatRupiah(initialValue);
      }
   });

   // Handle manual input
   document.getElementById('harga_display').addEventListener('input', function(e) {
      // Remove currency format
      let value = e.target.value.replace(/[^\d]/g, '');
      document.getElementById('harga').value = value;
      if (value) {
         e.target.value = formatRupiah(value);
      }
   });
</script>
@endsection