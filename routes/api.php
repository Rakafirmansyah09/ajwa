<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\PaketController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/hello', [ApiController::class, 'index']);

// Paket
Route::get('/allGroupPaket', [PaketController::class, 'allGroup']);
Route::get('/showGroup/{id}', [PaketController::class, 'groupById']);
Route::get('/searchGroupByName/{name}', [PaketController::class, 'searchGroupByName']);

// news artikel
Route::get('/allNews', [ArtikelController::class, 'list']);
Route::get('/showNews/{$id}', [ArtikelController::class, 'show']);

// faq
Route::get('/allFaQ', [FAQController::class, 'index']);
Route::get('/showFaQ/{$id}', [FaQController::class, 'show']);

// auth
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
   // user
   Route::get('/user/profile', [UserController::class, 'profile']);
   Route::post('/user/change-password', [UserController::class, 'changePassword']);

   // paketku
   

   // rombonganku
});
