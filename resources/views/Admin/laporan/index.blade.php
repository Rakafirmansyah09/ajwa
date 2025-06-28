@extends('template.index')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
@endsection


@section('main')
<div class="page-title">
   <div class="row">
      <div class="col-12 col-md-8 order-md-1 order-last">
         <h3>Laporan Data</h3>
         <p class="text-subtitle text-muted">Laporan Data Jemaah berdasarkan Group Keberangkatan</p>
      </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
      <form class="row g-3 align-items-center justify-content-start" action="{{ route('admin.laporan') }}" method="GET">
         <div class="col-auto">
            <label for="group_id" class="col-form-label fw-bold">Pilih Group Keberangkatan:</label>
         </div>
         <div class="col">
            <select name="group_id" id="group_id" class="w-100" required>
               <option value="">-- Tidak Ada Group Yang Dipilih --</option>
               @foreach ($groups as $group)
               <option value="{{ $group->id }}" {{ request('group_id') == $group->id ? 'selected' : '' }}>
                  {{ $group->paket->nama ?? '-' }} - {{ \Carbon\Carbon::parse($group->tanggal_keberangkatan)->format('d M Y') }}
               </option>
               @endforeach
            </select>
         </div>
         <div class="col-auto">
            <button type="submit" class="btn btn-primary">
               <i class="bi bi-search"></i> Tampilkan
            </button>
         </div>
      </form>
   </div>
</div>

@if(isset($jemaah))
<div class="card mt-3">
   <div class="card-header d-flex justify-content-between align-items-center">
      <h5><b>Data Jemaah</b></h5>
      <a href="{{ route('admin.laporan.downloadExcel', ['id' => request('group_id')]) }}" class="btn btn-success btn-sm">
         Download Excel
      </a>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>No HP</th>
                  <th>Status</th>
                  <th>Pembayaran</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($jemaah as $i => $item)
               <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $item->bioJemaah->nama_lengkap }}</td>
                  <td>{{ $item->bioJemaah->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                  <td>{{ $item->no_hp }}</td>
                  </td>
                  @php
                  $totalBayar = $item->pembayaran ? $item->pembayaran->sum('harga') : 0;
                  $status = $totalBayar >= $item->group->paket->harga ? 'Lunas' : 'Belum Lunas';
                  @endphp
                  <td>
                     <span class="fw-bold text-{{ $status == 'LUNAS' ? 'success' : 'danger' }}">{{ $status }}</span>
                  </td>
                  <td>
                     Rp. {{number_format($totalBayar, 0, ',', '.')}} /
                     Rp. {{number_format($item->group->paket->harga, 0, ',', '.')}}
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="6" class="text-center">Tidak ada data jemaah.</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>
@endif

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
   new TomSelect('#group_id', {
      create: false,
      sortField: {
         field: "text",
         direction: "asc"
      },
      placeholder: "Pilih group keberangkatan...",
      allowEmptyOption: true
   });
</script>
@endsection