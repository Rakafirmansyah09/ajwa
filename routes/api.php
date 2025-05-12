<?php

use App\Http\Controllers\admin\FaQController;
use App\Http\Controllers\API\PaketController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/hello', [ApiController::class, 'index']);

// Paket
Route::get('/allGroupPaket', [PaketController::class, 'allGroup']);
Route::get('/showGrop/{id}', [PaketController::class, 'groupById']);
Route::get('/searchGroupByName/{name}', [PaketController::class, 'searchGroupByName']);

// news artikel
Route::get('/allNews', [FaQController::class, 'index']);
Route::get('/showNews/{$id}', [FaQController::class, 'show']);

// faq
Route::get('/allFaQ', [FaQController::class, 'index']);
Route::get('/showFaQ/{$id}', [FaQController::class, 'show']);

// auth


// rombongan
