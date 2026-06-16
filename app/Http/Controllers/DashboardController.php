<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Pendaftaran;
use App\Models\Berita;
use App\Models\Sarana;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggalSekarang = Carbon::now()->translatedFormat('l, d F Y');
        
        // Ambil konfigurasi global setting
        $setting = Setting::first() ?: Setting::create([
            'active_theme' => 'islami',
            'feature_ppdb' => true,
            'feature_faq' => true,
            'feature_download' => true,
            'license_expires_at' => Carbon::now()->addDays(30)->toDateString() // Default isi data contoh awal
        ]);

        // Perhitungan Sisa Hari Lisensi secara Realtime
        $sisaHari = null;
        $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
        $licenseStatusText = 'SaaS Aktif';

        if ($setting->license_expires_at) {
            $tglExpired = Carbon::parse($setting->license_expires_at);
            $hariIni = Carbon::today();
            
            if ($hariIni->greaterThan($tglExpired)) {
                $sisaHari = 0;
                $badgeClass = 'bg-rose-50 text-rose-700 border border-rose-200 animate-pulse';
                $licenseStatusText = 'Lisensi Mati';
            } else {
                $sisaHari = $hariIni->diffInDays($tglExpired);
                
                // Jika sisa hari di bawah atau sama dengan 7 hari (Masa Kritis)
                if ($sisaHari <= 7) {
                    $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-300 animate-pulse';
                    $licenseStatusText = 'Kritis (' . $sisaHari . ' Hari)';
                } else {
                    $licenseStatusText = 'Aktif (' . $sisaHari . ' Hari)';
                }
            }
        }

        // Penghitung Counter Statistik Dashboard
        $countPpdb = Pendaftaran::count();
        $countReview = Pendaftaran::where('status', 'Review')->count();
        $countBerita = Berita::count();
        $countSarana = Sarana::count();
        $pendaftarTerbaru = Pendaftaran::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'tanggalSekarang', 'setting', 'countPpdb', 'countReview', 
            'countBerita', 'countSarana', 'pendaftarTerbaru', 
            'badgeClass', 'licenseStatusText'
        ));
    }
}