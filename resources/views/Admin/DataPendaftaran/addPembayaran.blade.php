@extends('template.index')

@section('css')

@endsection

@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
         <h3>Pembayaran</h3>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <h5 class="card-title">
         Pembayaran Pendaftaran
      </h5>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.pendaftaran.addPembayaran.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-12 col-md-6">
               <label for="pendaftaran_id" class="form-label">ID Pendaftaran</label>
               <input type="text" class="form-control" id="pendaftaran_id" name="pendaftaran_id" required readonly value="{{ $data->id }}">
            </div>
            <div class="col-12 col-md-6">
               <label for="harga" class="form-label">Harga</label>
               <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="col-12 col-md-6">
               <label for="bukti" class="form-label">Upload Bukti Pembayaran</label>
               <input type="file" class="form-control" id="bukti" name="bukti" required>
            </div>
            <div class="col-12 col-md-6">
               <label for="method" class="form-label">Metode Pembayaran</label>
               <select class="form-control" id="method" name="method" required>
                  <option value="transfer">Transfer</option>
                  <option value="cash">Cash</option>
               </select>
            </div>
            <div class="col-12">
               <label for="detail" class="form-label">Detail</label>
               <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
            </div>
         </div>
         <div class="text-end mt-2">
            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
         </div>
      </form>
   </div>

</div>

@endsection

@section('js')
@endsection