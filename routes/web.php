<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JemahController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PendaftaranController;
use Illuminate\Support\Facades\Route;

// dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// data pendaftaran
Route::get('/admin/listPendaftar', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.list');
Route::get('/admin/TambahPendaftar/step1', [PendaftaranController::class, 'daftar1'])->name('admin.pendaftaran.daftar1');
Route::get('/admin/TambahPendaftar/step2', [PendaftaranController::class, 'daftar2'])->name('admin.pendaftaran.daftar2');
Route::get('/admin/TambahPendaftar/step3', [PendaftaranController::class, 'daftar3'])->name('admin.pendaftaran.daftar3');
Route::get('/admin/TambahPendaftar/detail', [PendaftaranController::class, 'detail'])->name('admin.pendaftaran.detail');

Route::post('/admin/TambahPendaftar', [PendaftaranController::class, 'store'])->name('admin.pendaftaran.store');
Route::get('/admin/EditJemaah/{id}', [PendaftaranController::class, 'edit'])->name('admin.pendaftaran.edit');
Route::post('/admin/EditPendaftar', [PendaftaranController::class, 'update'])->name('admin.pendaftaran.update');
Route::post('/admin/DeletePendaftar', [PendaftaranController::class, 'delet'])->name('admin.pendaftaran.delete');


// data jemaah
Route::get('/admin/listJemaah', [JemahController::class, 'index'])->name('admin.jemaah.list');
Route::get('/admin/TambahJemaah', [JemahController::class, 'create'])->name('admin.jemaah.create');
Route::post('/admin/TambahJemaah', [JemahController::class, 'store'])->name('admin.jemaah.store');
Route::get('/admin/EditJemaah/{id}', [JemahController::class, 'edit'])->name('admin.jemaah.edit');
Route::post('/admin/EditJemaah', [JemahController::class, 'update'])->name('admin.jemaah.update');
Route::post('/admin/DeleteJemaah', [JemahController::class, 'delet'])->name('admin.jemaah.delete');


// data paket
Route::get('/admin/listPaket', [PaketController::class, 'index'])->name('admin.paket.list');
Route::get('/admin/TambahPaket', [PaketController::class, 'create'])->name('admin.paket.create');
Route::post('/admin/TambahPaket', [PaketController::class, 'store'])->name('admin.paket.store');
Route::get('/admin/EditPaket/{id}', [PaketController::class, 'edit'])->name('admin.paket.edit');
Route::post('/admin/EditPaket', [PaketController::class, 'update'])->name('admin.paket.update');
Route::post('/admin/DeletePaket', [PaketController::class, 'delet'])->name('admin.paket.delete');


// admin
