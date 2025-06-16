<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BioJemahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\FaQController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\JemaahController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   return redirect()->route('admin.login');
});


Route::middleware('auth1:guest')->group(function () {
   // auth
   Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
   Route::post('/admin/login', [AuthController::class, 'loginPost'])->name('admin.login.post');
   Route::get('/admin/forgot-password', [AuthController::class, 'forgotPassword'])->name('admin.forgotPassword');
   Route::post('/admin/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('admin.forgotPassword.post');
   Route::get('/admin/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('admin.resetPassword');
   Route::post('/admin/reset-password', [AuthController::class, 'resetPasswordPost'])->name('admin.resetPassword.post');
});

Route::middleware('auth1:admin')->group(function () {
   // auth
   Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

   // dashboard
   Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

   // ====================================== data Biojemaah ======================================
   Route::get('/admin/listJemaah', [BioJemahController::class, 'index'])->name('admin.biojemaah.list');
   // Route::get('/admin/addJemaah', [BioJemahController::class, 'add'])->name('admin.biojemaah.add');
   // Route::post('/admin/addJemaah', [BioJemahController::class, 'addPost'])->name('admin.biojemaah.addPost');
   Route::get('/admin/editJemaah/{id}', [BioJemahController::class, 'edit'])->name('admin.biojemaah.edit');
   Route::post('/admin/editJemaah', [BioJemahController::class, 'editPost'])->name('admin.biojemaah.editPost');
   Route::post('/admin/DeleteJemaah', [BioJemahController::class, 'delete'])->name('admin.biojemaah.delete');
   Route::get('/admin/Jemaah/{id}', [BioJemahController::class, 'detail'])->name('admin.biojemaah.detail');
   Route::post('/admin/DeleteAkun', [BioJemahController::class, 'deleteAkun'])->name('admin.biojemaah.deleteAkun');
   Route::post('/admin/UpdateAkun', [BioJemahController::class, 'updateAkun'])->name('admin.biojemaah.updateAkun');

   // ====================================== pendaftaran ======================================
   Route::get('/admin/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran');
   Route::get('/admin/Group/{id}/listJemaah', [PendaftaranController::class, 'listJemaah'])->name('admin.group.listJemaah');
   Route::get('/admin/Group/{id}/addJemaah', [JemaahController::class, 'addJemaah'])->name('admin.pendaftaran.addJemaah');
   Route::get('/admin/Group/{id}/addJemaah/cariNik', [JemaahController::class, 'cariNik'])->name('admin.pendaftaran.addJemaah.cariNik');
   // data Jemaah
   Route::post('/admin/Group/{id}/addJemaah', [JemaahController::class, 'storeJemaah'])->name('admin.pendaftaran.storeJemaah');
   Route::get('/admin/Group/jemaah/{id}', [JemaahController::class, 'detail'])->name('admin.jemaah.detail');
   Route::post('/admin/Group/jemaah/delete', [JemaahController::class, 'delete'])->name('admin.jemaah.delete');
   // jemaah update?
   // data jemaah peembatalan
   Route::post('/admin/Group/jemaah/{id}/pembatalan', [JemaahController::class, 'batalBerangkat'])->name('admin.jemaah.batalBerangkat');
   Route::get('/admin/Group/jemaah/{id}/lanjutkan', [JemaahController::class, 'lanjuttBerangkat'])->name('admin.jemaah.lanjuttBerangkat');
   // ganti group
   Route::get('/admin/Group/jemaah/{idJemaah}/gantiGrup/{idgrup}', [JemaahController::class, 'gantiGrup'])->name('admin.jemaah.gantiGrup');

   // data rombongan
   Route::post('/admin/jemaah/addRombongan/', [JemaahController::class, 'addRombongan'])->name('admin.jemaah.addRombongan');
   Route::get('/admin/jemaah/{idJemaah}/deleteRombongan', [JemaahController::class, 'deleteRombongan'])->name('admin.jemaah.deleteRombongan');
   // data jemaah pembayaran
   Route::get('/admin/Group/jemaah/{id}/pembayaran', [JemaahController::class, 'addPembayaran'])->name('admin.jemaah.addPembayaran');
   Route::post('/admin/Group/jemaah/pembayaran', [JemaahController::class, 'storePembayaran'])->name('admin.jemaah.storePembayaran');
   Route::post('/admin/Group/jemaah/pembayaran/delete', [JemaahController::class, 'deletePembayaran'])->name('admin.jemaah.deletePembayaran');
   // data jemaah pembayaran mitrans
   Route::post('/generate-snap', [JemaahController::class, 'apiGenerateSnap'])->name('api.generate-snap');
   // data jemaah invoice
   Route::get('/admin/invoice/jemaah/{id}', [JemaahController::class, 'showInvoice'])->name('invoice.show');


   // ====================================== data paket ======================================
   Route::get('/admin/listPaket', [PaketController::class, 'index'])->name('admin.paket.list');
   Route::get('/admin/listAllGroup', [PaketController::class, 'listAllGroup'])->name('admin.paket.listAllGroup');
   Route::get('/admin/TambahPaket', [PaketController::class, 'create'])->name('admin.paket.create');
   Route::post('/admin/TambahPaket', [PaketController::class, 'store'])->name('admin.paket.store');
   Route::get('/admin/EditPaket/{id}', [PaketController::class, 'edit'])->name('admin.paket.edit');
   Route::post('/admin/EditPaket', [PaketController::class, 'update'])->name('admin.paket.update');
   Route::post('/admin/DeletePaket', [PaketController::class, 'delete'])->name('admin.paket.delete');
   Route::get('/admin/DetailPeket/{id}', [PaketController::class, 'detail'])->name('admin.paket.detail');
   // data paket faslitas
   Route::get('/admin/Peket/{id}/Fasilitas', [PaketController::class, 'editFasilitas'])->name('admin.paket.editFasilitas');
   Route::post('/admin/Peket/Fasilitas', [PaketController::class, 'editFasilitasStore'])->name('admin.paket.editFasilitas.Store');
   // data paket itinerary
   Route::get('/admin/Peket/{id}/Itinerary', [PaketController::class, 'editItinerary'])->name('admin.paket.editItinerary');
   Route::post('/admin/Peket/Itinerary', [PaketController::class, 'editItineraryStore'])->name('admin.paket.editItinerary.Store');

   // ====================================== data group ======================================
   Route::get('/admin/Paket/{id}/TambahGroup', [GroupController::class, 'create'])->name('admin.group.create');
   Route::post('/admin/TambahGroup', [GroupController::class, 'store'])->name('admin.group.store');
   Route::get('/admin/EditGroup/{id}', [GroupController::class, 'edit'])->name('admin.group.edit');
   Route::post('/admin/EditGrop', [GroupController::class, 'update'])->name('admin.group.update');
   Route::post('/admin/DeleteGrop', [GroupController::class, 'delete'])->name('admin.group.delete');
   Route::get('/admin/DetailGroup/{id}', [GroupController::class, 'detail'])->name('admin.group.detail');
   // data group akomodasi
   Route::get('/admin/Group/{id}/Akomodasi', [GroupController::class, 'editAkomodasi'])->name('admin.group.editAkomodasi');
   Route::post('/admin/Group/Akomodasi', [GroupController::class, 'editAkomodasiStore'])->name('admin.group.editAkomodasiStore');
   // data group penerbangan
   Route::get('/admin/Group/{id}/Penerbangan', [GroupController::class, 'editPenerbangan'])->name('admin.group.editPenerbangan');
   Route::post('/admin/Group/Penerbangan', [GroupController::class, 'editPenerbanganStore'])->name('admin.group.editPenerbanganStore');

   // ====================================== data sales ======================================
   Route::get('/admin/listSales', [SalesController::class, 'index'])->name('admin.sales.list');
   Route::get('/admin/TambahSales', [SalesController::class, 'create'])->name('admin.sales.create');
   Route::get('/admin/DetailSales/{id}', [SalesController::class, 'show'])->name('admin.sales.detail');
   Route::post('/admin/TambahSales', [SalesController::class, 'store'])->name('admin.sales.store');
   Route::get('/admin/EditSales/{id}', [SalesController::class, 'edit'])->name('admin.sales.edit');
   Route::post('/admin/EditSales', [SalesController::class, 'update'])->name('admin.sales.update');
   Route::post('/admin/DeleteSales', [SalesController::class, 'destroy'])->name('admin.sales.delete');

   // ====================================== data News ======================================
   Route::get('/admin/listNews', [NewsController::class, 'list'])->name('admin.news.list');
   Route::get('/admin/TambahNews', [NewsController::class, 'create'])->name('admin.news.create');
   Route::post('/admin/TambahNews', [NewsController::class, 'store'])->name('admin.news.store');
   Route::get('/admin/EditNews/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
   Route::post('/admin/EditNews', [NewsController::class, 'update'])->name('admin.news.update');
   Route::post('/admin/DeleteNews', [NewsController::class, 'delete'])->name('admin.news.delete');
   Route::get('/admin/DetailNews/{id}', [NewsController::class, 'detail'])->name('admin.news.detail');
   Route::get('/admin/PublishNews/{id}', [NewsController::class, 'publish'])->name('admin.news.publish');

   // ====================================== data faq ======================================
   Route::get('/admin/listFaQ', [FaQController::class, 'list'])->name('admin.faq.list');
   Route::get('/admin/TambahFaQ', [FaQController::class, 'create'])->name('admin.faq.create');
   Route::post('/admin/TambahFaQ', [FaQController::class, 'store'])->name('admin.faq.store');
   Route::get('/admin/EditFaQ/{id}', [FaQController::class, 'edit'])->name('admin.faq.edit');
   Route::post('/admin/EditFaQ', [FaQController::class, 'update'])->name('admin.faq.update');
   Route::post('/admin/DeleteFaQ', [FaQController::class, 'delete'])->name('admin.faq.delete');

   // ====================================== profile ======================================
   Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
   Route::post('/profile/biodata', [ProfileController::class, 'updateBiodata'])->name('profile.updateBiodata');
   Route::post('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
   Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

   // ====================================== profile ======================================
   Route::get('/admin/listadmin', [AdminController::class, 'index'])->name('admin.admin.list');
   Route::get('/admin/TambahAdmin', [AdminController::class, 'create'])->name('admin.admin.create');
   Route::post('/admin/TambahAdmin', [AdminController::class, 'store'])->name('admin.admin.store');
   Route::get('/admin/EditAdmin/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
   Route::post('/admin/EditAdmin', [AdminController::class, 'update'])->name('admin.admin.update');
   Route::post('/admin/DeleteAdmin', [AdminController::class, 'destroy'])->name('admin.admin.delete');

   // ====================================== profile ======================================
   Route::get('/admin/Laporan', [LaporanController::class, 'index'])->name('admin.laporan');
   // Route::get('/admin/Laporan/Download', [LaporanController::class, 'download'])->name('admin.laporan.download');
   Route::get('/admin/Laporan/{id}/DownloadExcel', [LaporanController::class, 'downloadExcel'])->name('admin.laporan.downloadExcel');




   // ====================================== mobile ======================================
   Route::get('/reset-password/{token}', [ApiController::class, 'resetPassword'])->name('password.reset');
});
Route::post('/admin/biojemaah/upload-ktp', [BioJemahController::class, 'uploadKtp'])->name('admin.biojemaah.uploadKtp');
Route::post('/admin/biojemaah/upload-paspor', [BioJemahController::class, 'uploadPaspor'])->name('admin.biojemaah.uploadPaspor');
