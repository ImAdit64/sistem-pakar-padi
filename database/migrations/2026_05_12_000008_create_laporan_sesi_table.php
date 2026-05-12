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
        Schema::create('laporan_sesi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_id')->constrained('sesi_diagnosa')->onDelete('cascade');
            $table->string('no_laporan', 30)->unique();
            $table->enum('format', ['pdf', 'html']);
            $table->string('file_path', 255)->nullable();
            $table->string('digenerate_oleh', 100)->nullable();
            $table->timestamp('digenerate_pada')->useCurrent();
            $table->integer('jumlah_download')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_sesi');
    }
};
