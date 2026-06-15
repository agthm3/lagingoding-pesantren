<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Exception;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter_jenjang = $request->input('jenjang');
        $filter_status = $request->input('status');

        // Memulai query builder dengan filter bersyarat kustom
        $query = Pendaftaran::query();

        if ($search) {
            $query->where('nama_santri', 'like', "%{$search}%");
        }

        if ($filter_jenjang) {
            $query->where('jenjang', $filter_jenjang);
        }

        if ($filter_status) {
            $query->where('status', $filter_status);
        }

        // Ambil data terpilih dengan pagination terintegrasi URL parameter
        $daftar_pendaftar = $query->latest()->paginate(10)->withQueryString();
        
        // Menghitung total data keseluruhan pendaftar dalam database
        $totalPendaftar = Pendaftaran::count();
        $totalTampil = $daftar_pendaftar->count();

        return view('dashboard.pendaftaran.index', compact(
            'daftar_pendaftar', 'totalPendaftar', 'totalTampil', 
            'search', 'filter_jenjang', 'filter_status'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Review,Lolos,Ditolak'
        ]);

        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            $pendaftaran->update(['status' => $request->status]);

            $pesan = 'Status pendaftaran ' . $pendaftaran->nama_santri . ' berhasil diubah menjadi ' . $request->status;
            return redirect()->route('dashboard.pendaftaran.index')->with('success', $pesan);
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses status verifikasi: ' . $e->getMessage());
        }
    }
}