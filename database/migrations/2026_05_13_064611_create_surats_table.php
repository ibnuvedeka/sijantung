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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            
            // Kolom-kolom buatan kita untuk SIJANTUNG
            $table->string('nomor_surat');
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->enum('status', ['Masuk', 'Keluar']); // Pilihan status surat
            
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
