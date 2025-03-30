<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JemahController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->route('admin.dashboard');
});

// dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// data pendaftaran
Route::get('/admin/listPendaftar', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.list');
Route::get('/admin/Pendaftaran', [PendaftaranController::class, 'create'])->name('admin.pendaftaran.create');
Route::post('/admin/Pendaftaran', [PendaftaranController::class, 'store'])->name('admin.pendaftaran.store');
Route::get('/admin/Pendaftaran/search', [PendaftaranController::class, 'search'])->name('admin.pendaftaran.search');
Route::get('/admin/Pendaftaran/{id}/detail', [PendaftaranController::class, 'detail'])->name('admin.pendaftaran.detail');
Route::get('/admin/Pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('admin.pendaftaran.edit');
Route::get('/admin/Pendaftaran/edit', [PendaftaranController::class, 'update'])->name('admin.pendaftaran.update');

Route::get('/admin/Pendaftaran/{id}/addPembayaran', [PendaftaranController::class, 'addPembayaran'])->name('admin.pendaftaran.addPembayaran');
Route::post('/admin/Pendaftaran/addPembayaran', [PendaftaranController::class, 'addPembayaranStore'])->name('admin.pendaftaran.addPembayaran.store');





// data jemaah
Route::get('/admin/listJemaah', [JemahController::class, 'index'])->name('admin.jemaah.list');
Route::get('/admin/TambahJemaah', [JemahController::class, 'create'])->name('admin.jemaah.create');
Route::post('/admin/TambahJemaah', [JemahController::class, 'store'])->name('admin.jemaah.store');
Route::get('/admin/EditJemaah/{id}', [JemahController::class, 'edit'])->name('admin.jemaah.edit');
Route::post('/admin/EditJemaah', [JemahController::class, 'update'])->name('admin.jemaah.update');
Route::post('/admin/DeleteJemaah', [JemahController::class, 'delete'])->name('admin.jemaah.delete');
Route::get('/admin/Jemaah/{id}', [JemahController::class, 'detail'])->name('admin.jemaah.detail');


// data paket
Route::get('/admin/listPaket', [PaketController::class, 'index'])->name('admin.paket.list');
Route::get('/admin/TambahPaket', [PaketController::class, 'create'])->name('admin.paket.create');
Route::post('/admin/TambahPaket', [PaketController::class, 'store'])->name('admin.paket.store');
Route::get('/admin/EditPaket/{id}', [PaketController::class, 'edit'])->name('admin.paket.edit');
Route::post('/admin/EditPaket', [PaketController::class, 'update'])->name('admin.paket.update');
Route::post('/admin/DeletePaket', [PaketController::class, 'delete'])->name('admin.paket.delete');
Route::get('/admin/Peket/{id}', [PaketController::class, 'detail'])->name('admin.paket.detail');


// admin
