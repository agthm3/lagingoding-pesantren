<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PengaturanTemaFiturController extends Controller
{
    public function index()
    {
        // Ambil baris pertama pengaturan (karena sistemnya single-tenant konfigurasi global)
        $setting = Setting::first();
        
        return view('dashboard.pengaturan.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        // Validasi input radio button & inputan tanggal baru
        $request->validate([
            'active_theme'        => 'required|in:formal,islami,modern',
            'license_expires_at'  => 'required|date' // Validasi tanggal baru
        ]);

        $setting->update([
            'active_theme'        => $request->active_theme,
            'feature_ppdb'        => $request->has('feature_ppdb'),
            'feature_faq'         => $request->has('feature_faq'),
            'feature_download'    => $request->has('feature_download'),
            'license_expires_at'  => $request->license_expires_at, // Masukkan inputan ke database
        ]);

        return back()->with('success', 'Konfigurasi tema dan parameter durasi lisensi berhasil diperbarui!');
    }
}