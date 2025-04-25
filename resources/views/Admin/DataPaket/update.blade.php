@extends('template.index', ['pageTitle' => 'Create/Edit Paket'])

@section('css')
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Data Paket</h3>
         <p class="text-subtitle text-muted">Data paket haji dan umroh</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">{{ isset($paket) ? 'Detail Paket' : 'Tambah Paket' }}</h5>
   </div>
   <div class="card-body">
      <form method="post" action="{{ isset($paket) ? route('admin.paket.update') : route('admin.paket.store') }}">
         @csrf
         <div class="row">
            <div class="col-md-6">
               <input type="hidden" name="id" value="{{ $paket->id ?? '' }}">
               <div class="form-group">
                  <label for="code">Code Paket</label>
                  <input type="text" name="code" class="form-control" id="code" placeholder="code Paket" value="{{ old('code', $paket->code ?? '') }}">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nama">Nama Paket</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Paket" value="{{ old('nama', $paket->nama ?? '') }}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="durasi">Durasi</label>
                  <input type="number" name="durasi" class="form-control" id="durasi" placeholder="Durasi Hari" value="{{ old('durasi', $paket->durasi ?? '') }}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" name="harga" class="form-control" id="harga" placeholder="Harga Rp." value="{{ old('harga', $paket->harga ?? '') }}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label for="kuota">Kuota</label>
                  <input type="number" name="kuota" class="form-control" id="kuota" placeholder="kuota" value="{{ old('kuota', $paket->kuota ?? '') }}">
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label for="detail">Detail</label>
                  <textarea class="form-control" id="detail" name="detail" rows="3" style="height: 209px;">{{ old('detail', $paket->detail ?? '') }}</textarea>
               </div>
            </div>
         </div>
         <div class="text-end mt-2">
            @if (isset($paket))
            <a href="{{ isset($_GET['b']) ? route($_GET['b']) : route('admin.paket.detail', ['id' => $paket->id]) }}" class="btn btn-secondary me-2">Kembali</a>
            @endif
            <button type="submit" class="btn btn-primary">{{ isset($paket) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>

@endsection

@section('js')
@endsection