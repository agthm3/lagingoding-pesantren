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

        // Validasi input radio button
        $request->validate([
            'active_theme' => 'required|in:formal,islami,modern'
        ]);

        // Checkbox di HTML jika tidak dicentang tidak akan terkirim di Request, 
        // jadi kita tangkap dengan logika $request->has()
        $setting->update([
            'active_theme'     => $request->active_theme,
            'feature_ppdb'     => $request->has('feature_ppdb'),
            'feature_faq'      => $request->has('feature_faq'),
            'feature_download' => $request->has('feature_download'),
        ]);

        return back()->with('success', 'Konfigurasi tema dan fitur berhasil diperbarui!');
    }
}