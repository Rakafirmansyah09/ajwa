@extends('template.index')

@section('main')
<div class="page-title">
   <h3>{{ isset($faq) ? 'Edit FAQ' : 'Tambah FAQ' }}</h3>
</div>

<div class="card">
   <div class="card-body">
      <form action="{{ isset($faq) ? route('admin.faq.update') : route('admin.faq.store') }}" method="POST">
         @csrf
         @if(isset($faq))
         <input type="hidden" name="id" value="{{ $faq->id }}">
         @endif

         <div class="mb-3">
            <label for="pertanyaan" class="form-label">Pertanyaan</label>
            <input type="text" name="pertanyaan" class="form-control" id="pertanyaan" value="{{ old('pertanyaan', $faq->pertanyaan ?? '') }}" required>
         </div>

         <div class="mb-3">
            <label for="jawaban" class="form-label">Jawaban</label>
            <textarea name="jawaban" class="form-control" id="jawaban" rows="5" required>{{ old('jawaban', $faq->jawaban ?? '') }}</textarea>
         </div>

         <div class="text-end">
            <a href="{{ route('admin.faq.list') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-warning">{{ isset($faq) ? 'Update' : 'Simpan' }}</button>
         </div>
      </form>
   </div>
</div>
@endsection