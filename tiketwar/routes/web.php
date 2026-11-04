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

// SESUDAH (sementara, untuk uji @empty):
//$daftarKonser = [];

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
 return view('home');
})->name('home');

Route::get('/konser', function () use ($daftarKonser) {
 return view('konser', compact('daftarKonser'));
})->name('konser.index');

// DIGANTI: route detail konser
Route::get('/konser/{id}', function ($id) use ($daftarKonser) {
    abort_unless(isset($daftarKonser[$id]), 404);
    
    return view('konser-detail', [
        'id' => $id,
        'konser' => $daftarKonser[$id],
    ]);
})->whereNumber('id')->name('konser.detail');

Route::view('/tentang', 'about')->name('tentang');