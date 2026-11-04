<?php

use Illuminate\Support\Facades\Route;

// BARU: data konser, letakkan di sini
$daftarKonser = [
 1 => ['nama' => 'Coldplay - Music of the Spheres', 'kota' => 'Jakarta', 'harga' => 1500000, 
'sisa' => 25],
 2 => ['nama' => 'NCT Dream - The Dream Show', 'kota' => 'Jakarta', 'harga' => 1200000, 'sisa' 
=> 0],
 3 => ['nama' => 'Dewa 19 - Pesta Rakyat', 'kota' => 'Yogyakarta', 'harga' => 450000, 'sisa' => 
120],
];

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

// BARU: route /konser, letakkan di paling bawah
Route::get('/konser', function () use ($daftarKonser) {
 return view('konser', compact('daftarKonser'));
})->name('konser.index');