<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('active_theme')->default('islami'); // islami, formal, modern
            
            // Saklar Fitur (Feature Toggles) menggunakan Boolean
            $table->boolean('feature_ppdb')->default(true);
            $table->boolean('feature_faq')->default(true);
            $table->boolean('feature_download')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};