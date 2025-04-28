<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BioJemahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\JemaahController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\SalesController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   return redirect()->route('admin.dashboard');
});

Route::get('HomePage', function () {
   return 'halaman homepage';
})->name('homepage');


Route::middleware('auth1:guest')->group(
   function () {
      // auth
      Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
      Route::post('/admin/login', [AuthController::class, 'loginPost'])->name('admin.login.post');
      Route::get('/admin/forgot-password', [AuthController::class, 'forgotPassword'])->name('admin.forgotPassword');
      Route::post('/admin/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('admin.forgotPassword.post');
      Route::get('/admin/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('admin.resetPassword');
      Route::post('/admin/reset-password', [AuthController::class, 'resetPasswordPost'])->name('admin.resetPassword.post');
   }
);

Route::middleware('auth1:admin')->group(function () {
   // auth
   Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

   // dashboard
   Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

   // data Biojemaah
   Route::get('/admin/listJemaah', [BioJemahController::class, 'index'])->name('admin.jemaah.list');
   Route::post('/admin/DeleteJemaah', [BioJemahController::class, 'delete'])->name('admin.jemaah.delete');
   Route::get('/admin/Jemaah/{id}', [BioJemahController::class, 'detail'])->name('admin.jemaah.detail');

   // pendaftaran
   Route::get('/admin/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran');
   Route::get('/admin/Group/{id}/listJemaah', [PendaftaranController::class, 'listJemaah'])->name('admin.group.listJemaah');
   // data Jemaah
   Route::get('/admin/Group/{id}/addJemaah', [JemaahController::class, 'addJemaah'])->name('admin.group.addJemaah');
   Route::get('/admin/Group/{id}/addJemaah/cariNik', [JemaahController::class, 'cariNik'])->name('admin.group.addJemaah.cariNik');
   Route::post('/admin/Group/{id}/addJemaah', [JemaahController::class, 'storeJemaah'])->name('admin.group.storeJemaah');
   Route::get('/admin/Group/jemaah/{id}', [JemaahController::class, 'detail'])->name('admin.group.jemaah.detail'); // ============================= 
   Route::post('/admin/Group/jemaah/delete', [JemaahController::class, 'delete'])->name('admin.group.jemaah.delete');
   // data jemaah pembayaran
   Route::get('/admin/Group/jemaah/{id}/pembayaran', [JemaahController::class, 'addPembayaran'])->name('admin.group.jemaah.addPembayaran');
   Route::post('/admin/Group/jemaah/pembayaran', [JemaahController::class, 'storePembayaran'])->name('admin.group.jemaah.storePembayaran');
   Route::post('/admin/Group/jemaah/pembayaran/delete', [JemaahController::class, 'deletePembayaran'])->name('admin.group.jemaah.deletePembayaran');

   // data paket
   Route::get('/admin/listPaket', [PaketController::class, 'index'])->name('admin.paket.list');
   Route::get('/admin/TambahPaket', [PaketController::class, 'create'])->name('admin.paket.create');
   Route::post('/admin/TambahPaket', [PaketController::class, 'store'])->name('admin.paket.store');
   Route::get('/admin/EditPaket/{id}', [PaketController::class, 'edit'])->name('admin.paket.edit');
   Route::post('/admin/EditPaket', [PaketController::class, 'update'])->name('admin.paket.update');
   Route::post('/admin/DeletePaket', [PaketController::class, 'delete'])->name('admin.paket.delete');
   Route::get('/admin/Peket/{id}', [PaketController::class, 'detail'])->name('admin.paket.detail');
   // data paket faslitas
   Route::get('/admin/Peket/{id}/Fasilitas', [PaketController::class, 'editFasilitas'])->name('admin.paket.editFasilitas');
   Route::post('/admin/Peket/Fasilitas', [PaketController::class, 'editFasilitasStore'])->name('admin.paket.editFasilitas.Store');
   // data paket itinerary
   Route::get('/admin/Peket/{id}/Itinerary', [PaketController::class, 'editItinerary'])->name('admin.paket.editItinerary');
   Route::post('/admin/Peket/Itinerary', [PaketController::class, 'editItineraryStore'])->name('admin.paket.editItinerary.Store');

   // data group
   Route::get('/admin/Paket/{id}/TambahGroup', [GroupController::class, 'create'])->name('admin.group.create');
   Route::post('/admin/TambahGroup', [GroupController::class, 'store'])->name('admin.group.store');
   Route::get('/admin/EditGroup/{id}', [GroupController::class, 'edit'])->name('admin.group.edit');
   Route::post('/admin/EditGrop', [GroupController::class, 'update'])->name('admin.group.update');
   Route::post('/admin/DeleteGrop', [GroupController::class, 'delete'])->name('admin.group.delete');
   Route::get('/admin/Group/{id}', [GroupController::class, 'detail'])->name('admin.group.detail');
   // data group akomodasi
   Route::get('/admin/Group/{id}/Akomodasi', [GroupController::class, 'editAkomodasi'])->name('admin.group.editAkomodasi');
   Route::post('/admin/Group/Akomodasi', [GroupController::class, 'editAkomodasiStore'])->name('admin.group.editAkomodasiStore');
   // data group penerbangan
   Route::get('/admin/Group/{id}/Penerbangan', [GroupController::class, 'editPenerbangan'])->name('admin.group.editPenerbangan');
   Route::post('/admin/Group/Penerbangan', [GroupController::class, 'editPenerbanganStore'])->name('admin.group.editPenerbanganStore');

   // data sales
   Route::get('/admin/listSales', [SalesController::class, 'index'])->name('admin.sales.list');
   Route::get('/admin/TambahSales', [SalesController::class, 'create'])->name('admin.sales.create');
   Route::get('/admin/DetailSales/{id}', [SalesController::class, 'show'])->name('admin.sales.detail');
   Route::post('/admin/TambahSales', [SalesController::class, 'store'])->name('admin.sales.store');
   Route::get('/admin/EditSales/{id}', [SalesController::class, 'edit'])->name('admin.sales.edit');
   Route::post('/admin/EditSales', [SalesController::class, 'update'])->name('admin.sales.update');
   Route::post('/admin/DeleteSales', [SalesController::class, 'destroy'])->name('admin.sales.delete');
});
