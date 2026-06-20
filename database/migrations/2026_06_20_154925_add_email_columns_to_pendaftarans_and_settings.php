<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambahkan kolom email wali di tabel pendaftarans
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('email_wali')->after('kontak_wali')->nullable();
        });

        // Menambahkan kolom email admin di tabel settings
        Schema::table('settings', function (Blueprint $table) {
            $table->string('admin_email')->after('feature_faq')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('email_wali');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('admin_email');
        });
    }
};