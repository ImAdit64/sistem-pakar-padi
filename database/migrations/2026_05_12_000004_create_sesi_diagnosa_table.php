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
        Schema::create('sesi_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sesi', 30)->unique();
            $table->string('nama_pengguna', 100);
            $table->dateTime('tanggal');
            $table->enum('status', ['selesai', 'proses'])->default('proses');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_diagnosa');
    }
};
