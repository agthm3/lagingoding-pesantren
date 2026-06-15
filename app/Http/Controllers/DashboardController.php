<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Berita;
use App\Models\Sarana;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengatur lokalisasi Carbon agar mencetak hari & bulan dalam Bahasa Indonesia
        Carbon::setLocale('id');
        $tanggalSekarang = Carbon::now()->translatedFormat('l, d F Y');

        // 2. Akumulasi Agregat Data untuk Mengisi Kartu Statistik Cepat
        $countPpdb     = Pendaftaran::count();
        $countReview   = Pendaftaran::where('status', 'Review')->count();
        $countBerita   = Berita::count();
        $countSarana   = Sarana::count();

        // 3. Mengambil 5 Data Calon Santri Baru yang Paling Terakhir Melakukan Submit
        $pendaftarTerbaru = Pendaftaran::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'tanggalSekarang',
            'countPpdb',
            'countReview',
            'countBerita',
            'countSarana',
            'pendaftarTerbaru'
        ));
    }   
}