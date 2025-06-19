<script src="{{ asset('mazer/extensions/sweetalert2/sweetalert2.all.js') }}"></script>
<script>
   // ========== ALERT ==========
   function showAlertInfo(title = 'Info', message = 'Ini adalah pesan info.') {
      Swal.fire({
         icon: 'info',
         title: title,
         text: message,
      });
   }

   function showAlertSuccess(title = 'Berhasil', message = 'Operasi berhasil dilakukan.') {
      Swal.fire({
         icon: 'success',
         title: title,
         text: message,
      });
   }

   function showAlertWarning(title = 'Peringatan', message = 'Harap periksa kembali.') {
      Swal.fire({
         icon: 'warning',
         title: title,
         text: message,
      });
   }

   function showAlertError(title = 'Gagal', message = 'Terjadi kesalahan.') {
      Swal.fire({
         icon: 'error',
         title: title,
         text: message,
      });
   }

   // ========== CONFIRM ==========
   function confirmInfo(title = 'Konfirmasi Info', message = 'Apakah Anda yakin?', confirmCallback = () => {}) {
      event.preventDefault(); // cegah submit langsung
      Swal.fire({
         icon: 'info',
         title: title,
         text: message,
         showCancelButton: true,
         confirmButtonText: 'Ya',
         cancelButtonText: 'Batal'
      }).then((result) => {
         if (result.isConfirmed) {
            confirmCallback();
         }
      });
   }

   function confirmWarning(title = 'Konfirmasi Peringatan', message = 'Tindakan ini bisa berisiko.', confirmCallback = () => {}) {
      event.preventDefault(); // cegah submit langsung
      Swal.fire({
         icon: 'warning',
         title: title,
         text: message,
         showCancelButton: true,
         confirmButtonColor: '#f59e0b',
         cancelButtonColor: '#6b7280',
         confirmButtonText: 'Lanjutkan',
         cancelButtonText: 'Batal'
      }).then((result) => {
         if (result.isConfirmed) {
            confirmCallback();
         }
      });
   }

   function confirmDanger(title = 'Hapus Data?', message = 'Data akan dihapus permanen.', confirmCallback = () => {}) {
      event.preventDefault(); // cegah submit langsung
      Swal.fire({
         icon: 'error',
         title: title,
         text: message,
         showCancelButton: true,
         confirmButtonColor: '#d33',
         cancelButtonColor: '#3085d6',
         confirmButtonText: 'Ya, hapus!',
         cancelButtonText: 'Batal'
      }).then((result) => {
         if (result.isConfirmed) {
            confirmCallback();
         }
      });
   }

   // ========== Contoh Penggunaan ==========
   // showAlertInfo('Halo', 'Selamat datang di sistem!');
   // confirmDanger('Yakin Hapus?', 'Tindakan ini tidak bisa dibatalkan!', () => {
   //    // aksi setelah dikonfirmasi
   //    window.location.href = 'url';
   // });
</script>