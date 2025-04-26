@extends('template.index')

@section('css')
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
   <div class="card-header">
      <h5 class="card-title">
         Formulir Pembayaran Jemaah
      </h5>
   </div>
   <div class="card-body">
      <form action="{{ isset($pembayaran) ? route('admin.group.jemaah.updatePembayaran', $pembayaran->id) : route('admin.group.jemaah.storePembayaran') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="jemaah_id" value="{{ $jemaah->id }}">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="harga">Jumlah Pembayaran</label>
                  <input type="number" name="harga" class="form-control" value="{{ old('harga', $pembayaran->harga ?? '') }}" required>
               </div>
            </div>
            <div class="col-md-6">
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
            <div class="col-md-6">
               <div class="form-group">
                  <label for="status">Status</label>
                  <input class="form-control" type="text" name="status" value="success" disabled>
               </div>
            </div>
            <div class="col-md-6">
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
         <button type="submit" class="btn btn-primary">
            {{ isset($pembayaran) ? 'Update' : 'Simpan' }}
         </button>
      </form>
   </div>
</div>
@endsection

@section('js')
@endsection