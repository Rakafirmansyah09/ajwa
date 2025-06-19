@extends('template.index')

@section('main')
<div class="page-title">
   <h3>List FAQ</h3>
   <p class="text-subtitle text-muted">Daftar pertanyaan yang sering diajukan</p>
</div>

<div class="card">
   <div class="card-header d-flex justify-content-between">
      <h4 class="card-title">Tabel FAQ</h4>
      <a href="{{ route('admin.faq.create') }}" class="btn btn-success">Tambah FAQ</a>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-striped" id="faq-table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Pertanyaan</th>
                  <th>Jawaban</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach($faqs as $faq)
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $faq->pertanyaan }}</td>
                  <!-- <td>{{ Str::limit(strip_tags($faq->jawaban), 50) }}</td> -->
                  <td>{{ $faq->jawaban }}</td>
                  <td>
                     <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                     <form action="{{ route('admin.faq.delete') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{ $faq->id }}">
                        <button
                           type="submit"
                           class="btn btn-sm btn-danger"
                           onclick="confirmDanger('Hapus FaQ', 
                           'Yakin akan menghapsu FaQ ini?', 
                           ()=>{this.form.submit();})">Hapus</button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection