<?php

use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\jemaahController;
use App\Http\Controllers\API\PaketController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [ApiController::class, 'test']);
Route::get('/unauthorized', [ApiController::class, 'unauthorized'])->name('login');

// ====================================== webhook ======================================
Route::post('/midtrans/notification', [PembayaranController::class, 'webhook'])->name('webhook');
// https://tiketadjwa.my.id/api/midtrans/notification

// Paket
Route::get('/allGroupPaket', [PaketController::class, 'allGroup']); //oke
Route::get('/showGroup/{id}', [PaketController::class, 'groupById']); //oke
Route::get('/searchGroupByName/{name}', [PaketController::class, 'searchGroupByName']); //oke

// news artikel
Route::get('/allNews', [ArtikelController::class, 'list']);
Route::get('/showNews/{$id}', [ArtikelController::class, 'show']);

// faq
Route::get('/allFaQ', [FAQController::class, 'index']);
Route::get('/showFaQ/{$id}', [FaQController::class, 'show']);

// auth
Route::post('/auth/login', [AuthController::class, 'login']); //oke
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']); //oke
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']); //oke

Route::middleware('auth:sanctum')->group(function () {
   // user
   Route::get('/user/profile', [UserController::class, 'profile']); //oke
   Route::post('/user/change-password', [UserController::class, 'changePassword']);  //oke

   // mypaket
   Route::get('/allMyPaket', [PaketController::class, 'allMyPaket']); //oke
   Route::get('/myPaket/{id}', [PaketController::class, 'myPaket']); //oke

   // jemaah
   Route::get('/jemaah/{id}', [jemaahController::class, 'jemaahById']);


   // rombonganku
});
