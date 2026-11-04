<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// BARU: dua route di bawah ini
Route::get('/halo', function () {
 return 'Halo, selamat datang di TiketWar!';
});

Route::get('/ping', function () {
 return ['status' => 'ok', 'aplikasi' => 'TiketWar'];
});