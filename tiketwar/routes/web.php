<?php
use App\Http\Controllers\KonserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController; // BARU
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;

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

Route::get('/pesanan.index', [PesananController::class, 'index']) // BARU
 ->name('pesanan.index'); // BARU
Route::patch('/pesanan/{pesanan}/bayar', [PesananController::class, 'bayar']) // BARU
 ->whereNumber('pesanan')->name('pesanan.bayar'); // BARU
Route::patch('/pesanan/{pesanan}/batal', [PesananController::class, 'batal']) // BARU
 ->whereNumber('pesanan')->name('pesanan.batal'); // BARU

 // Transaksi dan Laporan: laporan // BARU
Route::get('/laporan', [LaporanController::class, 'index']) // BARU
 ->name('laporan.index'); // BARU

Route::get('/laporan/pdf', [LaporanController::class, 'pdf']) // BARU
    ->name('laporan.pdf'); // BARU

// Login dan logout admin // BARU
Route::get('/login', [AuthController::class, 'showLogin']) // BARU
 ->middleware('guest')->name('login'); // BARU
Route::post('/login', [AuthController::class, 'login']) // BARU
 ->middleware('guest')->name('login.proses'); // BARU
Route::post('/logout', [AuthController::class, 'logout']) // BARU
 ->middleware('auth')->name('logout'); // BARU