<?php

use App\Http\Controllers\Admin\BioJemahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\JemaahController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->route('admin.dashboard');
});

// dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// pendaftaran
Route::get('/admin/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran');

// data Biojemaah
Route::get('/admin/listJemaah', [BioJemahController::class, 'index'])->name('admin.jemaah.list');
Route::post('/admin/DeleteJemaah', [BioJemahController::class, 'delete'])->name('admin.jemaah.delete');
Route::get('/admin/Jemaah/{id}', [BioJemahController::class, 'detail'])->name('admin.jemaah.detail');

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

// data group
Route::get('/admin/Paket/{id}/TambahGroup', [GroupController::class, 'create'])->name('admin.group.create');
Route::post('/admin/TambahGroup', [GroupController::class, 'store'])->name('admin.group.store');
Route::get('/admin/EditGroup/{id}', [GroupController::class, 'edit'])->name('admin.group.edit');
Route::post('/admin/EditGrop', [GroupController::class, 'update'])->name('admin.group.update');
Route::post('/admin/DeleteGrop', [GroupController::class, 'delete'])->name('admin.group.delete');
Route::get('/admin/Group/{id}', [GroupController::class, 'detail'])->name('admin.group.detail');

// data Jemaah
Route::get('/admin/Group/{id}/addJemaah', [JemaahController::class, 'addJemaah'])->name('admin.group.addJemaah');
Route::get('/admin/Group/{id}/addJemaah/cariNik', [JemaahController::class, 'cariNik'])->name('admin.group.addJemaah.cariNik');
Route::post('/admin/Group/{id}/addJemaah', [JemaahController::class, 'storeJemaah'])->name('admin.group.storeJemaah');
Route::get('/admin/Group/jemaah/{id}', [JemaahController::class, 'detail'])->name('admin.group.jemaah.detail');
Route::post('/admin/Group/jemaah/delete', [JemaahController::class, 'delete'])->name('admin.group.jemaah.delete');
