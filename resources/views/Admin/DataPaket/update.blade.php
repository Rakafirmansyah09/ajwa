@extends('template.index')

@section('css')


@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Tambah Paket</h3>
         <p class="text-subtitle text-muted"></p>
      </div>
   </div>
</div>

<div class="page-content">
   <div class="card">
      <div class="card-header">
         <h5 class="card-title">
            Paket
         </h5>
      </div>
      <div class="card-body">
         <form method="post" action="{{route('admin.paket.store')}}">
            @csrf
            <div class="row">
               <div class="col-md-6">
                  <input type="hidden" name="id" value="">
                  <div class="form-group">
                     <label for="nama">Nama Paket</label>
                     <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Paket">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="tanggal">Tanggal Keberangakatan</label>
                     <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal Keberangakatn">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="durasi">Durasi</label>
                     <input type="number" name="durasi" class="form-control" id="durasi" placeholder="Durasi Hari">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="harga">Harga</label>
                     <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Rp.">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="detail">Detail</label>
                     <textarea class="form-control" id="detail" name="detail" rows="3" style="height: 209px;"></textarea>
                  </div>
               </div>
            </div>
            <div>
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

@section('js')

@endsection