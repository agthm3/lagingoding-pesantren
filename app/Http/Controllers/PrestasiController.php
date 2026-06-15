<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class PrestasiController extends Controller
{
    public function index()
    {
        $daftar_prestasi = Prestasi::latest()->get();
        return view('dashboard.prestasi.index', compact('daftar_prestasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_santri' => 'required|string|max:255',
            'judul_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        try {
            // Proses upload file
            $fotoPath = $request->file('foto')->store('prestasi', 'public');

            Prestasi::create([
                'nama_santri' => $request->nama_santri,
                'judul_prestasi' => $request->judul_prestasi,
                'tingkat' => $request->tingkat,
                'foto' => $fotoPath,
                'penyelenggara' => $request->penyelenggara,
                'tahun' => $request->tahun,
            ]);

            return redirect()->route('dashboard.prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'nama_santri' => 'required|string|max:255',
            'judul_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ]);

        try {
            $data = $request->except(['foto', '_token', '_method']);

            // Jika ada foto baru yang diunggah
            if ($request->hasFile('foto')) {
                // Hapus foto lama
                if (Storage::disk('public')->exists($prestasi->foto)) {
                    Storage::disk('public')->delete($prestasi->foto);
                }
                $data['foto'] = $request->file('foto')->store('prestasi', 'public');
            }

            $prestasi->update($data);

            return redirect()->route('dashboard.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $prestasi = Prestasi::findOrFail($id);
            
            // Hapus file fisik gambar
            if (Storage::disk('public')->exists($prestasi->foto)) {
                Storage::disk('public')->delete($prestasi->foto);
            }

            $prestasi->delete();
            return back()->with('success', 'Data prestasi berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}