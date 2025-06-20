@extends('template.index')

@section('css')
<style>
   .card-harga {
      border: 1px solid #D9D9D9;
      padding: 10px;
      background-color: #D9D9D9;
      border-radius: 5px;
   }

   .card-harga:hover {
      background-color: #94929B;
      cursor: pointer;
      color: white;
   }

   .hidden {
      display: none;
   }
</style>
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
   <div class="card-body">
      <form id="form-pembayaran" action="{{ isset($pembayaran) ? route('admin.group.jemaah.updatePembayaran', $pembayaran->id) : route('admin.jemaah.storePembayaran') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="jemaah_id" value="{{ $jemaah->id }}">
         <input type="hidden" name="harga" id="harga" value="{{ old('harga', $pembayaran->harga ?? '') }}">
         <input type="hidden" name="method" id="selected-method" value="{{ old('method', $pembayaran->method ?? '') }}">

         {{-- Metode Pembayaran --}}
         <div class="form-group mb-4">
            <label for="method">Pilih Metode Pembayaran</label>
            <select id="methodSelector" class="form-control" required>
               <option value="">-- Pilih Metode --</option>
               <option value="digital" {{ old( $pembayaran->method ?? '') == 'digital' ? 'selected' : '' }}>Digital (Midtrans)</option>
               <option value="tunai" {{ old( $pembayaran->method ?? '') == 'tunai' ? 'selected' : '' }}>Tunai</option>
            </select>
         </div>

         {{-- Bagian Pilihan Harga --}}
         <div id="section-harga" class="mb-4 hidden">
            <label>Pilih Jumlah Pembayaran</label>
            <div class="row">
               @php
               $hargas = [1000000, 2000000, 5000000, 7000000, 10000000, 15000000];
               @endphp
               @foreach ($hargas as $harga)
               <div class="col-sm-6 col-md-3 mb-3" onclick="setHarga('{{$harga}}')">
                  <div class="card-harga">
                     Rp. {{ number_format($harga, 0, ',', '.') }}
                  </div>
               </div>
               @endforeach
            </div>
            <div class="form-group">
               <label>Jumlah Pembayaran</label>
               <input type="text" id="harga_display" class="form-control" placeholder="Isi nominal jika manual..." data-max="{{ $belumBayar }}">
            </div>
         </div>

         {{-- Jika Tunai --}}
         <div id="form-tunai" class="hidden">
            <div class="form-group">
               <label for="detail">Catatan / Detail Tambahan</label>
               <textarea name="detail" class="form-control" rows="3">{{ old('detail', $pembayaran->detail ?? '') }}</textarea>
            </div>
            <div class="text-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </div>

         {{-- Jika Digital --}}
         <div id="form-digital" class="hidden">
            <div class="text-center">
               <button type="button" id="btn-bayar" class="btn btn-primary">Bayar Sekarang (Midtrans)</button>
            </div>
         </div>

      </form>
   </div>
</div>
@endsection

@section('js')
<script>
   // jumlah max pembayaran
   const maxAmount = <?php echo $belumBayar; ?>;

   function formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID', {
         style: 'currency',
         currency: 'IDR',
         minimumFractionDigits: 0
      }).format(angka);
   }

   function setHarga(amount) {
      if (amount > maxAmount) {
         amount = maxAmount;
         alert('Jumlah tagihan yang belum dibayar ' + formatRupiah(maxAmount));
      }
      document.getElementById('harga').value = amount;
      document.getElementById('harga_display').value = formatRupiah(amount);
   }

   document.addEventListener('DOMContentLoaded', function() {
      const initialValue = document.getElementById('harga').value;
      if (initialValue) {
         document.getElementById('harga_display').value = formatRupiah(initialValue);
      }

      const methodSelector = document.getElementById('methodSelector');
      const sectionHarga = document.getElementById('section-harga');
      const formTunai = document.getElementById('form-tunai');
      const formTransfer = document.getElementById('form-digital');
      const selectedMethod = document.getElementById('selected-method');

      function toggleForm(method) {
         selectedMethod.value = method;
         if (method === 'tunai') {
            sectionHarga.classList.remove('hidden');
            formTunai.classList.remove('hidden');
            formTransfer.classList.add('hidden');
         } else if (method === 'digital') {
            sectionHarga.classList.remove('hidden');
            formTunai.classList.add('hidden');
            formTransfer.classList.remove('hidden');
         } else {
            sectionHarga.classList.add('hidden');
            formTunai.classList.add('hidden');
            formTransfer.classList.add('hidden');
         }
      }

      methodSelector.addEventListener('change', function(e) {
         toggleForm(e.target.value);
      });

      toggleForm(methodSelector.value); // Init

      let snapToken = null; // Menyimpan token SNAP

      // Handle Midtrans payment
      document.getElementById('btn-bayar').addEventListener('click', function() {
         const harga = document.getElementById('harga').value;
         const jemaah_id = '{{ $jemaah->id }}';

         if (!harga || harga == 0) {
            alert('Silakan pilih atau isi nominal pembayaran.');
            return;
         }

         // Jika snapToken sudah ada, langsung tampilkan popup tanpa fetch ulang
         if (snapToken) {
            showSnapPopup(snapToken);
            return;
         }

         fetch("{{ route('api.generate-snap') }}", {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
               },
               body: JSON.stringify({
                  jemaah_id: jemaah_id,
                  harga: harga
               })
            })
            .then(response => response.json())
            .then(data => {
               if (data.success) {
                  snapToken = data.data; // Simpan token snap
                  showSnapPopup(snapToken);
               } else {
                  alert(data.message || 'Gagal mendapatkan token pembayaran.');
               }
            })
            .catch(error => {
               console.error(error);
               alert('Terjadi kesalahan saat menghubungi server.');
            });
      });

      function showSnapPopup(token) {
         window.snap.pay(token, {
            onSuccess: function(result) {
               showAlertSuccess('Berhasil', 'Pembayaran berhasil!');
               window.location.href = "{{ route('admin.jemaah.detail', $jemaah->id) }}";
            },
            onPending: function(result) {
               // alert('Pembayaran pending!');
               showAlertWarning('Pending', 'Pembayaran sedang diproses.');
               window.location.href = "{{ route('admin.jemaah.detail', $jemaah->id) }}";
            },
            onError: function(result) {
               showAlertError('Gagal', 'Pembayaran gagal!');
               window.location.href = "{{ route('admin.jemaah.detail', $jemaah->id) }}";
            },
            onClose: function() {
               showAlertWarning('Pending', 'Anda belum menyelesaikan pembayaran ');
            }
         });
      }

      // Format input harga manual
      document.getElementById('harga_display').addEventListener('input', function(e) {
         let value = e.target.value.replace(/[^\d]/g, '');
         let max = e.target.dataset.max;
         value = parseInt(value) || 0;
         if (value > max) value = max;
         document.getElementById('harga').value = value;
         e.target.value = formatRupiah(value);
      });

   });
</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
@endsection