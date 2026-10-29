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

// BARU: tiga route di bawah ini
Route::get('/konser/{id}', function ($id) {
 return 'Detail konser nomor ' . $id;
})->whereNumber('id')->name('konser.detail');

Route::get('/tentang', function () {
 return 'Halaman Tentang TiketWar';
})->name('tentang');

Route::get('/info', function () {
 return redirect()->route('tentang');
});