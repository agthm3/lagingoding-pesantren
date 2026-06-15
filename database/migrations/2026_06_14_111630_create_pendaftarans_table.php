<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->unique();
            $table->string('nama_santri');
            $table->string('jenis_kelamin');
            $table->string('asal_daerah');
            $table->string('jenjang'); // MTs, MA, Tahfidz
            $table->string('nama_wali');
            $table->string('kontak_wali');
            $table->string('berkas_kk'); // Path file PDF/Gambar KK
            $table->string('berkas_akta'); // Path file PDF/Gambar Akta
            $table->enum('status', ['Review', 'Lolos', 'Ditolak'])->default('Review');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};