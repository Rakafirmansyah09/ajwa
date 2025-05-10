@extends('template.index', ['pageTitle' => 'Create/Edit Paket'])

@section('css')
@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h5>{{ isset($keberangkatan) ? 'Detail Keberangakatan' : 'Tambah Keberangkatan' }}</h5>
         <p class="text-subtitle text-muted">Data keberangkatan paket umroh</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">Formulir</h5>
   </div>
   <div class="card-body">
      <form method="post" action="{{ isset($keberangkatan) ? route('admin.group.update') : route('admin.group.store') }}">
         @csrf
         <div class="row">
            <div class="col-12">
               <fieldset disabled>
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="code">Code Paket</label>
                           <input type="text" name="code" class="form-control" id="code" placeholder="Nama Paket" value="{{$paket->code}}" readonly>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="nama">Nama Paket</label>
                           <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Paket" value="{{$paket->nama}}" readonly>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="kapasitas">Kapasitas Paket</label>
                           <input type="text" name="kapasitas" class="form-control" id="kapasitas" placeholder="kapasitas Paket" value="{{$paket->kuota}} Orang" readonly>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <input type="hidden" name="paket_id" value="{{$paket->id}}">
                  <input type="hidden" name="keberangkatan_id" value="{{ isset($keberangkatan) ? $keberangkatan->id : '' }}">
                  <label for="tanggal_keberangkatan">Tanggal Kebrangkatan</label>
                  <input type="date" name="tanggal_keberangkatan" class="form-control" id="tanggal_keberangkatan" placeholder="tanggal_keberangkatan Paket" value="{{ old('tanggal_keberangkatan', $keberangkatan->tanggal_keberangkatan ?? '')}}" required>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="tanggal_kepulangan">Tanggal Kepulangan</label>
                  <input type="date" name="tanggal_kepulangan" class="form-control" id="tanggal_kepulangan" placeholder="tanggal_kepulangan Paket" value="{{ old('tanggal_kepulangan', $keberangkatan->tanggal_kepulangan ?? '')}}">
               </div>
            </div>

            <div class="text-end">
               <button type="submit" class="btn btn-primary">{{ isset($keberangkatan) ? 'Update' : 'Simpan' }}</button>
            </div>
         </div>
      </form>
   </div>
</div>

@endsection

@section('js')
@endsection