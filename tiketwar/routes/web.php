<?php
use App\Http\Controllers\KonserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController; // BARU

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/tentang', 'about')->name('tentang');

Route::get('/konser', [KonserController::class, 'index'])->name('konser.index');
Route::get('/konser/create', [KonserController::class, 'create'])
    ->name('konser.create'); // BARU
Route::post('/konser', [KonserController::class, 'store'])
    ->name('konser.store'); // BARU
Route::get('/konser/{id}', [KonserController::class, 'show'])
    ->whereNumber('id')->name('konser.detail');
 Route::get('/konser/{id}/edit', [KonserController::class, 'edit'])
    ->whereNumber('id')->name('konser.edit'); // BARU
Route::put('/konser/{id}', [KonserController::class, 'update'])
    ->whereNumber('id')->name('konser.update'); // BARU
Route::delete('/konser/{id}', [KonserController::class, 'destroy'])
    ->whereNumber('id')->name('konser.destroy'); // BARU

// Transaksi dan Laporan: pesanan // BARU
Route::get('/konser/{konser}/pesan', [PesananController::class, 'create'])
    ->whereNumber('konser')->name('pesanan.create');
Route::post('/konser/{konser}/pesan', [PesananController::class, 'store'])
 ->whereNumber('konser')->name('pesanan.store');