<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\ProfilSetting; // Pastikan model ini di-import
use Illuminate\Http\Request;
use Exception;

class KontakController extends Controller
{
    /**
     * Menampilkan Daftar Pesan Masuk & Form Info Kontak
     */
    public function index()
    {
        // Ambil data pesan masuk kontak
        $pesan = Kontak::latest()->get();

        // Ambil data pengaturan info sekretariat & jam kerja
        $settings = ProfilSetting::pluck('value', 'key')->all();

        return view('dashboard.kontak.index', compact('pesan', 'settings'));
    }

    /**
     * Memproses Perubahan Informasi Biro Sekretariat & Jam Kerja (Tambahan Baru)
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            'kontak_alamat'   => 'required|string',
            'kontak_telp_tu'  => 'required|string|max:50',
            'kontak_telp_ppdb'=> 'required|string|max:50',
            'kontak_email'    => 'required|email|max:255',
            'kontak_jam_kerja'=> 'required|string|max:255',
            'kontak_gmaps'    => 'required|string',
        ]);

        try {
            // Looping otomatis simpan ke tabel profil_settings
            foreach ($request->except(['_token', '_method']) as $key => $value) {
                ProfilSetting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            return redirect()->route('dashboard.kontak.index')->with('success', 'Informasi Biro Sekretariat dan Jam Pelayanan berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui informasi: ' . $e->getMessage())->withInput();
        }
    }

    public function read($id)
    {
        $item = Kontak::findOrFail($id);
        $item->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $item = Kontak::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Pesan masuk berhasil dihapus dari database.');
    }
}