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
    Schema::create('rkas', function (Blueprint $table) {
        $table->id(); // Ini yang akan jadi pembeda utama (Primary Key)
        $table->string('kode'); // HAPUS ->unique() di sini
        $table->string('nama');
        $table->string('program');
        $table->string('kegiatan');
        $table->string('sub_kegiatan');
        $table->bigInteger('pagu');
        $table->bigInteger('sisa');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkas');
    }
};
