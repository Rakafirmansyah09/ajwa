@extends('template.index')

@section('css')


@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Daftar</h3>
         <p class="text-subtitle text-muted"></p>
      </div>
   </div>
</div>

<div class="page-content">
   @include('Admin.DataPendaftaran.progres', ['value'=>3])
   <div class="card mb-3">
      <div class="card-header pb-0">
         <h5 class="card-title">
            Sumber Informasi
         </h5>
      </div>
      <div class="card-body">
         <div class="col-md-6">
            <div class="form-group">
               <label for="nama">Mendapat Informasi Dari</label>
               <option value=""></option>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label for="nama">Mendapat Informasi Via</label>
               <option value=""></option>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label for="nama">Detail Info Dari</label>
               <option value=""></option>
            </div>
         </div>
      </div>
   </div>
   <div class="card">
      <div class="card-body py-3">
         <div class="row">
            <div class="col-4 text-start">
               <a href="{{route('admin.pendaftaran.daftar1')}}" class="btn btn-primary">Sebelumnya</a>
            </div>
            <div class="col-4 text-center">

            </div>
            <div class="col-4 text-end">
               <a href="{{route('admin.pendaftaran.detail')}}" class="btn btn-primary">Selanjutnya</a>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('js')

@endsection