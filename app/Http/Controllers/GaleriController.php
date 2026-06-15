<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $filter_jenis = $request->input('jenis');

        // Filter data galeri berdasarkan pilihan dropdown
        $daftar_galeri = Galeri::when($filter_jenis, function ($query, $filter_jenis) {
            return $query->where('jenis', $filter_jenis);
        })->latest()->get();

        $totalMedia = Galeri::count();

        return view('dashboard.galeri.index', compact('daftar_galeri', 'totalMedia', 'filter_jenis'));
    }

    public function store(Request $request)
    {
        // 1. Validasi bersyarat tergantung jenis media yang dipilih
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:image_upload,video_link',
            'foto'  => 'required_if:jenis,image_upload|nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video' => 'required_if:jenis,video_link|nullable|url',
        ], [
            'judul.required' => 'Judul media wajib diisi.',
            'foto.required_if' => 'Berkas gambar wajib dipilih jika memilih jenis Foto.',
            'foto.image' => 'Berkas harus berupa file gambar.',
            'foto.max' => 'Ukuran foto terlalu besar! Maksimal batas ukuran berkas adalah 2 Megabyte.',
            'video.required_if' => 'Tautan URL wajib diisi jika memilih jenis Video YouTube.',
            'video.url' => 'Format tautan video YouTube tidak valid.',
        ]);

        try {
            if ($request->jenis === 'image_upload') {
                // Simpan file gambar secara fisik ke folder storage/prestasi/galeri
                $path = $request->file('foto')->store('galeri', 'public');
                
                Galeri::create([
                    'judul' => $request->judul,
                    'jenis' => 'foto',
                    'konten' => $path
                ]);
            } else {
                // Ekstraksi ID YouTube dari link masukan
                $url = $request->video;
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                $youtubeId = $match[1] ?? null;

                if (!$youtubeId) {
                    return back()->with('error', 'Gagal memproses link! Pastikan URL yang dimasukkan adalah tautan video YouTube asli.')->withInput();
                }

                Galeri::create([
                    'judul' => $request->judul,
                    'jenis' => 'video',
                    'konten' => $youtubeId
                ]);
            }

            return redirect()->route('dashboard.galeri.index')->with('success', 'Aset media dokumentasi berhasil disimpan!');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $galeri = Galeri::findOrFail($id);

            // Jika media berupa foto, hapus file fisiknya dari server lokal
            if ($galeri->jenis === 'foto' && Storage::disk('public')->exists($galeri->konten)) {
                Storage::disk('public')->delete($galeri->konten);
            }

            $galeri->delete();
            return back()->with('success', 'Aset dokumentasi berhasil dihapus dari sistem.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus aset: ' . $e->getMessage());
        }
    }
}