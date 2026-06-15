<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Menyimpan kata kunci seperti 'sambutan_nama', 'sejarah_teks'
            $table->text('value')->nullable(); // Menyimpan isi teks atau path lokasi gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_settings');
    }
};