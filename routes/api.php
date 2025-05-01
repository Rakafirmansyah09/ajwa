<?php

use App\Http\Controllers\API\PaketController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/hello', [ApiController::class, 'index']);

Route::get('/allGroupPaket', [PaketController::class, 'allGroup']);
Route::get('/groupById/{id}', [PaketController::class, 'groupById']);
Route::get('/searchGroupByName/{name}', [PaketController::class, 'searchGroupByName']);
