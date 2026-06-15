<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Masukkan pengaturan default pertama kali
        Setting::create([
            'active_theme' => 'islami',
            'feature_ppdb' => true,
            'feature_faq' => true,
            'feature_download' => true,
        ]);
    }
}