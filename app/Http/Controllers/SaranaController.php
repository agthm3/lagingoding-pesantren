<?php

namespace App\Http\Controllers;

use App\Models\Sarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaranaController extends Controller
{
    // Tampil Data & Pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $saranas = Sarana::when($search, function ($query, $search) {
            return $query->where('nama_sarana', 'like', "%{$search}%")
                         ->orWhere('kategori', 'like', "%{$search}%");
        })->latest()->get();

        $totalAset = Sarana::count();

        return view('dashboard.sarana.index', compact('saranas', 'totalAset', 'search'));
    }

    // Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_sarana' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'foto'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maks 2MB
            'deskripsi'   => 'required|string',
        ], [
            'foto.required' => 'Dokumentasi foto sarana wajib diunggah.',
            'foto.image'    => 'Berkas yang diunggah harus berupa gambar.',
            'foto.mimes'    => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto.max'      => 'Ukuran gambar terlalu besar! Maksimal batas ukuran adalah 2 Megabyte (2048 KB).',
        ]);

        try {
            $fotoPath = $request->file('foto')->store('sarana', 'public');

            Sarana::create([
                'nama_sarana' => $request->nama_sarana,
                'kategori'    => $request->kategori,
                'foto'        => $fotoPath,
                'deskripsi'   => $request->deskripsi,
            ]);

            return redirect()->route('dashboard.sarana.index')->with('success', 'Sarana berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sarana' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maks 2MB
            'deskripsi'   => 'required|string',
        ], [
            'foto.image'    => 'Berkas yang diunggah harus berupa gambar.',
            'foto.mimes'    => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto.max'      => 'Ukuran gambar terlalu besar! Maksimal batas ukuran adalah 2 Megabyte (2048 KB).',
        ]);

        try {
            $sarana = Sarana::findOrFail($id);
            $fotoPath = $sarana->foto;

            if ($request->hasFile('foto')) {
                if ($sarana->foto && Storage::disk('public')->exists($sarana->foto)) {
                    Storage::disk('public')->delete($sarana->foto);
                }
                $fotoPath = $request->file('foto')->store('sarana', 'public');
            }

            $sarana->update([
                'nama_sarana' => $request->nama_sarana,
                'kategori'    => $request->kategori,
                'foto'        => $fotoPath,
                'deskripsi'   => $request->deskripsi,
            ]);

            return redirect()->route('dashboard.sarana.index')->with('success', 'Sarana berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    // Hapus Data
    public function destroy($id)
    {
        $sarana = Sarana::findOrFail($id);

        // Hapus file foto dari storage
        if ($sarana->foto && Storage::disk('public')->exists($sarana->foto)) {
            Storage::disk('public')->delete($sarana->foto);
        }

        $sarana->delete();

        return redirect()->route('dashboard.sarana.index')->with('success', 'Sarana berhasil dihapus.');
    }
}