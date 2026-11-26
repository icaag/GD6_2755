<?php

use App\Http\Controllers\Api\KonserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API publik TiketWar (modul API dan Autentikasi, kelas) // BARU
Route::get('/konser', [KonserController::class, 'index']) // BARU
 ->name('api.konser.index'); // BARU
Route::get('/konser/{konser}', [KonserController::class, 'show']) // BARU
 ->whereNumber('konser')->name('api.konser.show');