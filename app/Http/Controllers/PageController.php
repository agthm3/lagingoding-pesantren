<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Berita;
use App\Models\ProfilSetting;
use App\Models\Sarana;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?: (object)['active_theme' => 'islami', 'feature_ppdb' => true, 'feature_faq' => true];
        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        $profilSettings = ProfilSetting::pluck('value', 'key')->all();
        $berita = Berita::latest()->take(3)->get();
        
        // AMBIL DATA MODEL FAQ DARI DATABASE
        $faqs = \App\Models\Faq::all();

        // Tambahkan 'faqs' ke dalam fungsi compact()
        return view("themes.{$folderTema}.index", compact('setting', 'berita', 'profilSettings', 'faqs'));
    }

    // Method untuk halaman Profil Publik
    public function profil()
    {
        $setting = Setting::first() ?: (object)['active_theme' => 'islami', 'feature_download' => true];
        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // BACA DATA DATABASE UNTUK DIKIRIM KE BLADE PUBLIK
        $profilSettings = ProfilSetting::pluck('value', 'key')->all();

        // Lempar variabel $profilSettings ke file profil.blade.php
        return view("themes.{$folderTema}.profil", compact('setting', 'profilSettings'));
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

        // 2. Ambil data Pengaturan Pendidikan dari database (Sama menggunakan model ProfilSetting)
        $pendidikanSettings = ProfilSetting::pluck('value', 'key')->all();

        // 3. Render view pendidikan secara dinamis berdasarkan folder tema aktif
        return view("themes.{$folderTema}.pendidikan", compact('setting', 'pendidikanSettings'));
    }

    public function berita(Request $request)
    {
        // 1. Tarik konfigurasi tema global
        $setting = Setting::first() ?: (object) [
            'active_theme' => 'islami',
            'feature_ppdb' => true,
            'feature_faq' => true,
            'feature_download' => true
        ];

        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // 2. Tangkap filter input dari form pencarian dan tab kategori luar
        $search = $request->input('search');
        $category = $request->input('category');

        // 3. Bangun Query Pencarian Berita
        $query = Berita::query();

        if ($search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
        }

        if ($category) {
            $query->where('kategori', $category);
        }

        // Ambil semua hasil berita ter-update (tanpa dibatasi 3 seperti di beranda)
        $daftar_berita = $query->latest()->get();

        return view("themes.{$folderTema}.berita", compact('setting', 'daftar_berita', 'search', 'category'));
    }

    public function galeri()
    {
        // 1. Ambil konfigurasi tema global
        $setting = Setting::first() ?: (object) [
            'active_theme' => 'islami',
            'feature_ppdb' => true,
            'feature_faq' => true,
            'feature_download' => true
        ];

        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // 2. Ambil semua data galeri tanpa filter pagination untuk halaman etalase penuh
        $semua_media = \App\Models\Galeri::latest()->get();

        // 3. Pisahkan media berdasarkan tipenya menggunakan Collection Filter
        $galeri_foto = $semua_media->where('jenis', 'foto');
        $galeri_video = $semua_media->where('jenis', 'video');

        return view("themes.{$folderTema}.galeri", compact('setting', 'galeri_foto', 'galeri_video'));
    }

    public function kontak()
    {
        // 1. Ambil konfigurasi tema global
        $setting = Setting::first() ?: (object) [
            'active_theme' => 'islami',
            'feature_ppdb' => true,
            'feature_faq' => true,
            'feature_download' => true
        ];

        $folderTema = $setting->active_theme === 'islami' ? 'islam' : $setting->active_theme;

        // 2. AMBIL DATA SETTING KONTAK DARI DATABASE (Tambahkan baris ini)
        $profilSettings = ProfilSetting::pluck('value', 'key')->all();

        // 3. Masukkan 'profilSettings' ke dalam compact agar terlempar ke Blade publik
        return view("themes.{$folderTema}.kontak", compact('setting', 'profilSettings'));
    }

    public function pendaftaran()
    {
        // 1. Ambil konfigurasi tema global dan proteksi saklar modul
        $setting = Setting::first();
        
        // Proteksi jika modul PPDB dimatikan di dashboard admin, cegah akses manual via URL
        if ($setting && !$setting->feature_ppdb) {
            return redirect()->route('home')->with('error', 'Mohon maaf, jalur pendaftaran PPDB Online saat ini sedang ditutup.');
        }

        $folderTema = ($setting && $setting->active_theme === 'islami') ? 'islam' : ($setting->active_theme ?? 'islam');

        return view("themes.{$folderTema}.pendaftaran", compact('setting'));
    }

    public function prosesPendaftaran(Request $request)
    {
        // Validasi input data multi-step formulir PPDB
        $request->validate([
            'nama_santri'   => 'required|string|max:255',
            'jenjang'       => 'required|in:MTs,MA,Tahfidz',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_daerah'   => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nama_wali'     => 'required|string|max:255',
            'kontak_wali'   => 'required|string|max:20',
            'berkas_kk'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024', // 1024 KB = 1 MB
            'berkas_akta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024',
            'ikrar'         => 'required|accepted',
        ], [
            'berkas_kk.max'   => 'Ukuran berkas KK terlalu besar! Batas maksimal adalah 2 Megabyte.',
            'berkas_akta.max' => 'Ukuran berkas Akta Kelahiran terlalu besar! Batas maksimal adalah 2 Megabyte.',
            'ikrar.accepted'  => 'Anda wajib mencentang ikrar pertanggungjawaban data untuk melanjutkan.',
        ]);

        try {
            // Upload berkas lampiran fisik ke folder storage/app/public/berkas
            $pathKK = $request->file('berkas_kk')->store('berkas', 'public');
            $pathAkta = $request->file('berkas_akta')->store('berkas', 'public');

            // Generate nomor registrasi unik, format: PPDB- ditambah 4 digit angka acak
            $nomorReg = 'PPDB-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // Pastikan tidak duplikat di database
            while (\App\Models\Pendaftaran::where('no_registrasi', $nomorReg)->exists()) {
                $nomorReg = 'PPDB-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }

            // Simpan data pendaftar baru ke tabel database pendaftarans
            \App\Models\Pendaftaran::create([
                'no_registrasi' => $nomorReg,
                'nama_santri'   => $request->nama_santri,
                'jenis_kelamin' => $request->jenis_kelamin,
                'asal_daerah'   => $request->asal_daerah,
                'jenjang'       => $request->jenjang,
                'nama_wali'     => $request->nama_wali,
                'kontak_wali'   => $request->kontak_wali,
                'berkas_kk'     => basename($pathKK),
                'berkas_akta'   => basename($pathAkta),
                'status'        => 'Review', // Default awal
            ]);

            return redirect()->route('pendaftaran')->with('success_ppdb', $nomorReg);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim formulir pendaftaran: ' . $e->getMessage())->withInput();
        }
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'whatsapp' => 'required|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        try {
            // SIMPAN KE DATABASE BARU
            \App\Models\Kontak::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'is_read' => false
            ]);

            return back()->with('success', 'Syukran, pesan atau pertanyaan Anda telah berhasil dilayangkan ke Biro Sekretariat Pusat Ma\'had!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal melayangkan pesan: ' . $e->getMessage())->withInput();
        }
    }
}