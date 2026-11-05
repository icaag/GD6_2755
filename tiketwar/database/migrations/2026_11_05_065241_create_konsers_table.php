<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('konsers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotor_id')->constrained()->restrictOnDelete(); // BARU
            $table->string('nama'); // BARU
            $table->string('kota'); // BARU
            $table->unsignedInteger('harga'); // BARU
            $table->unsignedInteger('sisa'); // BARU: bulat tanpa minus
            $table->date('tanggal'); // BARU: tipe tanggal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsers');
    }
};
