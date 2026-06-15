<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter_kategori = $request->input('kategori');

        // Mengambil data berita dengan filter pencarian dan kategori (di-paginate)
        $daftar_berita = Berita::when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%");
            })
            ->when($filter_kategori, function ($query, $filter_kategori) {
                return $query->where('kategori', $filter_kategori);
            })
            ->latest()
            ->paginate(10) // Otomatis membuat sistem halaman
            ->withQueryString(); // Mempertahankan parameter URL saat pindah halaman

        $totalKonten = Berita::count();

        return view('dashboard.berita.index', compact('daftar_berita', 'totalKonten', 'search', 'filter_kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Batas Maksimal 2MB
            'isi' => 'required|string',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'gambar.required' => 'Gambar sampul utama berita wajib diunggah.',
            'gambar.image' => 'Berkas yang dipilih harus berupa file gambar.',
            'gambar.max' => 'Ukuran gambar sampul terlalu besar! Batas maksimal file adalah 2 Megabyte.',
            'isi.required' => 'Isi materi artikel berita tidak boleh kosong.',
        ]);

        try {
            $gambarPath = $request->file('gambar')->store('berita', 'public');

            Berita::create([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul) . '-' . time(),
                'kategori' => $request->kategori,
                'gambar' => $gambarPath,
                'isi' => $request->isi,
                'penulis' => auth()->user()->name ?? 'Administrator', // Otomatis mendeteksi nama pengurus yang login
            ]);

            return redirect()->route('dashboard.berita.index')->with('success', 'Artikel berita baru berhasil diterbitkan!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal mempublikasikan berita: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'isi' => 'required|string',
        ], [
            'gambar.max' => 'Ukuran gambar baru terlalu besar! Batas maksimal file adalah 2 Megabyte.',
        ]);

        try {
            $data = $request->except(['gambar', '_token', '_method']);

            if ($request->hasFile('gambar')) {
                // Hapus berkas gambar lama
                if (Storage::disk('public')->exists($berita->gambar)) {
                    Storage::disk('public')->delete($berita->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('berita', 'public');
            }

            // Update slug baru jika judul mengalami perubahan
            if ($berita->judul !== $request->judul) {
                $data['slug'] = Str::slug($request->judul) . '-' . time();
            }

            $berita->update($data);

            return redirect()->route('dashboard.berita.index')->with('success', 'Artikel berita berhasil diperbarui!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui berita: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            if (Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $berita->delete();
            return back()->with('success', 'Artikel berita telah berhasil dihapus permanen.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }
}