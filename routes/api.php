<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\PaketController;
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


// rombongan
