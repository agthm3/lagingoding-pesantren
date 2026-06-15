<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Berita;
use App\Models\Sarana;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // 1. Ambil konfigurasi tema dan saklar fitur aktif
        $setting = Setting::first();

        // Jika seeder belum dijalankan atau data kosong, berikan fallback default
        if (!$setting) {
            $setting = (object) [
                'active_theme' => 'islam',
                'feature_ppdb' => true,
                'feature_faq' => true,
                'feature_download' => true
            ];
        }

        // Standardisasi value database ke folder: jika di DB 'islami', foldernya adalah 'islam'
        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // 2. Ambil 3 data Berita/Kegiatan terbaru untuk etalase depan
        $berita = Berita::latest()->take(3)->get();

        // 3. Ambil data Sarana/Fasilitas untuk ditampilkan di landing page
        $sarana = Sarana::latest()->get();

        // 4. Arahkan view secara dinamis berdasar folder tema yang aktif
        return view("themes.{$folderTema}.index", compact('setting', 'berita', 'sarana'));
    }

    public function profil()
    {
        // 1. Ambil konfigurasi tema dan saklar fitur aktif dari database
        $setting = Setting::first();

        if (!$setting) {
            $setting = (object) [
                'active_theme' => 'islami',
                'feature_ppdb' => true,
                'feature_faq' => true,
                'feature_download' => true
            ];
        }

        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // 2. Render view profil secara dinamis sesuai tema yang dipilih
        return view("themes.{$folderTema}.profil", compact('setting'));
    }

    public function pendidikan()
    {
        // 1. Tarik konfigurasi tema dan status saklar fitur aktif dari database
        $setting = Setting::first();

        if (!$setting) {
            $setting = (object) [
                'active_theme' => 'islami',
                'feature_ppdb' => true,
                'feature_faq' => true,
                'feature_download' => true
            ];
        }

        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // 2. Render view pendidikan secara dinamis berdasarkan folder tema aktif
        return view("themes.{$folderTema}.pendidikan", compact('setting'));
    }
}