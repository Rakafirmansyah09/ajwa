@extends('template.index')

@section('css')
<style>
   /* style untuk tabel */
</style>
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>{{ isset($sales) ? 'Update' : 'Tambah' }} Sales</h3>
         <p class="text-subtitle text-muted mb-0">{{ isset($sales) ? 'Update' : 'Create' }} Data Sales</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Form {{ isset($sales) ? 'Update' : 'Tambah' }} Sales</b></h5>
   </div>
   <div class="card-body">
      <form action="{{ isset($sales) ? route('admin.sales.update', $sales->id) : route('admin.sales.store') }}" method="POST">
         @csrf
         <input type="hidden" name="sales_id" value="{{ isset($sales) ? $sales->id : old('sales_id') }}">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="kantor">Kantor Sales</label>
                  <input type="text" class="form-control @error('label') is-invalid @enderror" id="kantor" name="kantor" value="{{ isset($sales) ? $sales->label : old('kantor') }}" required>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="label">Label Sales</label>
                  <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ isset($sales) ? $sales->label : old('label') }}" required>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="nama">Nama Sales</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ isset($sales) ? $sales->nama : old('nama') }}" required>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="aktif">Keaktifan</label>
                  <select class="form-select @error('aktif') is-invalid @enderror" id="aktif" name="aktif" required>
                     <option value="1" {{ isset($sales) && $sales->aktif ? 'selected' : '' }}>Ya</option>
                     <option value="0" {{ isset($sales) && !$sales->aktif ? 'selected' : '' }}>Tidak</option>
                  </select>
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ isset($sales) ? $sales->deskripsi : old('deskripsi') }}</textarea>
               </div>
            </div>
         </div>

         <div class="text-end mt-2">
            <button type="submit" class="btn btn-warning">{{ isset($sales) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>

@endsection

@section('js')
@endsection