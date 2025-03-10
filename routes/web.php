<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form-layout');
});

Route::get('/table', function () {
    return view('table-datatable');
});
